<?php
include 'bd.php';
session_start();

if (!isset($_SESSION["username"])) {
    echo "No usuario";
    exit();
}

$nombreUsuario = $_SESSION["username"];

$sql = "SELECT estado, COUNT(*) as cantidad
        FROM (
            SELECT CASE 
                    WHEN AVG(asignacion.calificacion) >= 7 THEN 'Aprobadas'
                    ELSE 'Reprobadas'
                    END AS estado
                FROM asignacion
                INNER JOIN alumno_curso ON alumno_curso.alumno_curso_id = asignacion.alumno_curso_id
                INNER JOIN usuario ON usuario.usuario_id = alumno_curso.usuario_id
                INNER JOIN curso ON curso.curso_id = alumno_curso.curso_id
                INNER JOIN materia ON materia.materia_id = curso.materia_id
                WHERE usuario.nombre = ?
                GROUP BY materia.materia_id
            ) AS subquery
            GROUP BY estado";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $nombreUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    $labels = [];
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['estado'];
        $data[] = $row['cantidad'];
    }

    // Devuelve los datos como JSON
    echo json_encode(["labels" => $labels, "data" => $data]);
} else {
    echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
}

$conn->close();
