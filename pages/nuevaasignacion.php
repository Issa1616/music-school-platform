<?php
include 'bd.php';

$action = $_POST['action'] ?? '';

if ($action == 'create') {
    $AlumnocursoId = $_POST['alumno_curso_id'];
    $name = $_POST['encabezado'];
    $desc = $_POST['descripcion'];
    $date = $_POST['fecha'];
    $cal = $_POST['cal'];

    $sql = "INSERT INTO asignacion (alumno_curso_id, encabezado, descripcion, fecha, calificacion) VALUES ('$AlumnocursoId', '$name', '$desc', '$date', '$cal')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro guardado exitosamente"]);
    } else {
        $AlumnocursoId = $_GET['alumno_curso_id'];
        echo json_encode(["status" => "error", "message" => "Error: " . $AlumnocursoId]);
    }
}