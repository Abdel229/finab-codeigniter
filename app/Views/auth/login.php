<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <link rel="stylesheet" href=<?php echo base_url('styles/css/auth.css')?>>
    
</head>
<body>
    <div class="form-container">
        <h2 class='form-title'>Connexion</h2>
        <?=view('sections/error')?>
        <form id="login-form" action="<?php echo base_url('/auth/login'); ?>" method="POST" enctype="multipart/form-data">
            <div class="form__group">
                <label for="email" class='form__label'>Email :</label>
                <input type="email" id="email" name="email" class='form__input' required>
                <span class="error-message" id="email-error"></span>
            </div>
            <div class="form__group">
                <label for="password" class='form__label'>Mot de passe :</label>
                <input type="password" id="password" name="password" class='form__input' required>
                <span class="error-message" id="password-error"></span>
            </div>
            <div class="form__group">
                <button type="submit" class="form__submit-button">Se connecter</button>
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
