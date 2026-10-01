<?php 
session_start();
include 'bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = htmlspecialchars(trim($_POST["username"]));
        $password = trim($_POST["password"]);
    } else {
        echo json_encode(["success" => false, "message" => "Datos incompletos"]);
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM usuario WHERE nombreusuario = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verificar contraseña
        if ($password  == $user["password"]) { // Usa esto si estás usando password_hash()
            session_regenerate_id(true);
            $_SESSION["username"] = $user["nombre"];
            $_SESSION["rol"] = $user["rol"];

            switch ($user["rol"]) {
                case 'admin':
                    header("Location: Bgestioncursos.php");
                    exit();
                case 'docente':
                    header("Location: docente.php");
                    exit();
                case 'alumno':
                    header("Location: Acursos.php");
                    exit();
                default:
                    echo json_encode(["success" => false, "message" => "Rol desconocido"]);
                    exit();
            }
        } else {
            echo json_encode(["success" => false, "message" => "Contraseña incorrecta"]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "message" => "Usuario no encontrado"]);
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
