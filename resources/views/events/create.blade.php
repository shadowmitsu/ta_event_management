@extends('layouts.app')
@section('title', 'Buat Acara')
@section('content')
    <div class="container-fluid">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Buat Event</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none"
                                        href="{{ route('dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('events.index') }}">Event</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Buat Event</li>
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

        <!-- Form untuk membuat event -->
        <div class="card">
            <div class="card-body">
                <!-- Termasuk Select2 CSS dan JS -->

                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Judul Event</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="short_desc" class="form-label">Deskripsi Singkat</label>
                        <textarea class="form-control" id="short_desc" name="short_desc" rows="3" required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="long_desc" class="form-label">Deskripsi Lengkap</label>
                        <textarea class="form-control" id="long_desc" name="long_desc" rows="5"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="draft" selected>Draft</option>
                                <option value="published">Dipublikasikan</option>
                                <option value="completed">Selesai</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="user_id" class="form-label text-xl font-semibold text-gray-700">Tugaskan Pengguna</label>
                            <div class="relative mt-2">
                                <select
                                    class="select2 form-control block w-full px-4 py-3 text-base border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    id="user_id" name="user_id[]" multiple="multiple" required style="padding: 10px;">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="media" class="form-label">Media Event</label>
                        <div id="media-uploads">
                            <div class="input-group mb-2">
                                <input type="file" class="form-control" name="media[]" required>
                                <button type="button" class="btn btn-outline-secondary" id="add-media">Tambah Lagi</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-primary">Buat Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#user_id').select2({
                    placeholder: 'Pilih Pengguna',
                    allowClear: true
                });
            });
            document.getElementById('add-media').addEventListener('click', function() {
                let mediaUpload = document.createElement('div');
                mediaUpload.className = 'input-group mb-2';
                mediaUpload.innerHTML = `
                    <input type="file" class="form-control" name="media[]" required>
                    <button type="button" class="btn btn-outline-danger remove-media">Hapus</button>
                `;
                document.getElementById('media-uploads').appendChild(mediaUpload);
            });

            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-media')) {
                    e.target.closest('.input-group').remove();
                }
            });
        </script>
    @endpush

@endsection
