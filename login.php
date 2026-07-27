<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sigma</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
            min-height: 520px; /* ටිකක් වැඩි කරන ලදී */
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 50px;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            padding-right: 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .input-group input:focus {
            border-color: rgb(156, 167, 179);
            outline: none;
        }

        .input-group label {
            position: absolute;
            top: -8px;
            left: 10px;
            background-color: #fff;
            padding: 0 5px;
            font-size: 0.9rem;
            color: #555;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: rgb(14, 14, 14);
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: rgb(6, 18, 77);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .options {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 0.9rem;
        }

        p {
            text-align: center;
            margin-top: 1.5rem;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Sigma</h2><br>
    
    <form method="POST" action="logdata.php">
        <div class="input-group">
            <input type="email" name="email" id="email" required>
            <label for="email">Email</label>
        </div>
        
        <div class="input-group">
            <input type="password" name="password" id="password" required>
            <label for="password">Password</label>
            <span class="eye-icon" id="togglePassword">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>

        <button type="submit" name="login">Login</button>
        
        <div class="options">
            <a href="#" onclick="showForgotForm()">Forgot Password?</a>
        </div>
    </form>

    <div id="forgotSection" style="display:none; margin-top: 20px; border-top: 1px solid #ddd; padding-top: 20px;">
        <p style="font-size: 0.85rem; color: #666; margin-bottom: 10px;">Enter your email to notify Admin to reset your password.</p>
        <form action="forgot_request.php" method="POST">
            <div class="input-group">
                <input type="email" name="req_email" placeholder="Your Email" required>
            </div>
            <button type="submit" style="background-color: #6c757d;">Notify Admin</button>
        </form>
    </div>

    <p>New user? <a href="student_reg.php">Register here</a></p>
</div>

<script>
    // Password Toggle Logic
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        this.innerHTML = type === 'password' ? '<i class="fa-solid fa-eye"></i>' : '<i class="fa-solid fa-eye-slash"></i>';
    });

    // Show Forgot Password Form Logic
    function showForgotForm() {
        const section = document.getElementById('forgotSection');
        section.style.display = section.style.display === 'none' ? 'block' : 'none';
    }
</script>

</body>
</html>