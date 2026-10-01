<?php
include 'bd.php';

$action = $_POST['action'] ?? '';

if ($action == 'create') {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];
    $sql = "INSERT INTO usuario (nombre, apellido, nombreusuario, password, rol) VALUES ('$name', '$lastname', '$username', '$password', '$rol')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro guardado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
} elseif ($action == 'read') {
    $sql = "SELECT * FROM usuario";
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
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];
    $sql = "UPDATE usuario SET nombre='$name', 
                               apellido='$lastname', 
                               nombreusuario='$username', 
                               password='$password',
                               rol='$rol'
                               WHERE usuario_id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro actualizado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
} elseif ($action == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM usuario WHERE usuario_id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro borrado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }}

$conn->close();
?>