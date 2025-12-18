<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    >
    <title>PoultryPro - Login</title>

    <!-- Icons & Fonts -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@400;500;700&display=swap"
        rel="stylesheet"
    >

    <style>
        /* ================= RESET ================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: #f9f5e9;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* ================= BACKGROUND DECOR ================= */
        .bg-egg {
            position: fixed;
            width: 120px;
            height: 160px;
            background-color: #fff8e1;
            border-radius: 50% / 60% 60% 40% 40%;
            opacity: 0.1;
            pointer-events: none;
        }

        .bg-egg:nth-child(1) {
            top: 10%;
            left: 5%;
            width: 80px;
            height: 100px;
            transform: rotate(25deg);
        }

        .bg-egg:nth-child(2) {
            bottom: 15%;
            right: 8%;
            width: 100px;
            height: 130px;
            transform: rotate(-15deg);
        }

        .bg-feather {
            position: fixed;
            font-size: 120px;
            color: #d7b98e;
            opacity: 0.05;
            pointer-events: none;
        }

        .bg-feather:nth-child(3) {
            top: 5%;
            right: 10%;
            transform: rotate(45deg);
        }

        .bg-feather:nth-child(4) {
            bottom: 10%;
            left: 8%;
            transform: rotate(-20deg);
        }

        /* ================= MAIN CONTAINER ================= */
        .container {
            display: flex;
            max-width: 800px;
            width: 100%;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(139, 108, 66, 0.1);
            overflow: hidden;
        }

        /* ================= LEFT (ILLUSTRATION) ================= */
        .illustration-side {
            flex: 1;
            background: linear-gradient(135deg, #fef3d9, #f9e4b7);
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 550px;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            font-family: "Quicksand", sans-serif;
            font-weight: 700;
            font-size: 22px;
            color: #8b6c42;
        }

        .logo i {
            margin-right: 8px;
        }

        .chicken-container {
            width: 250px;
            height: 250px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chicken-image {
            width: 100%;
            object-fit: contain;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.1));
            animation: float 4s ease-in-out infinite;
        }

        .chicken-shadow {
            position: absolute;
            bottom: 20px;
            width: 150px;
            height: 30px;
            background: radial-gradient(
                ellipse at center,
                rgba(0, 0, 0, 0.15),
                transparent
            );
            border-radius: 50%;
            animation: shadowPulse 4s ease-in-out infinite;
        }

        .illustration-text {
            text-align: center;
            color: #8b6c42;
            max-width: 300px;
        }

        /* ================= RIGHT (LOGIN) ================= */
        .login-side {
            flex: 1;
            padding: 40px 35px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header h1 {
            font-family: "Quicksand", sans-serif;
            font-size: 26px;
            color: #5a3921;
        }

        .login-header p {
            color: #8b6c42;
            font-size: 14px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #b6956a;
        }

        .input-group input {
            width: 100%;
            padding: 13px 13px 13px 45px;
            border: 1px solid #e6d5b8;
            border-radius: 10px;
            background: #fefaf3;
        }

        .login-btn {
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(to right, #d4a55a, #b6956a);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        /* ================= ANIMATIONS ================= */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        @keyframes shadowPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(0.8); }
        }
    </style>
</head>

<body>
    <!-- Decorative Background -->
    <div class="bg-egg"></div>
    <div class="bg-egg"></div>
    <div class="bg-feather"><i class="fas fa-feather-alt"></i></div>
    <div class="bg-feather"><i class="fas fa-feather-alt"></i></div>

    <div class="container">
        <!-- Illustration Side -->
        <div class="illustration-side">
            <div class="logo">
                <i class="fas fa-egg"></i> PoultryPro
            </div>

            <div class="chicken-container">
                <div class="chicken-shadow"></div>
                <img
                    src="https://5.imimg.com/data5/SELLER/Default/2022/10/XG/JW/OZ/5477230/live-broiler-chicken-birds.png"
                    alt="Chicken"
                    class="chicken-image"
                >
            </div>

            <div class="illustration-text">
                <h2>Poultry Management Simplified</h2>
                <p>
                    Monitor flock health, track egg production,
                    manage feed inventory, and optimize operations.
                </p>
            </div>
        </div>

        <!-- Login Side -->
        <div class="login-side">
            <div class="login-header">
                <h1>Welcome Back</h1>
                <p>Sign in to access your dashboard</p>
            </div>

            <form action="{{ url('login') }}" method="POST" id="loginForm">
                @csrf

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="email" name="email" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function (e) {
            const email = this.email.value.trim();
            const password = this.password.value.trim();

            if (!email || !password) {
                e.preventDefault();
                alert("Please fill in all fields");
            }
        });
    </script>
</body>
</html>
