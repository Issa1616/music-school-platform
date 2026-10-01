<?php
include 'bd.php';

if (!isset($_GET['alumno_curso_id'])) {
    echo "No se ha especificado el curso.";
    exit();
}

$alumno_curso_id = $_GET['alumno_curso_id'];

$sql = "SELECT fechatp, horaini, horafin from tiempopractica
        where   alumno_curso_id=?
        order by fechatp desc";

if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("i", $alumno_curso_id);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['fechatp']) . "</td>";
            echo '<td>' . htmlspecialchars($row['horaini']) . "</td>";
            echo '<td>' . htmlspecialchars($row['horafin']) . "</td>";
            echo '</tr>';
        }
    } else {
        echo "No se ha registrado ningun tiempo de practica.";
    }

    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}
$conn->close();
?>