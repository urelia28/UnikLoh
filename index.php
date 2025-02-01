<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f6f6f6;
            margin: 0;
        }

        .container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            background: white;
            width: 800px;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            width: 50%;
        }

        .form-section h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #f9f9f9;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
            background: #fff;
        }

        .form-group .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .login-button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        .logo-section {
            width: 40%;
            text-align: center;
        }

        .logo-section img {
            max-width: 100%;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <h1>Login</h1>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">User</label>
                    <input type="text" id="username" name="username" placeholder="Masukan user anda" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukan Password anda" required>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
        <div class="logo-section">
            <img src="img/logo.png" alt="Logo">
        </div>
    </div>
</body>
</html>
