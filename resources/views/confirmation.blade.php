<!-- resources/views/confirmation.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Confirmation</h2>
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    <p>You have successfully updated the document status.</p>
</div>
@endsection
