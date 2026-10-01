<?php
session_start();
include 'dashboard_head.php';
include 'Csidebar.php';
?>

<body class="g-sidenav-show  bg-gray-100">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
    </nav>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card shadow-lg border-0">
            <div class="card-header pb-0">
              <h6 class="text-uppercase text-secondary font-weight-bold mb-0">Reporte de calificaciones</h6>
            </div>
            <div class="card-body px-4">
              <div class="table-responsive">
                <table class="table table-hover align-items-center">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alumno</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Curso</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Calificacion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include 'tablapromedios.php'; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!--grafica-->
        <div class="col-lg-6 col-md-12">
          <div class="card shadow h-100">
            <div class="card-header pb-0">
              <h6 class="text-secondary font-weight-bold mb-0">Alumnos</h6>
              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            </div>
            <div style="position: relative; height: 400px;">
              <canvas id="miGrafico"></canvas>
            </div>
            <script>
              async function obtenerDatos() {
                try {
                  const response = await fetch('reporta.php'); // Llama al script PHP ajustado
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
                    },
                    maintainAspectRatio: false
                  }
                });
              }

              crearGrafico();
            </script>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
<?php
include 'footer.php'
?>