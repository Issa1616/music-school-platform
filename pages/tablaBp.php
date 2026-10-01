<?php
include 'bd.php';

$sql = "SELECT docente.nombre as DN, docente.apellido as DA, alumno.nombre as AN, alumno.apellido as AA, titulo, avg(asignacion.calificacion) as promedio from asignacion
        inner join alumno_curso on alumno_curso.alumno_curso_id = asignacion.alumno_curso_id
        inner join usuario as alumno on alumno.usuario_id = alumno_curso.usuario_id
        inner join curso on curso.curso_id = alumno_curso.curso_id
        inner join materia on materia.materia_id = curso.materia_id
        inner join usuario as docente on docente.usuario_id = curso.usuario_id
        group by docente.nombre, docente.apellido, alumno.nombre, alumno.apellido, titulo";

$result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['DN']) . " " . htmlspecialchars($row['DA']) . "</td>";
            echo "<td>" . htmlspecialchars($row['AN']) . " " . htmlspecialchars($row['AA']) . "</td>";
            echo "<td>" . htmlspecialchars($row['promedio']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No hay cursos disponibles para este usuario.";
    }
$conn->close();
?>