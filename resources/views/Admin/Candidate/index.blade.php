@include('layout.header')

@include('layout.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Tombol untuk menambah kandidat baru -->
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createCandidateModal">
                Tambah Kandidat
            </button>

            <!-- Tabel Kandidat -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Kandidat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="candidatesTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kandidat</th>
                                        <th>Ketua</th>
                                        <th>Wakil</th>
                                        <th>Visi</th>
                                        <th>Misi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidates as $candidate)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $candidate->name }}</td>
                                        <td>{{ $candidate->ketua ? $candidate->ketua->name : '-' }}</td>
                                        <td>{{ $candidate->wakil ? $candidate->wakil->name : '-' }}</td>
                                        <td>{{ $candidate->visi }}</td>
                                        <td>{{ $candidate->misi }}</td>
                                        <td>
                                            @if($candidate->image)
                                                <img src="{{ asset('storage/'.$candidate->image) }}" alt="Candidate Image" width="50">
                                            @else
                                                <span>Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Tombol untuk membuka modal edit kandidat -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCandidateModal-{{ $candidate->id }}">
                                                Edit
                                            </button>

                                            <!-- Tombol Delete -->
                                            <form action="{{ route('candidate.destroy', $candidate->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this candidate?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Kandidat -->
                                    <div class="modal fade" id="editCandidateModal-{{ $candidate->id }}" tabindex="-1" role="dialog" aria-labelledby="editCandidateModalLabel-{{ $candidate->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCandidateModalLabel-{{ $candidate->id }}">Edit Kandidat</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('candidate.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="name">Nama Kandidat</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $candidate->name }}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ketua_id">Ketua</label>
                                                            <select name="ketua_id" class="form-control" required>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $candidate->ketua_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="wakil_id">Wakil</label>
                                                            <select name="wakil_id" class="form-control">
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $candidate->wakil_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="visi">Visi</label>
                                                            <textarea name="visi" class="form-control" required>{{ $candidate->visi }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="misi">Misi</label>
                                                            <textarea name="misi" class="form-control" required>{{ $candidate->misi }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="image">Gambar Kandidat</label>
                                                            <input type="file" name="image" class="form-control">
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update Kandidat</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit Kandidat -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('layout.footer')

<!-- Modal Tambah Kandidat -->
<div class="modal fade" id="createCandidateModal" tabindex="-1" role="dialog" aria-labelledby="createCandidateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCandidateModalLabel">Tambah Kandidat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('candidate.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Kandidat</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="ketua_id">Ketua</label>
                        <select name="ketua_id" class="form-control" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="wakil_id">Wakil</label>
                        <select name="wakil_id" class="form-control">
                            <option value="">Pilih Wakil (Opsional)</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="visi">Visi</label>
                        <textarea name="visi" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="misi">Misi</label>
                        <textarea name="misi" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Kandidat</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah Kandidat</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End Modal Tambah Kandidat -->

<!-- Script untuk inisialisasi DataTables -->
<script>
    $(function () {
        $('#candidatesTable').DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            "searching": true,
        });
    });
</script>
