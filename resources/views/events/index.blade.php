@extends('layouts.app')
@section('title', 'Acara')
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
                            <img src="{{ asset('images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif

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
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('events.create') }}" id="btn-add-event"
                                class="btn btn-sm btn-info d-flex align-items-center">
                                <i class="ti ti-plus text-white me-1 fs-5"></i> Tambah Acara
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card card-body">
                <div class="table-responsive">
                    <table class="table search-table align-middle text-nowrap">
                        <thead class="header-item">
                            <tr>
                                <th>Judul</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ Str::limit($event->title, 50, '...') }}</td>
                                    <td>{{ $event->start_date }}</td>
                                    <td>{{ $event->end_date }}</td>
                                    <td>{{ ucfirst($event->status) }}</td>
                                    <td>
                                        @if (Auth::user()->role == 'admin')
                                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">
                                                Edit
                                            </a>
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                                class="d-inline-block delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-btn">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-info">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <nav aria-label="Navigasi halaman">
                        {{ $events->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan bisa mengembalikannya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit(); // Kirim formulir
                    }
                });
            });
        });
    </script>
@endsection
