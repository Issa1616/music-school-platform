<?php
include 'bd.php';

$sql = "SELECT titulo, nombre, apellido from curso
inner join usuario on usuario.usuario_id = curso.usuario_id
inner join materia on curso.materia_id = materia.materia_id";

$result = $conn->query($sql);
$action = $_POST['action'] ?? '';

if ($action == 'create') {
    $name = $_POST['titulo'];
    $name = $_POST['nombre'];
    $name = $_POST['apellido'];
    $sql = "INSERT INTO $conn->query($sql) (nombre, apellido) VALUES ('$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro guardado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
} elseif ($action == 'read') {
    $sql = "SELECT * FROM usuarios";
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
    $email = $_POST['email'];
    $sql = "UPDATE usuarios SET nombre='$name', email='$email' WHERE iduser=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro actualizado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
} elseif ($action == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM usuarios WHERE iduser=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro borrado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }}

$conn->close();
?>