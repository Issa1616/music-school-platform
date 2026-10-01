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
          <h6 class="font-weight-bolder mb-0">Gestion de Usuarios</h6>
        </nav>
      </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row my-4">
        <div class="col-lg-10 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                <h6 class="text-uppercase text-secondary font-weight-bold mb-0">Usuarios</h6>
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
                <button id="addUserButton" class="btn btn-primary">Agregar Usuario</button>
              </div>
              <!-- Filas -->
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Nombre de usuario</th>
                    <th>Contrasena</th>
                    <th>Rol</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="dataTable"></tbody>
              </table>
              <!-- Modal para editar usuario -->
              <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="editUserForm">
                        <input type="hidden" id="id" name="id" />

                        <div class="mb-3">
                          <label for="name" class="form-label">Nombre</label>
                          <input type="text" class="form-control" id="name" name="name" required />
                        </div>

                        <div class="mb-3">
                          <label for="lastname" class="form-label">Apellido</label>
                          <input type="text" class="form-control" id="lastname" name="lastname" required />
                        </div>

                        <div class="mb-3">
                          <label for="username" class="form-label">Nombre de usuario</label>
                          <input type="text" class="form-control" id="username" name="username" required />
                        </div>

                        <div class="mb-3">
                          <label for="password" class="form-label">Contraseña</label>
                          <input type="password" class="form-control" id="password" name="password" required />
                        </div>

                        <div class="mb-3">
                          <label for="rol" class="form-label">Rol</label>
                          <select class="form-control" id="rol" name="rol" required>
                            <option value="admin">Administrador</option>
                            <option value="docente">Docente</option>
                            <option value="alumno">Alumno</option>
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal para agregar usuario -->
              <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addMateriaModalLabel">Agregar Usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="addUserForm">

                        <div class="mb-3">
                          <label for="name" class="form-label">Nombre</label>
                          <input type="text" class="form-control" id="name" name="name" required />
                        </div>

                        <div class="mb-3">
                          <label for="lastname" class="form-label">Apellido</label>
                          <input type="text" class="form-control" id="lastname" name="lastname" required />
                        </div>

                        <div class="mb-3">
                          <label for="username" class="form-label">Nombre de usuario</label>
                          <input type="text" class="form-control" id="username" name="username" required />
                        </div>

                        <div class="mb-3">
                          <label for="password" class="form-label">Contraseña</label>
                          <input type="password" class="form-control" id="password" name="password" required />
                        </div>

                        <div class="mb-3">
                          <label for="rol" class="form-label">Rol</label>
                          <select class="form-control" id="rol" name="rol" required>
                            <option value="admin">Administrador</option>
                            <option value="docente">Docente</option>
                            <option value="alumno">Alumno</option>
                          </select>
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
                    fetch('Bgutabla.php', {
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

                    data.forEach(user => {
                      const row = document.createElement('tr');

                      const idCell = document.createElement('td');
                      idCell.textContent = user.usuario_id;

                      const nameCell = document.createElement('td');
                      nameCell.textContent = user.nombre;

                      const lastnameCell = document.createElement('td');
                      lastnameCell.textContent = user.apellido;

                      const usernameCell = document.createElement('td');
                      usernameCell.textContent = user.nombreusuario;

                      const passwordCell = document.createElement('td');
                      passwordCell.textContent = user.password;

                      const rolCell = document.createElement('td');
                      rolCell.textContent = user.rol;

                      const editarCell = document.createElement('td');
                      const editText = document.createElement('span');
                      editText.textContent = 'Editar';
                      editText.addEventListener('click', () => editUser(user));

                      const borrarCell = document.createElement('td');
                      const deleteText = document.createElement('span');
                      deleteText.textContent = 'Borrar';
                      deleteText.addEventListener('click', () => deleteUser(user.usuario_id));

                      editarCell.appendChild(editText);
                      borrarCell.appendChild(deleteText);

                      row.appendChild(nameCell);
                      row.appendChild(lastnameCell);
                      row.appendChild(usernameCell);
                      row.appendChild(passwordCell);
                      row.appendChild(rolCell);
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

                  function editUser(user) {
                    document.getElementById('id').value = user.usuario_id;
                    document.getElementById('name').value = user.nombre;
                    document.getElementById('lastname').value = user.apellido;
                    document.getElementById('username').value = user.nombreusuario;
                    document.getElementById('password').value = user.password;
                    document.getElementById('rol').value = user.rol;
                    const modal = new bootstrap.Modal(document.getElementById('editmodal'));
                    modal.show();
                  }

                  document.getElementById('editUserForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    saveEditUser('update');
                  })

                  document.getElementById('addUserButton').addEventListener('click', function(event) {
                    const modal = new bootstrap.Modal(document.getElementById('addmodal'));
                    document.getElementById('addUserForm').reset();
                    modal.show();
                  });

                  document.getElementById('addUserForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    saveAddUser('create');
                  });

                  function saveEditUser() {
                    const formData = new FormData(document.getElementById('editUserForm'));
                    formData.append('action', 'update');

                    fetch('Bgutabla.php', {
                        method: 'POST',
                        body: formData,
                      })
                      .then(response => response.json())
                      .then(data => {
                        if (data.status === 'success') {
                          alert('Usuario editado exitosamente');
                          const modal = bootstrap.Modal.getInstance(document.getElementById('editmodal'));
                          modal.hide();
                          loadTableData();
                        } else {
                          alert('Error: ' + data.message);
                        }
                      })
                      .catch(error => console.error('Error:', error));
                  }

                  function saveAddUser() {
                    const formData = new FormData(document.getElementById('addUserForm'));
                    formData.append('action', 'create');

                    fetch('Bgutabla.php', {
                        method: 'POST',
                        body: formData,
                      })
                      .then(response => response.json())
                      .then(data => {
                        if (data.status === 'success') {
                          alert('Usuario agregado exitosamente');
                          const modal = bootstrap.Modal.getInstance(document.getElementById('addmodal'));
                          modal.hide();
                          loadTableData();
                        } else {
                          alert('Error: ' + data.message);
                        }
                      })
                      .catch(error => console.error('Error:', error));
                  }

                  function deleteUser(id) {
                    if (confirm('Estas seguro que deseas Borrar al usuario?')) {
                      fetch('Bgutabla.php', {
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