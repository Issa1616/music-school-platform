<?php
include 'bd.php';

if (!isset($_GET['curso_id'])) {
    echo "No se ha especificado el curso.";
    exit();
}

$alumno_curso_id_id = $_GET['curso_id'];

$sql = "SELECT titulo, encabezado, descripcion from alumno_curso
        inner join curso on alumno_curso.curso_id = curso.curso_id
        inner join usuario as alumno_usuario on alumno_curso.usuario_id = alumno_usuario.usuario_id
        inner join materia on curso.materia_id = materia.materia_id
        inner join asignacion on alumno_curso.alumno_curso_id = asignacion.alumno_curso_id
        where alumno_curso.alumno_curso_id=?";

if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i", $alumno_curso_id_id);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<h3>Asignaciones del curso:</h3>';
        echo '<ul>';
        while ($row = $result->fetch_assoc()) {
            echo '<li>';
            echo '<strong>' . htmlspecialchars($row['titulo']) . '</strong><br>';
            echo 'Descripción: ' . htmlspecialchars($row['encabezado']) . '<br>';
            echo 'Fecha de entrega: ' . htmlspecialchars($row['descripcion']) . '<br>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo "Por el momento no tienes asignaciones de este curso.";
    }

    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}
$conn->close();
?>