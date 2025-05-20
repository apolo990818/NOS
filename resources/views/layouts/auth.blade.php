<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Login')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
            
            background-size: cover;
        }

        /* Overlay to darken the image */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 50, 0.6); /* Dark blue overlay */
            z-index: -1;
        }

        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.3);
            max-width: 450px;
            width: 100%;
        }

        .card-body {
            padding: 3rem 2.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #0d1b2a;
        }

        .btn-primary {
            background-color: #0d1b2a;
            border: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1b3a60;
        }

        .form-control-lg {
            border-radius: 0.5rem;
            border: 1.5px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control-lg:focus {
            border-color: #0d1b2a;
            box-shadow: 0 0 5px rgba(13, 27, 42, 0.5);
            outline: none;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }

        /* Icon spacing */
        .form-label i {
            margin-right: 0.5rem;
            color: #0d1b2a;
        }
    </style>
</head>
<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
