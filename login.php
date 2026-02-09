<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SCOLA</title>
    <link href="ui/css/cerulean.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f4f6f9 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px 0;
        }

        .login-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .login-panel {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: none;
            margin-top: 50px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-panel:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .login-header {
            background: linear-gradient(135deg, #2980b9 0%, #3498db 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 12px 12px 0 0;
        }

        .login-header .icon {
            font-size: 3rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .login-header h2 {
            margin: 0;
            font-weight: bold;
            font-size: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .login-header p {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: #2980b9;
            box-shadow: 0 0 0 3px rgba(41, 128, 185, 0.1);
            background: #ffffff;
        }

        .btn-login {
            background: linear-gradient(135deg, #2980b9 0%, #3498db 100%);
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(41, 128, 185, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(41, 128, 185, 0.4);
            background: linear-gradient(135deg, #2573a7 0%, #2980b9 100%);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e1e8ed;
        }

        .register-link a {
            color: #2980b9;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #21618c;
            text-decoration: underline;
        }

        .input-group-addon {
            background: #2980b9;
            color: white;
            border: 2px solid #2980b9;
            border-radius: 8px 0 0 8px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 0 10px;
            }

            .login-body {
                padding: 30px 20px;
            }

            .login-header h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-panel">
            <div class="login-header">
                <i class="fas fa-graduation-cap icon"></i>
                <h2>SCOLA</h2>
                <p>Sistem Pendukung Keputusan Beasiswa</p>
            </div>
            <div class="login-body">
                <form method="post" action="login-proses.php">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username Anda" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt"></i> Masuk ke Sistem
                    </button>
                </form>

                <div class="register-link">
                    <p>Belum memiliki akun? <a href="register.php">Daftar sekarang</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>