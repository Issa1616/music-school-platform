<?php
include 'bd.php';

$action = $_POST['action'] ?? '';

if ($action == 'get_alumno') {
    $sql = "SELECT usuario_id, nombre  FROM usuario where rol='alumno'";
    $result = $conn->query($sql);
    $alumno = [];
    while ($row = $result->fetch_assoc()) {
        $alumno[] = $row;
    }
    echo json_encode(["status" => "success", "alumno" => $alumno]);
} elseif ($action == 'create') {
    $id = $_POST['curso_id'];
    $name = $_POST['nombre'];

    $sql = "INSERT INTO alumno_curso (curso_id, usuario_id) VALUES ('$id', '$name')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro guardado exitosamente"]);
    } else {
        $cursoId = $_GET['curso_id'];
        echo json_encode(["status" => "error", "message" => "Error: " . $cursoId]);
    }
}
