<?php 
  session_start();
  include 'dashboard_head.php';
  include 'Asidebar.php';
  ?>
<body class="g-sidenav-show  bg-gray-100">

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Alumno</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
 
          </div>
        </div>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card shadow-lg border-0">
            <div class="card-header pb-0">
              <h6 class="text-uppercase text-secondary font-weight-bold mb-0">Mis asignaciones</h6>
            </div>
            <div class="card-body px-4">
              <div class="table-responsive">
                <table class="table table-hover align-items-center">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Curso</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Libro</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descripcion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include 'tablaasignacion.php'; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
