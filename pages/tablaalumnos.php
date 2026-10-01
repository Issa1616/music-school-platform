<?php
include 'bd.php';

if (!isset($_GET['curso_id'])) {
    echo "No se ha especificado el curso.";
    exit();
}

$curso_id = $_GET['curso_id'];

$sql = "SELECT alumno_curso_id, curso_id, nombre, apellido from alumno_curso
        inner join usuario on alumno_curso.usuario_id = usuario.usuario_id
        where curso_id=?";

if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i", $curso_id);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>';
            echo '<a href="Alumno.php?alumno_curso_id=' . $row['alumno_curso_id'] . '" >';
            echo htmlspecialchars($row['nombre']) . " " . htmlspecialchars($row['apellido']) ;
            echo '</a>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo "Por el momento no tienes alumnos en este curso.";
    }

    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}

$conn->close();
?>