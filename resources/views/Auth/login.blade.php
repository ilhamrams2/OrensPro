<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }

        .login-container {
            min-height: 100vh;
        }

        .login-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .login-image {
            background: url("https://images.unsplash.com/photo-1522071820081-009f0129c71c") center center;
            background-size: cover;
            height: 100%;
        }

        .form-section {
            padding: 50px;
        }

        .form-title {
            font-weight: 700;
        }
    </style>

</head>

<body>

    <div class="container login-container d-flex align-items-center justify-content-center">

        <div class="row login-card bg-white w-100" style="max-width:900px;">

            <!-- FORM -->
            <div class="col-md-6 form-section">

                <h3 class="form-title mb-4">Login Account</h3>

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="example@email.com" name="email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>

                    <div class="d-grid mb-3">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>

                    <p class="text-center">
                        Belum punya akun?
                        <a href="#">Register</a>
                    </p>

                </form>

            </div>

            <!-- IMAGE -->
            <div class="col-md-6 d-none d-md-block login-image">
            </div>

        </div>

    </div>

</body>

</html>
