<?php
include 'dashboard_head.php';
include 'Bsidebar.php';
?>

<body class="g-sidenav-show  bg-gray-100">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Gestion de cursos</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="https://www.creative-tim.com/builder?ref=navbar-soft-ui-dashboard">Online Builder</a>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Cursos</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">Escribe algo</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <button id="addCursoButton" class="btn btn-primary">Agregar Curso</button>
                <!-- Filas -->
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>Curso</th>
                      <th>Materia</th>
                      <th>Docente</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="dataTable"></tbody>
                </table>
                <!-- Modal para editar curso -->
                <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editCursoModalLabel">Editar Curso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="cursoForm">
                          <input type="hidden" id="id" name="id" />

                          <div class="mb-3">
                            <label for="titulo" class="form-label">Materia:</label>
                            <select class="form-control" id="titulo" name="titulo" required>
                              <option value="materia_id">Seleccione una materia</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="nombre" + class="form-label">Docente:</label>
                            <select class="form-control" id="nombre" name="nombre" required>
                              <option value="usuario_id">Seleccione un docente</option>
                            </select>
                          </div>
                          <div class="text-end">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            <button class="btn btn-secondary" data-bs-dismiss="editmodal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {

    function loadTableData() {
      // Realiza una solicitud con la acción 'read' para obtener los datos
      fetch('Bgctabla.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            action: 'read'
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            populateTable(data.data);
          } else {
            console.error(data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }

    function populateTable(data) {
      const tableBody = document.getElementById('dataTable');
      tableBody.innerHTML = ''; // Limpiar la tabla antes de llenarla

      data.forEach(curso => {
        const row = document.createElement('tr');

        // Crear celdas 
        const idCell = document.createElement('td');
        idCell.textContent = curso.curso_id;

        const titleCell = document.createElement('td');
        titleCell.textContent = curso.titulo;

        const nameCell = document.createElement('td');
        nameCell.textContent = curso.nombre + " " + curso.apellido;

        const editarCell = document.createElement('td');
        const editText = document.createElement('span');
        editText.textContent = 'Editar';
        editText.addEventListener('click', () => editCurso(curso));

        const borrarCell = document.createElement('td');
        const deleteText = document.createElement('span');
        deleteText.textContent = 'Borrar';
        deleteText.addEventListener('click', () => deleteCurso(curso.curso_id));

        editarCell.appendChild(editText);
        borrarCell.appendChild(deleteText);

        // Añadir celdas a la fila
        row.appendChild(idCell);
        row.appendChild(titleCell);
        row.appendChild(nameCell);
        row.appendChild(editarCell);
        row.appendChild(borrarCell);
        // Añadir fila a la tabla
        tableBody.appendChild(row);
      });
    }

    // Función para editar un curso
    function editCurso(curso) {
      document.getElementById('id').value = curso.curso_id;
      document.getElementById('titulo').value = curso.titulo;
      document.getElementById('nombre').value = curso.nombre + " " + curso.apellido;

      fetch('Bgctabla.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams({
            action: 'get_materias',
            idcurso:curso.curso_id
          }),
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            const materiaseleccionada = parseInt(data.materiaseleccionada.materia_id) 
            const materiaSelect = document.getElementById('titulo');
            materiaSelect.innerHTML = ''; // Limpiar opciones

            data.materias.forEach(materia => {
              const option = document.createElement('option');
              option.value = materia.materia_id;
              option.textContent = materia.titulo;
              
              if (parseInt(materia.materia_id) === materiaseleccionada) {
                option.selected = true;
              }
              materiaSelect.appendChild(option);
            });
          }
        });

        //obtener docentes
        fetch('Bgctabla.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams({
            action: 'get_docente',
            idcurso:curso.curso_id
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            const docenteseleccionado = parseInt(data.docenteseleccionado.usuario_id) 
            const docenteSelect = document.getElementById('nombre');
            docenteSelect.innerHTML = ''; // Limpiar opciones

            data.docente.forEach(docente => {
              const option = document.createElement('option');
              option.value = docente.usuario_id;
              option.textContent = docente.nombre;
              console.log(docente.usuario_id)
              console.log(docenteseleccionado)
              if (parseInt(docente.usuario_id) === docenteseleccionado) {
                option.selected = true;
              }
              docenteSelect.appendChild(option);
            });
          }
        });

      const modal = new bootstrap.Modal(document.getElementById('editmodal'));
      modal.show();
    }

    // Envío del formulario del modal
      document.getElementById('cursoForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevenir el envío tradicional del formulario

      // Crear los datos a enviar
      const formData = new FormData(this);
      formData.append('action', 'update'); // Indicar que es una actualización
        for (const [key, value] of formData.entries()) {
          console.log(${key}: ${value});
      }
      //Enviar los datos al servidor
      fetch('Bgctabla.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.status === 'success') {
              // Cerrar el modal
              const modal = bootstrap.Modal.getInstance(document.getElementById('editmodal'));
              modal.hide();

              // Recargar la tabla con los datos actualizados
              loadTableData();
          } else {
              alert('Error al actualizar el usuario: ' + data.message);
          }
      })
      .catch(error => {
          console.error('Error:', error);
          alert('Ocurrió un error al actualizar el usuario.');
      });
    })

      //Agregar
      document.getElementById('addCursoButton').addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('editmodal'));
        const form = document.getElementById('cursoForm');
        
        form.reset(); // Limpiar el formulario
        document.getElementById('id').value = ''; // No se usará en "Agregar"
        document.getElementById('editCursoModalLabel').textContent = 'Agregar Curso'; // Cambiar título del modal
        document.querySelector('button[type="submit"]').textContent = 'Agregar'; // Cambiar texto del botón
        document.querySelector('button[type="submit"]').onclick = function(event) {
        event.preventDefault();
        saveCurso('create'); // Llamar a la función de crear
      };
      modal.show();
    });
  

    // Función para guardar el Curso 
    function saveCurso(action) {
      const formData = new FormData(document.getElementById('cursoForm'));
      formData.append('action', action); // Establecer la acción (create o update)

      fetch('Bgutabla.php', {
          method: 'POST',
          body: formData,
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            alert(action === 'create' ? 'Curso agregado exitosamente' : 'Curso actualizado exitosamente');
            const modal = bootstrap.Modal.getInstance(document.getElementById('editmodal'));
            modal.hide();
            loadTableData(); // Recargar la tabla
          } else {
            alert('Error: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }

    // Función para eliminar un usuario
    function deleteCurso(id) {
      if (confirm('Estas seguro que deseas Borrar al usuario?')) {
        fetch('Bgctabla.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
              action: 'delete',
              id: id
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              loadTableData(); // Recargar los datos después de eliminar
            } else {
              console.error(data.message);
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }
    }

    // Llamar a la función para cargar los datos cuando se carga la página
    loadTableData();
  });
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