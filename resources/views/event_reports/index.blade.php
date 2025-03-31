@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Bagian Header Kartu -->
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Laporan Acara</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none"
                                        href="{{ route('dashboard.index') }}">Dasbor</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Laporan Acara</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('images/breadcrumb/ChatBc.png') }}" alt="Gambar Breadcrumb"
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
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createReportModal">
            Tambah Laporan Acara
        </button>

        <div class="modal fade" id="createReportModal" tabindex="-1" aria-labelledby="createReportModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createReportModalLabel">Buat Laporan Acara</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <form id="create-report-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="event_id" class="form-label">Acara</label>
                                <select class="form-select" id="event_id" name="event_id" required>
                                    <option selected disabled>Pilih acara</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Pengguna</label>
                                <select class="form-select" id="user_id" name="user_id" required>
                                    <option selected disabled>Pilih pengguna</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="report_content" class="form-label">Konten Laporan</label>
                                <textarea class="form-control" id="report_content" name="report_content" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="additional_link" class="form-label">Tautan Tambahan</label>
                                <input type="text" class="form-control" id="additional_link" name="additional_link"
                                    placeholder="http://example.com">
                            </div>
                            <div class="form-group mb-3">
                                <label for="media" class="form-label">Media Laporan Acara</label>
                                <div id="media-uploads">
                                    <div class="input-group mb-2">
                                        <input type="file" class="form-control" name="media[]">
                                        <button type="button" class="btn btn-outline-secondary" id="add-media">Tambah
                                            Lagi</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Laporan</button>
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
                        <h5 class="modal-title" id="editReportModalLabel">Edit Laporan Acara</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-report-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_report_id" name="report_id">

                            <div class="mb-3">
                                <label for="edit_event_id" class="form-label">Acara</label>
                                <select class="form-select" id="edit_event_id" name="event_id" required>
                                    <option selected disabled>Pilih acara</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_user_id" class="form-label">Pengguna</label>
                                <select class="form-select" id="edit_user_id" name="user_id" required>
                                    <option selected disabled>Pilih pengguna</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_report_content" class="form-label">Konten Laporan</label>
                                <textarea class="form-control" id="edit_report_content" name="report_content" rows="5"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="edit_additional_link" class="form-label">Tautan Tambahan</label>
                                <input type="text" class="form-control" id="edit_additional_link"
                                    name="additional_link" placeholder="http://example.com">
                            </div>

                            <div class="form-group mb-3">
                                <label for="edit_media" class="form-label">Media Laporan Acara</label>
                                <div id="edit-media-uploads">
                                    <div class="input-group mb-2">
                                        <input type="file" class="form-control" name="files[]">
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="add-edit-media">Tambah Lagi</button>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Perbarui Laporan</button>
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
                                    <th>Judul Acara</th>
                                    <th>Tanggal Laporan</th>
                                    <th>Total Media</th>
                                    <th width="180">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="event-report-body">

                            </tbody>
                        </table>
                    </div>

                    <div id="pagination" class="mt-3">
                        <button id="prev-page" class="btn btn-primary" disabled>Sebelumnya</button>
                        <button id="next-page" class="btn btn-primary">Berikutnya</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewModalLabel">Pratinjau Media</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body" id="previewModalBody">

                    </div>
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
                                        <button type="button" class="btn btn-sm btn-danger delete-btn">Hapus</button>
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
                                    <button type="button" class="btn btn-outline-danger remove-media">Hapus</button>
                                </div>`;
                            });

                            mediaUploads.innerHTML += `
                            <div class="input-group mb-2">
                                <input type="file" class="form-control" name="media[]">
                                <button type="button" class="btn btn-outline-secondary" id="add-edit-media">Tambah Lagi</button>
                            </div>`;

                            // Show modal
                            $('#editReportModal').modal('show');
                        })
                        .catch(function(error) {
                            console.error('Error fetching report details:', error);
                            alert('Gagal memuat detail laporan.');
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
                            `<p>Preview tidak tersedia untuk tipe file ini. Unduh file <a href="${filePath}" target="_blank">di sini</a>.</p>`;
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
                        <button type="button" class="btn btn-outline-danger remove-media">Hapus</button>
                    </div>`;
                    e.target.closest('.input-group').insertAdjacentHTML('afterend', newMediaInput);
                }

                if (e.target && e.target.id === 'add-media') {
                    const newMediaInput = `
                    <div class="input-group mb-2">
                        <input type="file" class="form-control" name="media[]">
                        <button type="button" class="btn btn-outline-danger remove-media">Hapus</button>
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
                            Swal.fire('Berhasil', 'Laporan acara berhasil dibuat!', 'success');
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
                            Swal.fire('Error Validasi', errorMessages, 'error');
                        } else {
                            Swal.fire('Error', 'Terjadi kesalahan saat membuat laporan.', 'error');
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
                            Swal.fire('Berhasil', 'Laporan acara berhasil diperbarui!', 'success');
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
                            Swal.fire('Error Validasi', errorMessages, 'error');
                        } else {
                            Swal.fire('Error', 'Terjadi kesalahan saat memperbarui laporan.', 'error');
                        }
                    });
            });

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda tidak akan bisa mengembalikannya!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Tidak, batalkan!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const reportId = this.closest('.delete-form')
                                .querySelector('input[name="report_id"]').value;

                            axios.delete(`/events/${reportId}`)
                                .then(function(response) {
                                    if (response.status === 200) {
                                        Swal.fire(
                                            'Terhapus!',
                                            'Laporan telah dihapus.',
                                            'success'
                                        );
                                        this.closest('tr').remove();
                                    }
                                })
                                .catch(function(error) {
                                    Swal.fire(
                                        'Error!',
                                        'Terjadi kesalahan saat menghapus laporan.',
                                        'error'
                                    );
                                });
                        }
                    });
                });
            });
        });
    </script>
@endsection
