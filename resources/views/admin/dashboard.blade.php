@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <!-- Tabs -->
            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active ps-0" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="articles-tab" data-bs-toggle="tab" href="#articles" role="tab" aria-selected="false">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="authors-tab" data-bs-toggle="tab" href="#authors" role="tab" aria-selected="false">Authors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tasks-tab" data-bs-toggle="tab" href="#tasks" role="tab" aria-selected="false">Tasks</a>
                    </li>
                </ul>
                <div>
                    <div class="btn-wrapper">
                        <a href="#" class="btn btn-outline-dark"><i class="icon-share"></i> Share</a>
                        <a href="#" class="btn btn-outline-dark"><i class="icon-printer"></i> Print</a>
                        <a href="#" class="btn btn-primary text-white"><i class="icon-download"></i> Export</a>
                    </div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content tab-content-basic">

                <!-- Overview Tab -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="statistics-details d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="statistics-title">Total Articles</p>
                                    <h3 class="rate-percentage">125</h3>
                                </div>
                                <div>
                                    <p class="statistics-title">Total Authors</p>
                                    <h3 class="rate-percentage">12</h3>
                                </div>
                                <div>
                                    <p class="statistics-title">Total Comments</p>
                                    <h3 class="rate-percentage">842</h3>
                                </div>
                                <div class="d-none d-md-block">
                                    <p class="statistics-title">Most Viewed Article</p>
                                    <h3 class="rate-percentage">Breaking News: Market Up!</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="row mt-4">
                        <div class="col-lg-8 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <h4 class="card-title">Monthly Views</h4>
                                    <canvas id="monthlyViewsChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <h4 class="card-title">Articles by Category</h4>
                                    <canvas id="categoryChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Articles Tab -->
                <div class="tab-pane fade" id="articles" role="tabpanel" aria-labelledby="articles-tab">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <h4 class="card-title">Pending Articles</h4>
                                    <div class="table-responsive mt-3">
                                        <table class="table select-table">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Author</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Market Analysis Today</td>
                                                    <td>John Doe</td>
                                                    <td>Business</td>
                                                    <td><div class="badge badge-opacity-warning">Pending</div></td>
                                                </tr>
                                                <tr>
                                                    <td>Local Elections Updates</td>
                                                    <td>Jane Smith</td>
                                                    <td>Politics</td>
                                                    <td><div class="badge badge-opacity-warning">Pending</div></td>
                                                </tr>
                                                <tr>
                                                    <td>Health Tips 2025</td>
                                                    <td>Emily Clark</td>
                                                    <td>Health</td>
                                                    <td><div class="badge badge-opacity-success">Approved</div></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Authors Tab -->
                <div class="tab-pane fade" id="authors" role="tabpanel" aria-labelledby="authors-tab">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <h4 class="card-title">Top Authors</h4>
                                    <ul class="todo-list todo-list-rounded">
                                        <li class="d-block">John Doe (25 articles) <span class="badge badge-opacity-success">★ 4.8</span></li>
                                        <li class="d-block">Jane Smith (18 articles) <span class="badge badge-opacity-success">★ 4.5</span></li>
                                        <li class="d-block">Emily Clark (12 articles) <span class="badge badge-opacity-success">★ 4.2</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tasks Tab -->
                <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <h4 class="card-title">Editor Tasks</h4>
                                    <ul class="todo-list todo-list-rounded">
                                        <li class="d-block">
                                            <input type="checkbox"> Review "Market Analysis Today" <span class="badge badge-opacity-warning">Pending</span>
                                        </li>
                                        <li class="d-block">
                                            <input type="checkbox" checked> Approve "Health Tips 2025" <span class="badge badge-opacity-success">Done</span>
                                        </li>
                                        <li class="d-block">
                                            <input type="checkbox"> Write summary for "Local Elections Updates" <span class="badge badge-opacity-warning">Pending</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- End tab-content -->
        </div> <!-- End home-tab -->
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Monthly Views Chart - Static data
    const monthlyViewsCtx = document.getElementById('monthlyViewsChart').getContext('2d');
    new Chart(monthlyViewsCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Views',
                data: [1200, 1500, 1700, 1400, 1800, 2000],
                borderColor: '#36A2EB',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.4
            }]
        },
        options: { responsive: true }
    });

    // Articles by Category Chart - Static data
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['Business', 'Politics', 'Health', 'Entertainment'],
            datasets: [{
                data: [35, 25, 20, 15],
                backgroundColor: ['#FF6384','#36A2EB','#FFCE56','#4BC0C0']
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection
