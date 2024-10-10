@include('layout.header')

@include('layout.sidebar')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kelas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Kelas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createKelasModal">Tambah Kelas</button>

            <!-- Table displaying Kelas -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Kelas</h3>
                        </div>
                        <div class="card-body">
                            <table id="kelasTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kelas</th>
                                        <th>Nama Kelas</th>
                                        <th>Total User</th> <!-- New column for total users -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $k)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $k->kode_kelas }}</td>
                                        <td>{{ $k->nama_kelas }}</td>
                                        <td>{{ $k->users_count }}</td> <!-- Display total users count -->
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editKelasModal-{{ $k->id }}">Edit</button>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('datakelas.destroy', $k->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    
                                    <!-- Edit Kelas Modal -->
                                    <div class="modal fade" id="editKelasModal-{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="editKelasModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editKelasModalLabel">Edit Kelas</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('datakelas.update', $k->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="kode_kelas">Kode Kelas</label>
                                                            <input type="text" name="kode_kelas" class="form-control" value="{{ $k->kode_kelas }}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="nama_kelas">Nama Kelas</label>
                                                            <input type="text" name="nama_kelas" class="form-control" value="{{ $k->nama_kelas }}" required>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update Kelas</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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

<!-- Create Kelas Modal -->
<div class="modal fade" id="createKelasModal" tabindex="-1" role="dialog" aria-labelledby="createKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createKelasModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('datakelas.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_kelas">Kode Kelas</label>
                        <input type="text" name="kode_kelas" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah Kelas</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')
