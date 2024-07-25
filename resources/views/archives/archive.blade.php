@vite(['resources/css/app.css', 'resources/css/sidebar.css'], 'resources/js/sidebar.js')
@extends('layouts.app')
<head><title> Archives </title>
  <link rel="icon" type="image/x-icon" href="{{ asset('images/dagat_logo.png') }}">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<style type="text/css">
	
</style>
  </head>

  @include('includes.sidebar')

<section class="home-section">
@section('content')
<div class="container">
    <h2>Archives</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Description</th>
                <th>Document Type</th>
                <th>Approved Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr>
                    {{-- <td>{{ $file->id }}</td> --}}
                    <td>{{ $file->name }}</td>
                    <td>{{ $file->documentType->DT_Type }}</td>
                    <td>{{ $file->approved_date->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ Storage::url($file->path) }}" target="_blank">View File</a>
                        <form action="{{ route('approved-files.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ url('/upload') }}" class="btn btn-info">Upload File</a>
</div>
</section>
<script src="{{ asset('js/sidebar.js') }}"></script>
@endsection