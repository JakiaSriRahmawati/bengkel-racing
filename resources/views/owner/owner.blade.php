<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('template.navadmin')
</head>

<body>
    <div class="sidebar">
        <a href="#users">Kelola User</a>
        <a href="#owners">Kelola Owner</a>
        <a href="#cashiers">Kelola Kasir</a>
        <a href="#mechanics">Kelola Mekanik</a>
        <a href="#reports">Laporan Grafik</a>
    </div>

    <div class="main-content">
        <!-- Existing content for users, owners, cashiers, mechanics, bookings, transactions -->

        <div id="reports" class="container mt-5">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <h2 class="display-4">Laporan Grafik</h2>
                    <p class="lead">Grafik servis dan income per bulan untuk setiap owner.</p>
                </div>
                <div class="chart-container">
                    <canvas id="ownerServiceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ownerData = @json($ownerData);

            const labels = ownerData[0].monthly_data.map(data => data.month);

            const datasets = ownerData.map(owner => {
                return {
                    label: owner.owner,
                    data: owner.monthly_data.map(data => data.service_count),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    yAxisID: 'y-axis-1'
                };
            });

            const incomeDatasets = ownerData.map(owner => {
                return {
                    label: `${owner.owner} Income`,
                    data: owner.monthly_data.map(data => data.income),
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    yAxisID: 'y-axis-2'
                };
            });

            const ctx = document.getElementById('ownerServiceChart').getContext('2d');
            const ownerServiceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [...datasets, ...incomeDatasets]
                },
                options: {
                    scales: {
                        yAxes: [{
                            type: 'linear',
                            display: true,
                            position: 'left',
                            id: 'y-axis-1',
                            ticks: {
                                beginAtZero: true
                            }
                        }, {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            id: 'y-axis-2',
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                drawOnChartArea: false
                            }
                        }]
                    }
                }
            });
        });
    </script>
</body>

</html>
