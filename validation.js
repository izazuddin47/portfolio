/**
 * Administrative Form validations (Client-side)
 * Handles registration, login inputs and visual feedback markers.
 */
document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');

    // ─── ADMIN REGISTRATION CLIENT VALIDATIONS ───
    if (registerForm) {
        const fullNameInput = document.getElementById('full_name');
        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');

        registerForm.addEventListener('submit', function (e) {
            let isValid = true;

            // Full Name validation
            if (fullNameInput.value.trim().length < 3) {
                showError(fullNameInput, 'Full Name must be at least 3 characters long.');
                isValid = false;
            } else if (fullNameInput.value.trim().length > 100) {
                showError(fullNameInput, 'Full Name cannot exceed 100 characters.');
                isValid = false;
            } else {
                showSuccess(fullNameInput);
            }

            // Username validation
            const usernameRegex = /^[a-zA-Z0-9_]{3,30}$/;
            if (!usernameRegex.test(usernameInput.value.trim())) {
                showError(usernameInput, 'Username must be 3-30 characters long and contain only letters, numbers, or underscores.');
                isValid = false;
            } else {
                showSuccess(usernameInput);
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                showError(emailInput, 'Please enter a valid email address format.');
                isValid = false;
            } else {
                showSuccess(emailInput);
            }

            // Password validation
            if (passwordInput.value.length < 8) {
                showError(passwordInput, 'Password must be at least 8 characters long.');
                isValid = false;
            } else {
                showSuccess(passwordInput);
            }

            // Password Confirm validation
            if (passwordInput.value !== confirmPasswordInput.value) {
                showError(confirmPasswordInput, 'Passwords do not match.');
                isValid = false;
            } else if (confirmPasswordInput.value === '') {
                showError(confirmPasswordInput, 'Please confirm your password.');
                isValid = false;
            } else {
                showSuccess(confirmPasswordInput);
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Realtime Inline validation events
        fullNameInput.addEventListener('input', () => {
            if (fullNameInput.value.trim().length >= 3 && fullNameInput.value.trim().length <= 100) {
                showSuccess(fullNameInput);
            }
        });
        usernameInput.addEventListener('input', () => {
            const usernameRegex = /^[a-zA-Z0-9_]{3,30}$/;
            if (usernameRegex.test(usernameInput.value.trim())) {
                showSuccess(usernameInput);
            }
        });
        emailInput.addEventListener('input', () => {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailRegex.test(emailInput.value.trim())) {
                showSuccess(emailInput);
            }
        });
        passwordInput.addEventListener('input', () => {
            if (passwordInput.value.length >= 8) {
                showSuccess(passwordInput);
            }
            if (confirmPasswordInput.value.length > 0) {
                if (passwordInput.value === confirmPasswordInput.value) {
                    showSuccess(confirmPasswordInput);
                } else {
                    showError(confirmPasswordInput, 'Passwords do not match.');
                }
            }
        });
        confirmPasswordInput.addEventListener('input', () => {
            if (passwordInput.value === confirmPasswordInput.value) {
                showSuccess(confirmPasswordInput);
            } else {
                showError(confirmPasswordInput, 'Passwords do not match.');
            }
        });
    }

    // ─── ADMIN LOGIN CLIENT VALIDATIONS ───
    if (loginForm) {
        const loginInput = document.getElementById('login');
        const passwordInput = document.getElementById('password');

        loginForm.addEventListener('submit', function (e) {
            let isValid = true;

            if (loginInput.value.trim() === '') {
                showError(loginInput, 'Username or Email is required.');
                isValid = false;
            } else {
                showSuccess(loginInput);
            }

            if (passwordInput.value === '') {
                showError(passwordInput, 'Password is required.');
                isValid = false;
            } else {
                showSuccess(passwordInput);
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        loginInput.addEventListener('input', () => {
            if (loginInput.value.trim() !== '') {
                showSuccess(loginInput);
            }
        });
        passwordInput.addEventListener('input', () => {
            if (passwordInput.value !== '') {
                showSuccess(passwordInput);
            }
        });
    }

    // ─── VISUAL INDICATOR HELPERS ───
    function showError(element, message) {
        element.classList.add('is-invalid-custom', 'is-invalid');
        element.classList.remove('is-valid');
        
        const parent = element.closest('.form-group-custom');
        let feedback = parent.querySelector('.invalid-feedback-custom');
        
        if (!feedback) {
            feedback = document.createElement('div');
            feedback.className = 'invalid-feedback-custom invalid-feedback';
            parent.appendChild(feedback);
        }
        
        feedback.innerText = message;
        feedback.style.display = 'block';
    }

    function showSuccess(element) {
        element.classList.remove('is-invalid-custom', 'is-invalid');
        element.classList.add('is-valid');
        
        const parent = element.closest('.form-group-custom');
        const feedback = parent.querySelector('.invalid-feedback-custom');
        if (feedback) {
            feedback.style.display = 'none';
        }
    }
});
