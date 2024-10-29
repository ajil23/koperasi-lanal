
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
        }

        .card {
            border-radius: 1rem;
        }

        .btn-user {
            border-radius: 1.5rem;
        }

        input.form-control {
            border-radius: 1.5rem; /* Sesuaikan nilai sesuai preferensi */
        }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="p-4">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="{{ __('Name') }}"></label>
                                    <input type="text" class="form-control form-control-user" id="username" name="name" placeholder="{{ __('Name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="{{ __('Email Address') }}"></label>
                                    <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" name="email" placeholder="{{ __('Email Address') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="{{ __('Password') }}"></label>
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="{{ __('Password') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="{{ __('Confirm Password') }}"></label>
                                    <input type="password" class="form-control form-control-user" id="confirm_password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('Register') }}</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.html">Sudah punya akun? Masuk!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
