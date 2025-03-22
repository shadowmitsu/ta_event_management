@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card bg-light shadow-none mb-4">
            <div class="card-body px-4 py-3">
                <h4 class="fw-semibold mb-8">Create Event Report</h4>
            </div>
        </div>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <div class="card card-body">
            <form action="{{ route('event_reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Event Select -->
                <div class="mb-3">
                    <label for="event_id" class="form-label">Event</label>
                    <select class="form-select" id="event_id" name="event_id" required>
                        <option selected disabled>Select an event</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="user_id" class="form-label">User</label>
                    <select class="form-select" id="user_id" name="user_id" required>
                        <option selected disabled>Select a user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="report_content" class="form-label">Report Content</label>
                    <textarea class="form-control" id="report_content" name="report_content" rows="5"></textarea>
                </div>

                <!-- Additional Link -->
                <div class="mb-3">
                    <label for="additional_link" class="form-label">Additional Link</label>
                    <input type="text" class="form-control" id="additional_link" name="additional_link" placeholder="http://example.com">
                </div>

                <div class="form-group mb-3">
                    <label for="media" class="form-label">Event Report Media</label>
                    <div id="media-uploads">
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" name="files[]" required>
                            <button type="button" class="btn btn-outline-secondary" id="add-media">Add More</button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit Report</button>
            </form>
        </div>
    </div>

    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#user_id').select2({
                    placeholder: 'Select Users',
                    allowClear: true
                });
            });
            document.getElementById('add-media').addEventListener('click', function() {
                let mediaUpload = document.createElement('div');
                mediaUpload.className = 'input-group mb-2';
                mediaUpload.innerHTML = `
                    <input type="file" class="form-control" name="media[]" required>
                    <button type="button" class="btn btn-outline-danger remove-media">Remove</button>
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
