try {
    document.getElementById('show-password').addEventListener('click', function(){
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('show-password');

        // Verifica el tipo actual del input
        if (passwordInput.type === 'password') {
            // Si es de tipo password, lo cambia a tipo text
            passwordInput.type = 'text';
            icon.textContent = '🙈'; // Cambia el icono cuando se muestre la contraseña
            return;
        }
        // Si es de tipo text, lo cambia a tipo password
        passwordInput.type = 'password';
        icon.textContent = '👁️'; // Cambia el icono cuando se oculte la contraseña
    })
} catch (error) {}
