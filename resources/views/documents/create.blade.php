@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/css/sidebar.css', 'resources/js/sidebar.js'])
@section('content')
<div class="container">
    @include('includes.sidebar')
    <link rel="icon" type="image/x-icon" href="{{ asset('images/dagat_logo.png') }}">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <h2 class="my-4">Upload Document</h2>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="description" class="form-label">Document Description</label>
            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="document_type" class="form-label">Document Type</label>
            <select name="document_type" id="document_type" class="form-control @error('document_type') is-invalid @enderror" required>
                <option value="" disabled selected>Select document type</option>
                @foreach($documentTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->DT_Type }}</option>
                @endforeach
            </select>
            @error('document_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="document_file" class="form-label">Document File</label>
            <input type="file" name="document_file" id="document_file" class="form-control @error('document_file') is-invalid @enderror" required>
            @error('document_file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="signatories" class="form-label">Signatories</label>
            <select name="signatories[]" id="signatories" class="form-control select2 @error('signatories') is-invalid @enderror" multiple required>
                @foreach($offices as $office)
                    <option value="{{ $office->id }}">{{ $office->Office_Name }}</option>
                @endforeach
            </select>
            @error('signatories')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#signatories').select2({
            placeholder: "Select signatories",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection
