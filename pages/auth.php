<?php
if (!isset($_SESSION['rol'])) {
    echo json_encode(["success" => false, "message" => "Rol no definido"]);
    exit();
}
$rol = $_SESSION['rol'];
switch ($tipo) {

    case 'admin':
        header("Location: administrador.php");
        exit();
        
    case 'docente':
        header("Location: docente.php");
        exit();
       
    case 'usuario':
        header("Location: alumno.php");
        exit();
        
    default:
        echo json_encode(["success" => false, "message" => "Rol desconocido"]);
        break;
    }
?>