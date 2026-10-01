<?php
session_start();
include 'dashboard_head.php';
include 'Bsidebar.php';
?>

<body class="g-sidenav-show  bg-gray-100">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Reporte de Calificaciones</h6>
        </nav>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <div class="row my-4">
        <div class="col-lg-8 col-md-12 mb-4">
          <div class="card shadow-lg border-0">
            <div class="card-header pb-0">
              <h6 class="text-uppercase text-secondary font-weight-bold mb-0">Calificaciones</h6>
            </div>
            <div class="card-body px-4">
              <div class="table-responsive">
                <table class="table table-hover align-items-center">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Curso</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Docente</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alumno</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Calificacion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include 'tablaBp.php'; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!--grafica-->
      <div class="col-lg-4 col-md-12">
        <div class="card shadow h-60">
          <div class="card-header pb-0">
            <h6 class="text-secondary font-weight-bold mb-0">Alumnos</h6>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          </div>
          <canvas id="miGrafico"></canvas>
          <script>
            async function obtenerDatos() {
              try {
                const response = await fetch('reportegeneral.php'); // Llama al script PHP ajustado
                if (!response.ok) throw new Error('Error en la respuesta del servidor');
                return await response.json();
              } catch (error) {
                console.error('Error al obtener los datos:', error);
                return {
                  labels: [],
                  data: []
                };
              }
            }

            async function crearGrafico() {
              const datos = await obtenerDatos();

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
                  }
                }
              });
            }

            crearGrafico();
          </script>
        </div>
      </div>
    </div>
  </main>
</body>
<?php
include 'footer.php'
?>