@extends('layouts.app')
@section('title', 'Event Details')

@section('content')
    <div class="container-fluid">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Event Details</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="{{ route('events.index') }}">Events</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Event Details</li>
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

        <!-- Event Details -->
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Event Title</h5>
                        <p>{{ $event->title }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Status</h5>
                        <p>{{ strtoupper($event->status) }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <h5>Short Description</h5>
                        <p>{{ $event->short_desc }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <h5>Long Description</h5>
                        <p>{{ $event->long_description }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Start Date</h5>
                        <p>{{ $event->start_date }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>End Date</h5>
                        <p>{{ $event->end_date }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <h5>Assigned Users</h5>
                        <ul>
                            @foreach ($event->users as $user)
                                <li>{{ $user->full_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <h5 class="fw-bold mb-3">Event Media</h5>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach ($event->eventMedia as $media)
                                <div class="card shadow-sm border-0" style="width: 12rem;">
                                    <img src="{{ asset('storage/'.$media->file_path) }}" class="card-img-top rounded" alt="Media {{ $media->id }}">
                                    <div class="card-body text-center">
                                        <a href="{{ asset('storage/'.$media->file_path) }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                            <i class="bi bi-eye"></i> View Media
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                

                <div class="form-group text-end">
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Back to Events</a>
                </div>
            </div>
        </div>
    </div>
@endsection
