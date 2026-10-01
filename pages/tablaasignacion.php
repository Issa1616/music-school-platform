<?php
include 'bd.php';

if (!isset($_SESSION["username"])) {
    echo "No usuario";
    exit();
}

$nombreUsuario = $_SESSION["username"];

$sql = "SELECT titulo, encabezado, descripcion, calificacion from alumno_curso
        inner join curso on alumno_curso.curso_id = curso.curso_id
        inner join usuario as alumno_usuario on alumno_curso.usuario_id = alumno_usuario.usuario_id
        inner join materia on curso.materia_id = materia.materia_id
        inner join asignacion on alumno_curso.alumno_curso_id = asignacion.alumno_curso_id
        where alumno_usuario.nombre=?";

if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("s", $nombreUsuario);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['encabezado']) . "</td>";
            echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
            echo "<td>" . htmlspecialchars($row['calificacion']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No hay cursos disponibles para este usuario.";
    }

    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}
$conn->close();
?>