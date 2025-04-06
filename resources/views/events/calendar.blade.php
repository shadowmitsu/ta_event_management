@extends('layouts.app')
@section('title', 'Kalender Acara')
@section('content')
    <div class="container-fluid">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Acara</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none"
                                        href="{{ route('dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Acara</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('images/breadcrumb/event-icon.png') }}" alt="Acara"
                                class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget-content searchable-container list">
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <form class="position-relative">
                            <input type="text" class="form-control product-search ps-5" id="input-search"
                                placeholder="Cari Acara...">
                            <i
                                class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                        </form>
                    </div>
                    <div
                        class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                        <a href="{{ route('events.create') }}" id="btn-add-event"
                            class="btn btn-sm btn-info d-flex align-items-center">
                            <i class="ti ti-plus text-white me-1 fs-5"></i> Tambah Acara
                        </a>
                    </div>
                </div>
            </div>


            <div class="card card-body">
                <div class="card">
                    <div>
                        <div class="row gx-0">
                            <div class="col-lg-12">
                                <div class="p-4 calender-sidebar app-calendar">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="eventModalLabel">Detail Acara</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <p id="eventTitle"></p>
              <p id="eventDescription"></p>
              <p id="eventStartEnd"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>

    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />

        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: '/events/data/list', // Ambil data dari route /events
                    eventColor: '#378006', // Warna default untuk acara
                    eventClick: function(info) {
                        // Menampilkan detail acara di modal
                        document.getElementById('eventTitle').innerText = info.event.title;
                        document.getElementById('eventDescription').innerText = info.event.extendedProps.short_desc; // Deskripsi singkat
                        document.getElementById('eventStartEnd').innerText = "Dari " + info.event.start.toLocaleDateString() + " hingga " + info.event.end.toLocaleDateString();
        
                        // Tampilkan modal
                        var myModal = new bootstrap.Modal(document.getElementById('eventModal'));
                        myModal.show();
                    }
                });
                calendar.render();
            });
        </script>
    @endpush
@endsection
