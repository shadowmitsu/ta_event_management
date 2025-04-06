@extends('layouts.app')
@section('title', 'Edit Acara')
@section('content')
    <div class="container-fluid">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Edit Event</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('events.index') }}">Event</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
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

        <div class="card">
            <div class="card-body">
                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Judul Event</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="short_desc" class="form-label">Deskripsi Singkat</label>
                        <textarea class="form-control" id="short_desc" name="short_desc" rows="3" required>{{ old('short_desc', $event->short_desc) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="long_desc" class="form-label">Deskripsi Panjang</label>
                        <textarea class="form-control" id="long_desc" name="long_desc" rows="5">{{ old('long_desc', $event->long_desc) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                                <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="user_id" class="form-label">Tugaskan Pengguna</label>
                            <select class="select2 form-control" id="user_id" name="user_id[]" multiple required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ in_array($user->id, old('user_id', $event->users->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $user->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $event->start_date) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $event->end_date) }}" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="media" class="form-label">Media Event</label>
                        <div id="media-uploads">
                            @foreach ($event->eventMedia as $media)
                                <div class="input-group mb-2">
                                    <input type="file" class="form-control" name="media[]">
                                    <button type="button" class="btn btn-outline-danger remove-media">Hapus</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-secondary" id="add-media">Tambah Lagi</button>
                    </div>

                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-primary">Perbarui Event</button>
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
