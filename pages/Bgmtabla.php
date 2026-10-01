<?php
include 'bd.php';

$action = $_POST['action'] ?? '';

if ($action == 'create') {
    $title = $_POST['titulo'];
    $sql = "INSERT INTO materia (titulo) VALUE ('$title')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro guardado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
} elseif ($action == 'read') {
    $sql = "SELECT * FROM materia";
    $result = $conn->query($sql);
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode(["status" => "success", "data" => $data]);

} elseif ($action == 'update') {
    $id = $_POST['id'];
    $title = $_POST['titulo'];
    $sql = "UPDATE materia SET titulo='$title' WHERE materia_id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro actualizado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
} elseif ($action == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM materia WHERE materia_id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro borrado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }}

$conn->close();
?>