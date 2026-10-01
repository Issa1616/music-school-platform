<?php
include 'bd.php';

if (!isset($_GET['curso_id'])) {
    echo json_encode(["error" => "No se ha especificado el curso."]);
    exit();
}

$curso_id = intval($_GET['curso_id']);

$sql = "SELECT estado, COUNT(*) as cantidad
from ( select case when AVG(asignacion.calificacion) <= 70 then 'Aprobado'
						else 'Reprobado'
						end as estado
    from asignacion
    inner join alumno_curso on alumno_curso.alumno_curso_id = asignacion.alumno_curso_id
    inner join curso on curso.curso_id = alumno_curso.curso_id
    where curso.curso_id = '1'
    group by alumno_curso.alumno_curso_id
) as subquery
group by estado";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $curso_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $labels = [];
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['estado'];
        $data[] = $row['cantidad'];
    }

    echo json_encode(["labels" => $labels, "data" => $data]);
} else {
    echo json_encode(["error" => "Error en la consulta: " . $conn->error]);
}

$conn->close();
