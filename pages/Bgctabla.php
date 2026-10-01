<?php
include 'bd.php';

$action = $_POST['action'] ?? '';

if ($action == 'create') {
    $id = $_POST['id'];
    $title = $_POST['agregartitulo'];
    $name = $_POST['agregardocente'];
    

    $sql = "INSERT INTO curso (materia_id, usuario_id) VALUES ('$title', '$name')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro guardado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
} elseif ($action == 'read') {
    $sql = "SELECT curso_id, titulo, nombre, apellido from curso
            inner join materia on materia.materia_id = curso.materia_id
            inner join usuario on usuario.usuario_id = curso.usuario_id;";
    $result = $conn->query($sql);
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode(["status" => "success", "data" => $data]);
} elseif ($action == 'get_materias') {
    $sql = "SELECT materia_id, titulo FROM materia";
    $result = $conn->query($sql);
    $materias = [];
    while ($row = $result->fetch_assoc()) {
        $materias[] = $row;
    }
    if (isset($_POST['idcurso'])) {
        $id = $_POST['idcurso'];

        $sql1 = "SELECT materia_id from curso where curso_id =$id";
        $result1 = $conn->query($sql);
        $materiaseleccionada = [];
        while ($row = $result1->fetch_assoc()) {
            $materiaseleccionada[] = $row;
        }
        echo json_encode(["status" => "success", "materias" => $materias, "materiaseleccionada" => $materiaseleccionada[0]]);
    } else {
        echo json_encode(["status" => "success", "materias" => $materias]);
    }
} elseif ($action == 'get_docente') {
    $sql = "SELECT usuario_id, nombre, apellido FROM usuario where rol='docente'";
    $result = $conn->query($sql);
    $docente = [];
    while ($row = $result->fetch_assoc()) {
        $docente[] = $row;
    }
    if (isset($_POST['idcurso'])) {
        $id = $_POST['idcurso'];
       
        $sql1 = "SELECT usuario_id from curso where curso_id =$id";
        $result1 = $conn->query($sql);
        $docenteseleccionado = [];
        while ($row = $result1->fetch_assoc()) {
            $docenteseleccionado[] = $row;
        }
        echo json_encode(["status" => "success", "docente" => $docente, "docenteseleccionado" => $docenteseleccionado[0]]);
    } else {
        echo json_encode(["status" => "success", "docente" => $docente]);
    }
} elseif ($action == 'update') {
    $id = $_POST['id'];
    $materia_id = $_POST['titulo'];
    $usuario_id = $_POST['nombre'];
    $sql = "UPDATE curso SET materia_id='$materia_id',
                               usuario_id='$usuario_id' 
                               WHERE curso_id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro actualizado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
} elseif ($action == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM curso WHERE curso_id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registro borrado exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
}

$conn->close();
?>