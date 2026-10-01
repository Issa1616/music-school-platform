<?php
include 'bd.php';

if (!isset($_SESSION["username"])) {
    echo "No usuario";
    exit();
}

$nombreUsuario = $_SESSION["username"];

$sql = "SELECT alumno_curso_id, titulo, docente_usuario.nombre as docente, docente_usuario.apellido as Adocente, alumno_usuario.nombre, alumno_usuario.apellido from alumno_curso
            inner join curso on alumno_curso.curso_id = curso.curso_id
            inner join usuario as alumno_usuario on alumno_curso.usuario_id = alumno_usuario.usuario_id
            inner join usuario as docente_usuario on curso.usuario_id = docente_usuario.usuario_id
            inner join materia on curso.materia_id = materia.materia_id
            where alumno_usuario.nombre=?";

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
                    echo '<a href="Atareas.php?alumno_curso_id=' . $row['alumno_curso_id'] . '" </a>';
                    echo '<h5 class="text-white font-weight-bolder mb-0 mt-3">' . htmlspecialchars($row['titulo']) . '</h5>';
                    echo '<span class="text-white text-sm">' . htmlspecialchars($row['docente']) . ' ' . htmlspecialchars($row['Adocente']) . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
    } else {
        echo "No hay cursos disponibles para este usuario.";
    }

    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}
$conn->close();
?>