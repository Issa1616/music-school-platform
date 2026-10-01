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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Inicio</h6>
        </nav>
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
                <h6 class="text-uppercase text-secondary font-weight-bold mb-0">Cursos</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body px-4 pb-3">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="flex-grow-1" style="max-width: 300px;">
                  <div class="input-group shadow-sm">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar...">
                  </div>
                </div>
                <button id="addCursoButton" class="btn btn-primary">Agregar Curso</button>
              </div>
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
                      <form id="editCursoForm">
                        <input type="hidden" id="id" name="id" />

                        <div class="mb-3">
                          <label for="titulo" class="form-label">Materia:</label>
                          <select class="form-control" id="editartitulo" name="editartitulo" required>
                            <option value="materia_id">Seleccione una materia</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label for="nombre" + class="form-label">Docente:</label>
                          <select class="form-control" id="editardocente" name="editardocente" required>
                            <option value="usuario_id">Seleccione un docente</option>
                          </select>
                        </div>
                        <div class="text-end">
                          <button type="submit" class="btn btn-primary">Guardar cambios</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal para agregar curso -->
              <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addCursoModalLabel">Agregar Curso</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="addCursoForm">
                        <input type="hidden" id="id" name="id" />

                        <div class="mb-3">
                          <label for="titulo" class="form-label">Materia:</label>
                          <select class="form-control" id="agregartitulo" name="agregartitulo" required>
                            <option>Seleccione una materia</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label for="nombre" + class="form-label">Docente:</label>
                          <select class="form-control" id="agregardocente" name="agregardocente" required>
                            <option>Seleccione un docente</option>
                          </select>
                        </div>
                        <div class="text-end">
                          <button type="submit" class="btn btn-primary">Guardar cambios</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <script>
                document.getElementById('dataTable').addEventListener('submit', function(event) {
                  event.preventDefault();

                  const formData = new FormData(this);

                  fetch('Bgctabla.php', {
                      method: 'POST',
                      body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                      console.log('Success:', data);
                      location.reload();
                    })
                    .catch(error => {
                      console.error('Error:', error);
                    });
                });

                document.addEventListener('DOMContentLoaded', function() {

                  function loadTableData() {
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
                    tableBody.innerHTML = '';

                    data.forEach(curso => {
                      const row = document.createElement('tr');

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

                      row.appendChild(idCell);
                      row.appendChild(titleCell);
                      row.appendChild(nameCell);
                      row.appendChild(editarCell);
                      row.appendChild(borrarCell);

                      tableBody.appendChild(row);
                    });
                  }

                  document.getElementById('searchInput').addEventListener('input', filterTable);

                  function filterTable() {
                    const searchInput = document.getElementById('searchInput');
                    const filter = searchInput.value.toLowerCase();
                    const tableRows = document.querySelectorAll('#dataTable tr');

                    tableRows.forEach(row => {
                      const cells = row.querySelectorAll('td');
                      let rowMatches = false;

                      cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(filter)) {
                          rowMatches = true;
                        }
                      });
                      row.style.display = rowMatches ? '' : 'none';
                    });
                  }

                  function editCurso(curso) {
                    document.getElementById('id').value = curso.curso_id;
                    document.getElementById('editartitulo').value = curso.titulo;
                    document.getElementById('editardocente').value = curso.nombre + " " + curso.apellido;
                    //materias
                    fetch('Bgctabla.php', {
                        method: 'POST',
                        headers: {
                          'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                          action: 'get_materias',
                          idcurso: curso.curso_id
                        }),
                      })
                      .then(response => response.json())
                      .then(data => {
                        if (data.status === 'success') {
                          const materiaseleccionada = parseInt(data.materiaseleccionada.materia_id)
                          const materiaSelect = document.getElementById('editartitulo');
                          materiaSelect.innerHTML = '';

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

                    //docentes
                    fetch('Bgctabla.php', {
                        method: 'POST',
                        headers: {
                          'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                          action: 'get_docente',
                          idcurso: curso.curso_id
                        })
                      })
                      .then(response => response.json())
                      .then(data => {
                        if (data.status === 'success') {
                          const docenteseleccionado = parseInt(data.docenteseleccionado.usuario_id)
                          const docenteSelect = document.getElementById('editardocente');
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

                  document.getElementById('editCursoForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    saveEditCurso('update');
                  })

                  document.getElementById('addCursoButton').addEventListener('click', function() {
                    //materias
                    fetch('Bgctabla.php', {
                        method: 'POST',
                        headers: {
                          'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                          action: 'get_materias'
                        }),
                      })
                      .then(response => response.json())
                      .then(data => {
                        console.log(data)
                        console.log('Hola')
                        if (data.status === 'success') {
                          // const materiaseleccionada = parseInt(data.materiaseleccionada.materia_id)
                          const materiaSelect = document.getElementById('agregartitulo');
                          materiaSelect.innerHTML = ''; // Limpiar opciones

                          data.materias.forEach(materia => {
                            const option = document.createElement('option');
                            option.value = materia.materia_id;
                            option.textContent = materia.titulo;

                            // if (parseInt(materia.materia_id) === materiaseleccionada) {
                            //   option.selected = true;
                            // }
                            materiaSelect.appendChild(option);
                          });
                        }
                      });

                    //docente
                    fetch('Bgctabla.php', {
                        method: 'POST',
                        headers: {
                          'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                          action: 'get_docente',

                        })
                      })
                      .then(response => response.json())
                      .then(data => {
                        console.log(data)
                        if (data.status === 'success') {
                          // const docenteseleccionado = parseInt(data.docenteseleccionado.usuario_id)
                          const docenteSelect = document.getElementById('agregardocente');
                          docenteSelect.innerHTML = ''; // Limpiar opciones

                          data.docente.forEach(docente => {
                            const option = document.createElement('option');
                            option.value = docente.usuario_id;
                            option.textContent = docente.nombre;
                            // console.log(docente.usuario_id)
                            // console.log(docenteseleccionado)
                            // if (parseInt(docente.usuario_id) === docenteseleccionado) {
                            //   option.selected = true;
                            // }
                            docenteSelect.appendChild(option);
                          });
                        }
                      });
                    const modal = new bootstrap.Modal(document.getElementById('addmodal'));
                    document.getElementById('addCursoForm').reset();
                    modal.show();
                  });

                  document.getElementById('addCursoForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    saveAddCurso('create');
                  });

                  function saveAddCurso() {
                    const formData = new FormData(document.getElementById('addCursoForm'));
                    formData.append('action', 'create');

                    fetch('Bgctabla.php', {
                        method: 'POST',
                        body: formData,
                      })
                      .then(response => response.json())
                      .then(data => {
                        if (data.status === 'success') {
                          alert('Curso agregado exitosamente');
                          const modal = bootstrap.Modal.getInstance(document.getElementById('addmodal'));
                          modal.hide();
                          loadTableData();
                        } else {
                          alert('Error: ' + data.message);
                        }
                      })
                      .catch(error => console.error('Error:', error));
                  }

                  function saveEditCurso() {
                    const formData = new FormData(document.getElementById('editCursoForm'));
                    formData.append('action', 'update');

                    fetch('Bgctabla.php', {
                        method: 'POST',
                        body: formData,
                      })
                      .then(response => response.json())
                      .then(data => {
                        if (data.status === 'success') {
                          alert('Curso editado exitosamente');
                          const modal = bootstrap.Modal.getInstance(document.getElementById('editmodal'));
                          modal.hide();
                          loadTableData();
                        } else {
                          alert('Error: ' + data.message);
                        }
                      })
                      .catch(error => console.error('Error:', error));
                  }

                  function deleteCurso(id) {
                    if (confirm('Estas seguro que deseas Borrar este curso?')) {
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
                            loadTableData();
                          } else {
                            console.error(data.message);
                          }
                        })
                        .catch(error => {
                          console.error('Error:', error);
                        });
                    }
                  }

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
<?php
include 'footer.php'
?>