@include('layout.header')

@include('layout.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createUserModal">Tambah User</button>

            <!-- Table displaying users -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar User</h3>
                        </div>
                        <div class="card-body">
                            <table id="usersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>NISN/NIP</th>
                                        <th>Kelas</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->nisn ?? $user->nip }}</td>
                                        <td>{{ $user->kelas ? $user->kelas->nama_kelas : '-' }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('datauser.store') }}" method="POST">
                    @csrf

                    <!-- Role Selection to Toggle Form -->
                    <div class="form-group">
                        <label for="user_type">Tipe User</label>
                        <select id="user_type" class="form-control" onchange="toggleForm()">
                            <option value="siswa">Siswa</option>
                            <option value="guru">Guru/Pegawai</option>
                        </select>
                    </div>

                    <!-- Form for Siswa -->
                    <div id="form-siswa">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" name="nisn" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" name="nis" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <select name="kelas_id" class="form-control" required>
                                <option>PILIH KELAS</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select name="role_id" class="form-control" required>
                                @foreach ($roles as $role)
                                    @if ($role->name == 'Siswa')
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Form for Guru/Pegawai -->
                    <div id="form-guru" style="display: none;">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select name="role_id" class="form-control" required>
                                <option>PILIH GURU / PEGAWAI</option>
                                @foreach ($roles as $role)
                                    @if ($role->name == 'Guru' || $role->name == 'Pegawai')
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah User</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')

<script>
    function toggleForm() {
        var userType = document.getElementById('user_type').value;
        if (userType === 'siswa') {
            document.getElementById('form-siswa').style.display = 'block';
            document.getElementById('form-guru').style.display = 'none';
        } else {
            document.getElementById('form-siswa').style.display = 'none';
            document.getElementById('form-guru').style.display = 'block';
        }
    }
</script>