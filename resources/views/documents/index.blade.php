@vite(['resources/css/app.css', 'resources/css/sidebar.css'], 'resources/js/sidebar.js')
@extends('layouts.app')
<head><title> Document Tracking </title>
  <link rel="icon" type="image/x-icon" href="{{ asset('images/dagat_logo.png') }}">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  </head>

  @include('includes.sidebar')

<section class="home-section">
@section('content')
<div class="container">
    <h2>Document Tracker</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Upload Document</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Document Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{ $document->id }}</td>
                    <td>{{ $document->Description }}</td>
                    <td>{{ $document->documentType->DT_Type }}</td>
                    <td>{{ $document->status->Status_Name }}</td>
                    <td>
                        <a href="{{ route('documents.show', $document->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</section>
<script src="{{ asset('js/sidebar.js') }}"></script>
@endsection
