<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: calc(100% - 30px);
        }

        .login-container h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group .login_label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group .loigin_input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group .loigin_input:focus {
            outline: none;
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
            display: none;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <?=view('sections/error')?>
        <form id="login-form" action="<?php echo base_url('/auth/login'); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email" class='loigin_label'>Email :</label>
                <input type="email" id="email" name="email" class='loigin_input' required>
                <span class="error-message" id="email-error"></span>
            </div>
            <div class="form-group">
                <label for="password" class='loigin_label'>Mot de passe :</label>
                <input type="password" id="password" name="password" class='loigin_input' required>
                <span class="error-message" id="password-error"></span>
            </div>
            <div class="form-group">
                <button type="submit" class="submit-btn">Se connecter</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('login-form');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');

            emailInput.addEventListener('blur', function () {
                validateEmail();
            });

            passwordInput.addEventListener('blur', function () {
                validatePassword();
            });

            form.addEventListener('submit', function (event) {
                if (!validateEmail() || !validatePassword()) {
                    event.preventDefault();
                }
            });

            function validateEmail() {
                const email = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    emailError.textContent = 'Format d\'email invalide';
                    emailError.style.display = 'block';
                    return false;
                } else {
                    emailError.textContent = '';
                    emailError.style.display = 'none';
                    return true;
                }
            }

            // function validatePassword() {
            //     const password = passwordInput.value.trim();
            //     const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            //     if (!passwordRegex.test(password)) {
            //         passwordError.textContent = 'Le mot de passe doit contenir au moins 8 caractères, un chiffre et un caractère spécial';
            //         passwordError.style.display = 'block';
            //         return false;
            //     } else {
            //         passwordError.textContent = '';
            //         passwordError.style.display = 'none';
            //         return true;
            //     }
            // }
        });
    </script>
</body>
</html>
