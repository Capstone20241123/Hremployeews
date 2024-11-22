<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome for the eye icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>HR Document Monitoring System</title>
    <style>
        @keyframes slideFromTopToBottom {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #357CAF;
            color: #233268;
            background-size: cover;
        }

        .image-card img {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* Container to center the card vertically and horizontally */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Combined Card View: Flexbox container for side-by-side layout */
        .combined-card {
            display: flex;
            width: 100%;
            max-width: 1000px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Login Card Section: 50% width of the container, padding for form */
        .login-card {
            width: 100% !important;
            padding: 40px;
            background-color: #fff;
        }

        .form-control {
            border-radius: 4px;
        }

        /* Button styling */
        .btn-block {
            width: 100%;
        }

        /* Styling for the login form card */
        .login-card {
            width: 690px ;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            height: auto;
            background-color: white;
        }

        .login-card h4 {
            font-size: 1.25rem;
            font-weight: 500;
            color: #233268;
            text-align: center;
        }

        .form-group input {
        }

        .btn-primary {
            background-color: #3D5A5C;
            border-color: #004080;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            /* On medium screens (tablets) or below */
            .combined-card {
                flex-direction: column;
                align-items: center;
            }

            .login-card {
                width: 100%;
                padding: 20px;
            }

            .image-card {
                max-width: 100%;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 767px) {
            /* On mobile screens */
            .container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }

            .combined-card {
                flex-direction: column;
                align-items: center;
            }

            .image-card {
                max-width: 100%;
                margin-bottom: 30px;
            }

            .login-card {
                width: 90%;  /* Adjust width for smaller screens */
                padding: 15px;
            }

            .form-group input {
                font-size: 14px;
            }

            .btn-block {
                font-size: 16px;
            }

            .login-card h4 {
                font-size: 1.2rem;
            }
        }

        h4 {
            color: #233268;
        }
        .blurred-image {
        width: 100% !important;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the container without distortion */
        transition: filter 0.3s ease-in-out; /* Optional: Smooth transition for hover effect */
    }
    /* Optional: Add a hover effect to remove blur on hover */
    .blurred-image:hover {
    }

    .input-group {
        position: relative;
    }

    .input-group .eye-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    </style>

</head>

<body>

    <div id="app" class="login-container" style="color:#233268;">
        <section class="section d-flex align-items-center">
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="combined-card d-flex w-100">
                <div >
                    <img src="{{ asset('assests/image/cover.jpg') }}" alt="Logo" class="img-fluid blurred-image">
                </div>

                <div class="login-card w-50 p-4">
                    <div class="text-center" style="color:#233268; margin-bottom:10%; margin-top:10%;">
                        <h4>Sign In Form</h4>
                    </div>

                    <!-- Alerts for Success, Error, Warning -->
                    @if(session('success'))
                    <div class="alert alert-success w-100 text-center mb-3 rounded-3">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger w-100 text-center mb-3 rounded-3">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if(session('warning'))
                    <div class="alert alert-warning w-100 text-center mb-3 rounded-3">
                        {{ session('warning') }}
                    </div>
                    @endif

                    <form action="{{ route('admin.login.post') }}" method="post" class="w-100">
                        @csrf
                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email" class="h5 text-dark">Email</label>
                            <input id="email" type="email" class="form-control w-100 input-shadow" name="email" value="{{ old('email') }}" required placeholder="Enter your email" tabindex="1">
                            @error('email')
                            <div class="alert alert-danger mt-2 rounded-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password" class="h5 text-dark">Password</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control w-100 input-shadow" name="password" required placeholder="Enter your password" tabindex="2">
                                <span class="eye-icon" id="togglePassword" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password')
                            <div class="alert alert-danger mt-2 rounded-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" id="loginBtn" class="btn btn-primary btn-lg btn-block w-100 btn-hover-shadow" tabindex="4">Login</button>
                        </div>
                    </form>

                    <!-- Registration Link -->
                    @if(!$hasAdmin)
                    <div class="mt-3 fw-bold text-center">
                        <a href="{{ route('admin.register') }}" class="text-dark">Register Config Admin</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        </section>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Change to eye-slash icon
            } else {
                passwordField.type = 'password';
                toggleIcon.innerHTML = '<i class="fas fa-eye"></i>'; // Change to eye icon
            }
        }
    </script>
</body>

</html>
