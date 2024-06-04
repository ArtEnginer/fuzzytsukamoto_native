<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #f06, #f79);
            font-family: 'Roboto', sans-serif;
            overflow: hidden;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 350px;
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeIn 1s ease-in-out;
        }

        .login-container h2 {
            margin-bottom: 30px;
            color: #444;
            font-size: 24px;
        }

        .login-container label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            color: #444;
            font-size: 14px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .login-container button {
            background: #f06;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s, transform 0.3s;
        }

        .login-container button:hover {
            background: #e91e63;
            transform: scale(1.05);
        }

        .login-container img {
            margin-bottom: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .background-animation {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 10em;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.1);
            animation: animateText 5s linear infinite;
            pointer-events: none;
            white-space: nowrap;
            z-index: 0;
        }

        @keyframes animateText {

            0%,
            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.1;
            }

            50% {
                transform: translate(-50%, -50%) scale(1.1);
                opacity: 0.3;
            }
        }
    </style>
</head>

<body>
    <div class="background-animation">FUZZY TSUKAMOTO</div>
    <div class="login-container">
        <!-- logo img -->
        <img src="<?= base_url() ?>/assets/images/logo.png" alt="logo" class="img-fluid" style="width: 85px;">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>

        <!-- copyright -->
        <p style="margin-top: 20px;">&copy; <?= date('Y'); ?> - Sistem Pakar Penilaian Karyawan</p>
    </div>
</body>

</html>