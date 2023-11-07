<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Add your common styles here -->
    <style>
        body {
            background-image: url('{{ asset('uploads/land3.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .login-container {
            /* min-height: 10vh; */
            display: flex;
            align-items: center;
            justify-content: center;
            
            /* margin-bottom: 2rem; */
        }

        .login-box {
            width: 400px !important; 
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        .password-input-group {
        position: relative;
        }

        .password-toggle-icon {
            position: absolute;
            top: 50%;
            right: 10px; /* Adjust the position as needed */
            transform: translateY(-50%);
            cursor: pointer;
        }

        /* Add any other common styles here */
    </style>

    @yield('css')
</head>

<body class="hold-transition login-page">
    <div class="login-container">
        {{-- <div class="login-box">
            @yield('content')
        </div> --}}
    </div>
    @yield('js')
</body>

</html>
