<?php
session_start();
include 'dashboard_head.php';
include 'Csidebar.php';
?>

<body class="g-sidenav-show  bg-gray-100">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    </nav>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="card shadow-lg border-0">
            <div class="card-header pb-0">
              <h6 class="text-uppercase text-secondary font-weight-bold mb-0">Mis Alumnos</h6>
            </div>
            <div class="card-body px-4">
              <div class="table-responsive">
                <button id="addButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">Agregar alumno</button>
                <table class="table table-hover align-items-center">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include 'tablaalumnos.php'; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- Modal para agregar alumno -->
            <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addalumnoModalLabel">Agregar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="cursoForm">

                      <div class="mb-3">
                        <label for="nombre" + class="form-label">Alumno:</label>
                        <select class="form-control" id="nombre" name="nombre" required>
                          <option value="usuario_id">Seleccione un alumno</option>
                        </select>
                      </div>

                      <button type="submit" class="btn btn-primary">Guardar cambios</button>
                      <button type="button" type="button " class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--grafica-->
        <div class="col-lg-4 col-md-6">
          <div class="card shadow h-75">
            <div class="card-header pb-0">
              <h6 class="text-secondary font-weight-bold mb-0">Grafica</h6>
              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            </div>
            <div style="position: relative; height: 400px;">
              <canvas id="miGrafico"></canvas>
            </div>
            <script>
              function obtenerCursoId() {
                const params = new URLSearchParams(window.location.search);
                return params.get('curso_id');
              }
              async function obtenerDatos(cursoId) {
                try {
                  if (!cursoId) throw new Error("ID del curso no proporcionado");
                  const response = await fetch(`reportca.php?curso_id=${cursoId}`);
                  if (!response.ok) throw new Error("Error en la respuesta del servidor");
                  return await response.json();
                } catch (error) {
                  console.error("Error al obtener los datos:", error);
                  return {
                    labels: [],
                    data: []
                  };
                }
              }

              async function crearGrafico() {
                const cursoId = obtenerCursoId();
                const datos = await obtenerDatos(cursoId);

                const ctx = document.getElementById('miGrafico').getContext('2d');
                new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: datos.labels,
                    datasets: [{
                      label: 'Estado de Calificaciones',
                      data: datos.data,
                      backgroundColor: [
                      'rgba(75, 192, 75, 0.5)', 
                      'rgba(255, 75, 75, 0.5)' 
                    ],
                    borderColor: [
                      'rgba(75, 192, 75, 1)', 
                      'rgba(255, 75, 75, 1)' 
                    ],
                    borderWidth: 2
                    }]
                  },
                  options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'top'
                      },
                      tooltip: {
                        callbacks: {
                          label: function(tooltipItem) {
                            const total = datos.data.reduce((acc, curr) => acc + curr, 0);
                            const porcentaje = ((tooltipItem.raw / total) * 100).toFixed(2);
                            return `${tooltipItem.label}: ${tooltipItem.raw} (${porcentaje}%)`;
                          }
                        }
                      }
                    },
                    maintainAspectRatio: false
                  }
                });
              }

              crearGrafico();
            </script>
          </div>
        </div>

        <script>
          document.getElementById('addButton').addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('addmodal'));
            document.getElementById('cursoForm').reset();
            fetch('getalumnos.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                  action: 'get_alumno',

                })
              })
              .then(response => response.json())
              .then(data => {
                console.log(data)
                if (data.status === 'success') {
                  const alumnoSelect = document.getElementById('nombre');
                  alumnoSelect.innerHTML = '';

                  data.alumno.forEach(alumno => {
                    const option = document.createElement('option');
                    option.value = alumno.usuario_id;
                    option.textContent = alumno.nombre;
                    alumnoSelect.appendChild(option);
                  });
                }
              });
            modal.show();
          });

          document.getElementById('cursoForm').addEventListener('submit', function(event) {
            event.preventDefault();
            saveAddAlumno('create');
          });

          function saveAddAlumno() {
            const urlParams = new URLSearchParams(window.location.search);
            console.log(urlParams)
            const formData = new FormData(document.getElementById('cursoForm'));
            formData.append('action', 'create');
            if (urlParams.has('curso_id')) {
              const cursoId = urlParams.get('curso_id');
              formData.append('curso_id', cursoId);
            } else {
              console.log('No se encontró el parámetro "curso_id" en la URL.');
            }

            fetch('getalumnos.php', {
                method: 'POST',
                body: formData,
              })
              .then(response => response.json())
              .then(data => {
                console.log(data)
                if (data.status === 'success') {
                  alert('Alumno agregado exitosamente');
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
  </main>
  <script src="../assets/js/core/bootstrap.min.js"></script>
</body>
<?php
include 'footer.php'
?>