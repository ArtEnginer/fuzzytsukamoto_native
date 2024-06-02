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
            background: #1e2125;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeIn 1s ease-in-out;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #333;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-container button {
            background: #1e2125;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .login-container button:hover {
            background: #8e44ad;
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
    <div class="background-animation">MOORA</div>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>