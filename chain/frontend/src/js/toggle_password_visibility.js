$(document).ready(function() {
    $('#eye_icon').click(function() {
        const passwordInput = $('#password');
        const hidePassword = $('#hide_password');
        const showPassword = $('#show_password');
        
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            hidePassword.hide();
            showPassword.show();
        } else {
            passwordInput.attr('type', 'password');
            showPassword.hide();
            hidePassword.show();
        }
    });
});