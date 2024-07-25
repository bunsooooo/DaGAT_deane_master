<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- laravel implementation -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/dagat_logo.png') }}">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- laravel implementation -->
    @vite(['resources/css/app.css', 'resources/css/sidebar.css', 'resources/js/sidebar.js', 'resources/css/styles.css'])
</head>
<body>
    <div class="modal-overlay" id="modalOverlay">
        <section class="login-modal" id="loginModal">
            <div class="login-text">

                <!--laravel implementation -->
                <img src="{{ asset('images/dagat_logo.png') }}" alt="logo" class="logo-img modal-logo">
                <h3>By continuing to use DaGAT, you agree to the <a href="#" class="agreement">University of Southeastern Philippines' Data Privacy Statement</a></h3>
                <button class="accept-button" onclick="closeModal()">Accept</button>
            </div>
        </section>
    </div>

    <div class="content" id="content">
        <section class="login-container">
            <div class="logo">

                <!--laravel implementation -->
                <img src="{{ asset('images/dagat_logo.png') }}" alt="logo" class="logo-img">
                
                <div class="logo-text">
                    <h3>DaGAT</h3>
                    <span>A Document Tracking System for the CIC Local Council</span>
                </div>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email here..." required autofocus>
                </div>
                <div class="form-group password-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Your Password here..." required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class='bx bx-hide' id="togglePasswordIcon"></i>
                    </span>
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <button type="submit" class="login-button">LOG IN</button>
            </form>
        </section>
    </div>

    <script>
        function closeModal() {
            document.getElementById('modalOverlay').style.display = 'none';
            document.getElementById('content').classList.remove('blur');
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('content').classList.add('blur');
        });

        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePasswordIcon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove('bx-hide');
                toggleIcon.classList.add('bx-show');
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove('bx-show');
                toggleIcon.classList.add('bx-hide');
            }
        }
    </script>
</body>
</html>
