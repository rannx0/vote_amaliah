@include('layout.header')

@include('layout.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kandidat dan Total Votes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Votes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Chart Container -->
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Votes per Kandidat</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="votesChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Kandidat dan Total Votes</h3>
                        </div>
                        <div class="card-body">
                            <table id="votesTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kandidat</th>
                                        <th>Total Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidates as $candidate)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $candidate->name }}</td>
                                        <td>{{ $candidate->votes_count }}</td>
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

@include('layout.footer')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var candidates = @json($candidates->pluck('name')); // Nama kandidat
    var votesCount = @json($candidates->pluck('votes_count')); // Total votes untuk setiap kandidat

    // Random colors for each candidate to make the chart visually distinct
    var backgroundColors = candidates.map(function() {
        return 'rgba(' + Math.floor(Math.random() * 255) + ', ' + Math.floor(Math.random() * 255) + ', ' + Math.floor(Math.random() * 255) + ', 0.7)';
    });

    var ctx = document.getElementById('votesChart').getContext('2d');
    var votesChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: candidates,
            datasets: [{
                label: 'Total Votes',
                data: votesCount,
                backgroundColor: backgroundColors,
                borderColor: 'rgba(255, 255, 255, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
</script>
