@extends('layouts.app')

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Pengguna</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Pengguna</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Daftar Pengguna</h5>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">
                            Tambah Pengguna</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle text-nowrap mb-0">
                        <thead>
                            <tr class="text-muted fw-semibold">
                                <th scope="col" class="ps-0">Nama Lengkap</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createUserForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pengguna Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="createFullName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="createFullName" name="full_name">
                        </div>
                        <div class="mb-3">
                            <label for="createUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="createUsername" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="createEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="createEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="createPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="createPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="createRole" class="form-label">Role</label>
                            <select class="form-control" id="createRole" name="role">
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editUserForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editUserId">
                        <div class="mb-3">
                            <label for="editFullName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="editFullName" name="full_name">
                        </div>
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="editPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-control" id="editRole" name="role">
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pengguna ini?
                    <input type="hidden" id="deleteUserId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmDeleteUser">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function loadUsers() {
            axios.get('/users/list')
                .then(response => {
                    const users = response.data.data;
                    let userRows = '';
                    users.forEach(user => {
                        userRows += `
                            <tr>
                                <td class="ps-0">
                                    <p class="mb-0 fs-3 text-dark">${user.full_name}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fs-3 text-dark">${user.username}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fs-3 text-dark">${user.email}</p>
                                </td>
                                <td>
                                    <span class="fw-semibold">${user.role}</span>
                                </td>
                                <td>
                                    <p class="fs-3 text-dark mb-0">
                                        <span class="badge ${user.status ? 'bg-success' : 'bg-danger'}">${user.status ? 'Active' : 'Inactive'}</span>
                                    </p>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="editUser(${user.id})">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})">Delete</button>
                                </td>
                            </tr>`;
                    });
                    document.getElementById('userTableBody').innerHTML = userRows;
                })
                .catch(error => console.error(error));
        }

        document.getElementById('createUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            axios.post('/users', formData)
                .then(response => {
                    loadUsers();
                    $('#createUserModal').modal('hide');
                })
                .catch(error => console.error(error));
        });

        function editUser(id) {
            axios.get(`/users/${id}`)
                .then(response => {
                    const user = response.data.data;
                    document.getElementById('editUserId').value = user.id;
                    document.getElementById('editFullName').value = user.full_name;
                    document.getElementById('editUsername').value = user.username;
                    document.getElementById('editEmail').value = user.email;
                    document.getElementById('editRole').value = user.role;
                    $('#editUserModal').modal('show');
                })
                .catch(error => console.error(error));
        }

        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('editUserId').value;

            const updatedData = {
                full_name: document.getElementById('editFullName').value,
                username: document.getElementById('editUsername').value,
                email: document.getElementById('editEmail').value,
                role: document.getElementById('editRole').value,
            };

            console.log(updatedData);
            axios.put(`/users/update/${id}`, updatedData)
                .then(response => {
                    loadUsers();
                    $('#editUserModal').modal('hide');
                })
                .catch(error => {
                    console.error(error);
                });
        });


        function deleteUser(id) {
            document.getElementById('deleteUserId').value = id;
            $('#deleteUserModal').modal('show');
        }

        document.getElementById('confirmDeleteUser').addEventListener('click', function() {
            const id = document.getElementById('deleteUserId').value;
            axios.delete(`/users/${id}`)
                .then(response => {
                    loadUsers();
                    $('#deleteUserModal').modal('hide');
                })
                .catch(error => console.error(error));
        });
        document.addEventListener('DOMContentLoaded', loadUsers);
    </script>
@endpush
