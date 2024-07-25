<!-- resources/views/documents/show.blade.php -->
@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/css/sidebar.css', 'resources/js/sidebar.js'])
@section('content')
<div class="container">
    @include('includes.sidebar')
    <link rel="icon" type="image/x-icon" href="{{ asset('images/dagat_logo.png') }}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <div class="card mt-4">
        <div class="card-header">
            <h2>Document Details</h2>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Description:</strong> <span class="text-muted">{{ $document->Description }}</span>
            </div>
            <div class="mb-3">
                <strong>Type:</strong> <span class="badge bg-info">{{ $document->documentType->DT_Type }}</span>
            </div>
            <div class="mb-3">
                <strong>Status:</strong> <span class="badge bg-success">{{ $document->status->Status_Name }}</span>
            </div>
            <div class="mb-3">
                <strong>Created At:</strong> <span class="text-muted">{{ $document->created_at }}</span>
            </div>
            <div class="mb-3">
                <strong>Approved At:</strong> <span class="text-muted">{{ $document->Date_Approved ?? 'Not yet approved' }}</span>
            </div>
            <a href="{{ asset('storage/' . $document->Document_File) }}" class="btn btn-primary" target="_blank">View Document</a>

            <h3 class="mt-4">QR Code</h3>
            @if ($document->qrcode)
                <div id="qrCodeContainer" class="text-center mt-2">
                    <img src="{{ asset('storage/' . $document->qrcode->QR_Image) }}" alt="QR Code" class="img-fluid">
                </div>
                <button class="btn btn-secondary mt-3" onclick="printQRCode()">Print QR Code</button>
            @else
                <p>No QR code available.</p>
            @endif

            <h3 class="mt-4">Signatories</h3>
            @if($document->qrcode && $document->qrcode->signatories->isNotEmpty())
                <div class="list-group">
                    @foreach($document->qrcode->signatories as $signatory)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $signatory->office->Office_Name }}
                            <span class="badge bg-{{ $signatory->Status_ID == 1 ? 'secondary' : ($signatory->Status_ID == 2 ? 'warning' : 'success') }}">
                                @if($signatory->Status_ID == 1)
                                    Pending
                                @elseif($signatory->Status_ID == 2)
                                    Received on {{ $signatory->Received_Date }}
                                @elseif($signatory->Status_ID == 3)
                                    Approved on {{ $signatory->Signed_Date }}
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No signatories available.</p>
            @endif
        </div>
    </div>
</div>

<script>
    function printQRCode() {
        var printContents = document.getElementById('qrCodeContainer').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
@endsection
