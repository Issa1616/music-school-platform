<?php
include 'bd.php';

if (!isset($_SESSION["username"])) {
    echo "No usuario";
    exit();
}

$nombreUsuario = $_SESSION["username"];

$sql = "SELECT curso_id, titulo, nombre, apellido from curso
                inner join materia on materia.materia_id = curso.materia_id
                inner join usuario on usuario.usuario_id = curso.usuario_id
                where usuario.nombre=?";

if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("s", $nombreUsuario);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-lg-6 col-md-6 col-12 mt-4">';
                    echo '<div class="card">';
                    echo '<span class="mask bg-primary opacity-10 border-radius-lg"></span>';
                    echo '<div class="card-body p-3 position-relative">';
                    echo '<div class="row">';
                    echo '<a href="Calumnos.php?curso_id=' . $row['curso_id'] . '" </a>';
                    echo '<h5 class="text-white font-weight-bolder mb-0 mt-3">' . htmlspecialchars($row['titulo']) . '</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
    } else {
        echo "No hay cursos disponibles.";
    }

    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}
$conn->close();
?>