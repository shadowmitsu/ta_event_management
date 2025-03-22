@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Card Header Section -->
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Event Reports</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none"
                                        href="{{ route('dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Event Reports</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('images/breadcrumb/ChatBc.png') }}" alt="Breadcrumb Image"
                                class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
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

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createReportModal">
            Add Event Report
        </button>

        <div class="modal fade" id="createReportModal" tabindex="-1" aria-labelledby="createReportModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createReportModalLabel">Create Event Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="create-report-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="event_id" class="form-label">Event</label>
                                <select class="form-select" id="event_id" name="event_id" required>
                                    <option selected disabled>Select an event</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="user_id" class="form-label">User</label>
                                <select class="form-select" id="user_id" name="user_id" required>
                                    <option selected disabled>Select a user</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="report_content" class="form-label">Report Content</label>
                                <textarea class="form-control" id="report_content" name="report_content" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="additional_link" class="form-label">Additional Link</label>
                                <input type="text" class="form-control" id="additional_link" name="additional_link"
                                    placeholder="http://example.com">
                            </div>
                            <div class="form-group mb-3">
                                <label for="media" class="form-label">Event Report Media</label>
                                <div id="media-uploads">
                                    <div class="input-group mb-2">
                                        <input type="file" class="form-control" name="media[]">
                                        <button type="button" class="btn btn-outline-secondary" id="add-media">Add
                                            More</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Report</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editReportModal" tabindex="-1" aria-labelledby="editReportModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editReportModalLabel">Edit Event Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-report-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_report_id" name="report_id">

                            <div class="mb-3">
                                <label for="edit_event_id" class="form-label">Event</label>
                                <select class="form-select" id="edit_event_id" name="event_id" required>
                                    <option selected disabled>Select an event</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_user_id" class="form-label">User</label>
                                <select class="form-select" id="edit_user_id" name="user_id" required>
                                    <option selected disabled>Select a user</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_report_content" class="form-label">Report Content</label>
                                <textarea class="form-control" id="edit_report_content" name="report_content" rows="5"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="edit_additional_link" class="form-label">Additional Link</label>
                                <input type="text" class="form-control" id="edit_additional_link"
                                    name="additional_link" placeholder="http://example.com">
                            </div>

                            <div class="form-group mb-3">
                                <label for="edit_media" class="form-label">Event Report Media</label>
                                <div id="edit-media-uploads">
                                    <div class="input-group mb-2">
                                        <input type="file" class="form-control" name="files[]">
                                        <button type="button" class="btn btn-outline-secondary" id="add-edit-media">Add
                                            More</button>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Report</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="widget-content searchable-container list mt-5">
            <div class="card card-body">
                <div id="event-report-table">
                    <div class="table-responsive">
                        <table class="table search-table align-middle text-nowrap">
                            <thead class="header-item">
                                <tr>
                                    <th>Event Title</th>
                                    <th>Date Report</th>
                                    <th>Total Media</th>
                                    <th width="180">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="event-report-body">

                            </tbody>
                        </table>
                    </div>

                    <div id="pagination" class="mt-3">
                        <button id="prev-page" class="btn btn-primary" disabled>Previous</button>
                        <button id="next-page" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewModalLabel">Media Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="previewModalBody">

                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let currentPage = 1;

                fetchEventReports(currentPage);

                function fetchEventReports(page) {
                    axios.get(`/event-reports/list?page=${page}`)
                        .then(function(response) {
                            const reports = response.data.data;
                            const totalPages = response.data.last_page;

                            let tbody = document.getElementById('event-report-body');
                            tbody.innerHTML = '';

                            reports.forEach(report => {
                                // Memotong title dan report_content menjadi 50 karakter
                                let truncatedTitle = report.event.title.length > 50 ?
                                    report.event.title.substring(0, 50) + '...' :
                                    report.event.title;

                                let truncatedContent = report.report_content.length > 50 ?
                                    report.report_content.substring(0, 50) + '...' :
                                    report.report_content;

                                let row = `
                                    <tr>
                                        <td>${truncatedTitle}</td>
                                        <td>${new Date(report.created_at).toLocaleDateString('id-ID', {
                                            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric'
                                        })}</td>
                                        <td>${report.files.length} Media</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning editReportBtn" data-id="${report.id}">
                                                Edit
                                            </button>
                                            <a href="/events/${report.id}" class="btn btn-sm btn-info">Detail</a>
                                            <form action="/events/${report.id}" method="POST" class="d-inline-block delete-form">
                                                <input type="hidden" name="report_id" value="${report.id}"> <!-- This passes the report ID -->
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                `;
                                tbody.innerHTML += row;
                            });

                            document.getElementById('prev-page').disabled = page === 1;
                            document.getElementById('next-page').disabled = page === totalPages;
                        })
                        .catch(function(error) {
                            console.error('Error fetching event reports:', error);
                        });
                }


                document.getElementById('prev-page').addEventListener('click', function() {
                    if (currentPage > 1) {
                        currentPage--;
                        fetchEventReports(currentPage);
                    }
                });

                document.getElementById('next-page').addEventListener('click', function() {
                    currentPage++;
                    fetchEventReports(currentPage);
                });

                document.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('editReportBtn')) {
                        const reportId = e.target.getAttribute('data-id');

                        axios.get(`/event-reports/${reportId}`)
                            .then(function(response) {
                                const report = response.data;

                                document.getElementById('edit_report_id').value = report.id;
                                document.getElementById('edit_event_id').value = report.event_id;
                                document.getElementById('edit_user_id').value = report.user_id;
                                document.getElementById('edit_report_content').value = report
                                    .report_content;
                                document.getElementById('edit_additional_link').value = report
                                    .additional_link;

                                let mediaUploads = document.getElementById('edit-media-uploads');
                                mediaUploads.innerHTML = '';
                                report.media_files.forEach(function(file) {
                                    let fileName = file.file_path.split('/').pop();
                                    mediaUploads.innerHTML += `
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" value="${fileName}" disabled>
                                            <button type="button" class="btn btn-outline-secondary preview-media" data-file-path="/storage/${file.file_path}">Preview</button>
                                            <button type="button" class="btn btn-outline-danger remove-media">Remove</button>
                                        </div>`;
                                });

                                mediaUploads.innerHTML += `
                                    <div class="input-group mb-2">
                                        <input type="file" class="form-control" name="media[]">
                                        <button type="button" class="btn btn-outline-secondary" id="add-edit-media">Add More</button>
                                    </div>`;

                                // Show modal
                                $('#editReportModal').modal('show');
                            })
                            .catch(function(error) {
                                console.error('Error fetching report details:', error);
                                alert('Failed to load report details.');
                            });
                    }
                });

                document.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('preview-media')) {
                        const filePath = e.target.getAttribute('data-file-path');
                        const fileExtension = filePath.split('.').pop().toLowerCase();

                        let previewContent;
                        if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                            previewContent = `<img src="${filePath}" class="img-fluid" alt="Preview Image">`;
                        } else {
                            previewContent =
                                `<p>Preview not available for this file type. Download the file <a href="${filePath}" target="_blank">here</a>.</p>`;
                        }

                        document.getElementById('previewModalBody').innerHTML = previewContent;
                        $('#previewModal').modal('show');
                    }
                });

                document.addEventListener('click', function(e) {
                    if (e.target && e.target.id === 'add-edit-media') {
                        const newMediaInput = `
                            <div class="input-group mb-2">
                                <input type="file" class="form-control" name="media[]">
                                <button type="button" class="btn btn-outline-danger remove-media">Remove</button>
                            </div>`;
                        e.target.closest('.input-group').insertAdjacentHTML('afterend', newMediaInput);
                    }

                    if (e.target && e.target.id === 'add-media') {
                        const newMediaInput = `
                            <div class="input-group mb-2">
                                <input type="file" class="form-control" name="media[]">
                                <button type="button" class="btn btn-outline-danger remove-media">Remove</button>
                            </div>`;
                        e.target.closest('.input-group').insertAdjacentHTML('afterend', newMediaInput);
                    }
                });

                document.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('remove-media')) {
                        e.target.closest('.input-group').remove();
                    }
                });

                document.getElementById('create-report-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    let formData = new FormData(this);

                    axios.post('/event-reports', formData)
                        .then(function(response) {
                            if (response.status === 201) {
                                Swal.fire('Success', 'Event report created successfully!',
                                    'success');
                                $('#createReportModal').modal('hide');
                                fetchEventReports(currentPage);
                            }
                        })
                        .catch(function(error) {
                            if (error.response && error.response.status === 422) {
                                let errors = error.response.data.errors;
                                let errorMessages = '';
                                for (let field in errors) {
                                    if (errors.hasOwnProperty(field)) {
                                        errorMessages += `${errors[field].join('<br>')}<br>`;
                                    }
                                }
                                Swal.fire('Validation Error', errorMessages, 'error');
                            } else {
                                Swal.fire('Error',
                                    'An error occurred while creating the report.', 'error');
                            }
                        });
                });

                document.getElementById('edit-report-form').addEventListener('submit', function(e) {
                    e.preventDefault();

                    let reportId = document.getElementById('edit_report_id').value;
                    let formData = new FormData(this);

                    axios.post(`/event-reports/${reportId}`, formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(function(response) {
                            if (response.status === 200) {
                                Swal.fire('Success', 'Event report updated successfully!', 'success');
                                $('#editReportModal').modal('hide');
                                fetchEventReports(currentPage);
                            }
                        })
                        .catch(function(error) {
                            if (error.response && error.response.status === 422) {
                                let errors = error.response.data.errors;
                                let errorMessages = '';
                                for (let field in errors) {
                                    if (errors.hasOwnProperty(field)) {
                                        errorMessages += `${errors[field].join('<br>')}<br>`;
                                    }
                                }
                                Swal.fire('Validation Error', errorMessages, 'error');
                            } else {
                                Swal.fire('Error', 'An error occurred while updating the report.', 'error');
                            }
                        });
                });


                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const reportId = this.closest('.delete-form')
                                    .querySelector('input[name="report_id"]').value;

                                axios.delete(`/events/${reportId}`)
                                    .then(function(response) {
                                        if (response.status === 200) {
                                            Swal.fire(
                                                'Deleted!',
                                                'The report has been deleted.',
                                                'success'
                                            );
                                            this.closest('tr').remove();
                                        }
                                    })
                                    .catch(function(error) {
                                        Swal.fire(
                                            'Error!',
                                            'There was an error deleting the report.',
                                            'error'
                                        );
                                    });
                            }
                        });
                    });
                });

            });
        </script>

    </div>
@endsection
