<?php
include 'bd.php';

$action = $_POST['action'] ?? '';

if ($action == 'create') {
    $title = $_POST['titulo'];
    $sql = "INSERT INTO tiempopractica (fechatp, horaini, horafin) VALUE ('$fechatp','$horaini','$horafin')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro guardado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
}
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