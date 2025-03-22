@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Row for status cards -->
    <div class="row">
        <!-- Draft Events Card -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Draft Events</h5>
                    <p class="card-text">10 Events</p> <!-- Contoh jumlah event -->
                </div>
            </div>
        </div>

        <!-- Published Events Card -->
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Published Events</h5>
                    <p class="card-text">15 Events</p> <!-- Contoh jumlah event -->
                </div>
            </div>
        </div>

        <!-- Completed Events Card -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Completed Events</h5>
                    <p class="card-text">8 Events</p> <!-- Contoh jumlah event -->
                </div>
            </div>
        </div>
    </div>

    <!-- Table for Latest Events -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Latest Events</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Short Desc</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Dibuat Oleh</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Event 1</td>
                                <td>Deskripsi singkat event 1</td>
                                <td>2025-02-01</td>
                                <td>2025-02-05</td>
                                <td>Draft</td>
                                <td>User 1</td>
                                <td>2025-01-30</td>
                            </tr>
                            <tr>
                                <td>Event 2</td>
                                <td>Deskripsi singkat event 2</td>
                                <td>2025-02-10</td>
                                <td>2025-02-15</td>
                                <td>Published</td>
                                <td>User 2</td>
                                <td>2025-02-03</td>
                            </tr>
                            <!-- Tambahkan baris event lainnya -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
