<?php 
session_start();
include 'bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
    }

    $stmt = $conn->prepare("SELECT * FROM usuario WHERE nombreusuario = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if ($password === $user["password"]) {
            $_SESSION["username"] = $user["nombre"];
            $_SESSION["rol"] = $user["rol"];

            switch ($user["rol"]) {

                case 'admin':
                    header("Location: administrador.php");
                    exit();
                    
                case 'docente':
                    header("Location: docente.php");
                    exit();
                   
                case 'alumno':
                    header("Location: Acursos.php");
                    exit();
                    
                default:
                    echo json_encode(["success" => false, "message" => "Rol desconocido"]);
                    break;
            }
        } else {
            echo json_encode(["success" => false, "message" => "Credenciales incorrectas_a"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Credenciales incorrectas_b"]);
    }

    $stmt->close();
}

$conn->close();
?>