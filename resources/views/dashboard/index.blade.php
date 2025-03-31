@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Baris untuk kartu status -->
    <div class="row">
        <!-- Kartu Event Draft -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Event Draft</h5>
                    <p class="card-text">{{ $countEventDraft }} Event</p> <!-- Contoh jumlah event -->
                </div>
            </div>
        </div>

        <!-- Kartu Event Terbit -->
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Event Terbit</h5>
                    <p class="card-text">{{ $countEventPublish }} Event</p> <!-- Contoh jumlah event -->
                </div>
            </div>
        </div>

        <!-- Kartu Event Selesai -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Event Selesai</h5>
                    <p class="card-text">{{ $countEventCompleted }} Event</p> <!-- Contoh jumlah event -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Event Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($events->isEmpty())
                        <p>Tidak ada event terbaru.</p>
                    @else
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Deskripsi Singkat</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->short_desc }}</td>
                                        <td>{{ $event->start_date }}</td>
                                        <td>{{ $event->end_date }}</td>
                                        <td>{{ ucfirst($event->status) }}</td>
                                        <td>{{ $event->createdBy->full_name }}</td>
                                        <td>{{ $event->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Laporan Event Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($reports->isEmpty())
                        <p>Tidak ada laporan terbaru.</p>
                    @else
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Pengguna</th>
                                    <th>Isi Laporan</th>
                                    <th>Link Tambahan</th>
                                    <th>Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{ $report->event->title }}</td>
                                        <td>{{ $report->createdBy->full_name }}</td>
                                        <td>{{ Str::limit($report->report_content, 100) }}</td>
                                        <td>
                                            @if($report->additional_link)
                                                <a href="{{ $report->additional_link }}" target="_blank">Lihat Link</a>
                                            @else
                                                - 
                                            @endif
                                        </td>
                                        <td>{{ $report->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
