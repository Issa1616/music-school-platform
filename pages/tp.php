<?php
include 'bd.php';

$action = $_POST['action'] ?? '';

if ($action == 'create') {
    $AlumnocursoId = $_POST['alumno_curso_id'];
    $fecha = $_POST['fecha'];
    $horai = $_POST['horaini'];
    $horaf = $_POST['horafin'];
    $sql = "INSERT INTO tiempopractica (alumno_curso_id, fechatp, horaini, horafin) VALUE ('$AlumnocursoId', '$fecha','$horai','$horaf')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro guardado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
}
$conn->close();
?>