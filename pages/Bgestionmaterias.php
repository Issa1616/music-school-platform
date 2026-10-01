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
          <h6 class="font-weight-bolder mb-0">Gestion de Materias</h6>
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
                <h6 class="text-uppercase text-secondary font-weight-bold mb-0">Materia</h6>
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
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar materia...">
                  </div>
                </div>
                <button id="addMateriaButton" class="btn btn-primary">Agregar Materia</button>
              </div>
              <!-- Filas -->
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="dataTable"></tbody>
                </table>
                <!-- Modal para editar -->
                <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editMateriaModalLabel">Editar Materia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="editMateriaForm">
                          <input type="hidden" id="id" name="id" />

                          <div class="mb-3">
                            <label for="titulo" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required />
                          </div>

                          <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required />
                          </div>

                          <div class="mb-3">
                            <label for="cal" class="form-label">Calificacion</label>
                            <input type="text" id="cal" name="cal" class="form-control" required />
                          </div>

                          <button type="submit" class="btn btn-primary">Guardar cambios</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal para agregar -->
                <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addMateriaModalLabel">Agregar Materia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="addMateriaForm">
                          <div class="mb-3">
                            <label for="titulo" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required />
                          </div>
                          <button type="submit" class="btn btn-primary">Guardar cambios</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <script>
                  document.getElementById('dataTable').addEventListener('submit', function(event) {
                    event.preventDefault();

                    const formData = new FormData(this);

                    fetch('Bgutabla.php', {
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
                      fetch('Bgmtabla.php', {
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

                      data.forEach(materia => {
                        const row = document.createElement('tr');

                        const idCell = document.createElement('td');
                        idCell.textContent = materia.materia_id;

                        const tituloCell = document.createElement('td');
                        tituloCell.textContent = materia.titulo;

                        const editarCell = document.createElement('td');
                        const editText = document.createElement('span');
                        editText.textContent = 'Editar';
                        editText.addEventListener('click', () => editMateria(materia));

                        const borrarCell = document.createElement('td');
                        const deleteText = document.createElement('span');
                        deleteText.textContent = 'Borrar';
                        deleteText.addEventListener('click', () => deleteMateria(materia.materia_id));

                        editarCell.appendChild(editText);
                        borrarCell.appendChild(deleteText);

                        row.appendChild(tituloCell);
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

                    function editMateria(materia) {
                      document.getElementById('id').value = materia.materia_id;
                      document.getElementById('titulo').value = materia.titulo;
                      const modal = new bootstrap.Modal(document.getElementById('editmodal'));
                      modal.show();
                    }

                    document.getElementById('editMateriaForm').addEventListener('submit', function(event) {
                      event.preventDefault();
                      saveEditMateria('update');
                    })

                    document.getElementById('addMateriaButton').addEventListener('click', function() {
                      const modal = new bootstrap.Modal(document.getElementById('addmodal'));
                      document.getElementById('addMateriaForm').reset();
                      modal.show();
                    });

                    document.getElementById('addMateriaForm').addEventListener('submit', function(event) {
                      event.preventDefault();
                      saveAddMateria('create');
                    });

                    function saveAddMateria() {
                      const formData = new FormData(document.getElementById('addMateriaForm'));
                      formData.append('action', 'create');

                      fetch('Bgmtabla.php', {
                          method: 'POST',
                          body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                          if (data.status === 'success') {
                            alert('Materia agregada exitosamente');
                            const modal = bootstrap.Modal.getInstance(document.getElementById('addmodal'));
                            modal.hide();
                            loadTableData();
                          } else {
                            alert('Error: ' + data.message);
                          }
                        })
                        .catch(error => console.error('Error:', error));
                    }

                    function saveEditMateria() {
                      const formData = new FormData(document.getElementById('editMateriaForm'));
                      formData.append('action', 'update');

                      fetch('Bgmtabla.php', {
                          method: 'POST',
                          body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                          if (data.status === 'success') {
                            alert('Materia editada exitosamente');
                            const modal = bootstrap.Modal.getInstance(document.getElementById('editmodal'));
                            modal.hide();
                            loadTableData();
                          } else {
                            alert('Error: ' + data.message);
                          }
                        })
                        .catch(error => console.error('Error:', error));
                    }

                    function deleteMateria(id) {
                      if (confirm('Estas seguro que deseas borrar la materia?')) {
                        fetch('Bgmtabla.php', {
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