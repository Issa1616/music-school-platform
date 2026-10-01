<?php
include 'dashboard_head.php';
include 'Asidebar.php';
?>

<body class="g-sidenav-show bg-gray-100">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Mis Asignaciones</h6>
        </nav>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <!-- Asignaciones -->
      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card shadow-lg border-0">
            <div class="card-header pb-0">
              <h6 class="text-uppercase text-secondary font-weight-bold mb-0">Mis Asignaciones</h6>
            </div>
            <div class="card-body px-4 pb-3">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="flex-grow-1" style="max-width: 300px;">
                  <div class="input-group shadow-sm">
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover align-items-center">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Encabezado</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descripcion</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Calificación</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include 'asignaciones.php'; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tiempo de práctica -->
      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card shadow-lg border-0">
            <div class="card-header pb-0">
              <h6 class="text-uppercase text-secondary font-weight-bold mb-0">Tiempo de práctica</h6>
            </div>
            <div class="card-body px-4">
              <div class="table-responsive">
                <div class="text-end">
                  <button id="addButton" class="btn btn-primary">Agregar</button>
                </div>
                <table class="table table-hover align-items-center">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Inicio</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fin</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include 'tiempopractica.php'; ?>
                  </tbody>
                </table>

                <!-- Modal para agregar tiempo -->
                <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addTiempoModalLabel">Agregar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="cursoForm">

                          <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required />
                          </div>

                          <div class="mb-3">
                            <label for="horaini" class="form-label">Inicio:</label>
                            <input type="time" id="horaini" name="horaini" class="form-control" required />
                          </div>

                          <div class="mb-3">
                            <label for="horafin" class="form-label">Fin:</label>
                            <input type="time" id="horafin" name="horafin" class="form-control" required />
                          </div>

                          <button type="submit" class="btn btn-primary">Guardar cambios</button>
                          <button type="button " class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                  document.getElementById('addButton').addEventListener('click', function() {
                    const modal = new bootstrap.Modal(document.getElementById('addmodal'));
                    document.getElementById('cursoForm').reset();
                    modal.show();
                  });

                  document.getElementById('cursoForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    saveAddTiempo('create');
                  });

                  function saveAddTiempo() {
                    const urlParams = new URLSearchParams(window.location.search);
                    console.log(urlParams)
                    const formData = new FormData(document.getElementById('cursoForm'));
                    formData.append('action', 'create');
                    if (urlParams.has('alumno_curso_id')) {
                      const AlumnocursoId = urlParams.get('alumno_curso_id');
                      formData.append('alumno_curso_id', AlumnocursoId);
                    } else {
                      console.log('No se encontró el parámetro "alumno_curso_id" en la URL.');
                    }

                    fetch('tp.php', {
                        method: 'POST',
                        body: formData,
                      })
                      .then(response => response.json())
                      .then(data => {
                        if (data.status === 'success') {
                          alert('Tiempo de practica agregado exitosamente');
                          const modal = bootstrap.Modal.getInstance(document.getElementById('addmodal'));
                          modal.hide();
                          loadTableData();
                        } else {
                          alert('Error: ' + data.message);
                        }
                      })
                      .catch(error => console.error('Error:', error));
                  }
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="../assets/js/core/bootstrap.min.js"></script>
</body>
<?php
include 'footer.php'
?>