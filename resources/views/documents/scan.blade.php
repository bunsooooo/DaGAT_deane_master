@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/css/qrpage.css', 'resources/js/sidebar.js'])
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{ asset('css/qrpage.css') }}">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document Verification</title>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100" id="background">
  <div id="white" class="container text-center bg-white p-3 rounded shadow">
    <div class="row mb-4 justify-content-center">
      <div class="col-12 col-md-6">
        <img src="{{ asset('assets/school.png') }}" alt="Council Logos" class="img-fluid mx-2" style="max-height: 280px;">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col">
        <form method="POST" action="{{ route('documents.verify', $qrCode->id) }}">
          @csrf
          <h1>DaGat</h1>
          <p class="dts">A Document Tracking System for the CIC Local Council</p>
          <div class="file-name font-weight-bold">
            {{ $document->Description }}
          </div>
          <p>Please, Enter your Office Pin!</p>
          <div id="error-message" class="text-danger mb-3"></div>
          <div class="row justify-content-center">
            <div class="col-auto">
              <div class="input-wrapper">
                <input type="password" class="form-control text-center" id="pin-input" name="office_pin" maxlength="6">
                <i class='bx bx-hide eye-icon' id="eye-toggle"></i>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col">
              <button class="btn btn-primary w-50" id="done" type="submit">Verify</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="{{ asset('script/sidebar.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="..." crossorigin="anonymous"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const pinInput = document.getElementById('pin-input');
      const eyeToggle = document.getElementById('eye-toggle');
      eyeToggle.addEventListener('click', () => {
        const isPassword = pinInput.type === 'password';
        pinInput.type = isPassword ? 'text' : 'password';
        pinInput.style.webkitTextSecurity = isPassword ? 'none' : 'disc';
        eyeToggle.classList.toggle('bx-hide');
        eyeToggle.classList.toggle('bx-show');
      });
    });
  </script>
</body>
</html>
