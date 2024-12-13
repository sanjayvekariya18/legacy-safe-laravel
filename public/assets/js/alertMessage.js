document.addEventListener("DOMContentLoaded", function () {

    const errorFields = ['name', 'user_id', 'url', 'message', 'file', 'email', 'professional_type', 'first_name', 'last_name', 'mobile_number', 'password', 'password_confirmation', 'address1', 'address2', 'country', 'postcode'];

    errorFields.forEach(function (field) {

        setTimeout(function () {
            const errorField = document.getElementById('error-' + field);
            if (errorField) {
                errorField.style.display = 'none';
            }
        }, 3000);
    });
});
