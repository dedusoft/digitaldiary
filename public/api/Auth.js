// UI Elements
const API_URL = "http://localhost:8080/api";

const loginForm = "#loginForm";
const loginBtn = "#loginBtn";
const email = "#email";
const password = "#password";
const errorPassword = "#errorPassword";
const errorEmail = "#errorEmail";


const handlerLogin = () => {
    $(loginForm).on('submit', (e) => {
        e.preventDefault();
        data = {
            'email': $(email).val(),
            'password': $(password).val(),
        };
        $.ajax({
            url: `${API_URL}/auth/login`,
            type: "post",
            data: data,
            dataType: "json",
            beforeSend: function () {

                $(loginBtn).text('Validating ...');
                $(loginBtn).attr('disabled', true);
            },
            success: function (response) {
                if (response.success) {
                    location.href = 'http://localhost:8080/dashboard';
                }
                if (response.error) {
                    $(loginBtn).text('Login');
                    $(loginBtn).attr('disabled', false);

                    if (response.error_admin_user_name !== '') {
                        $('#error_admin_user_name').text(response.error_admin_user_name);
                    } else {
                        $('#error_admin_user_name').text('');
                    }

                    if (response.error_lecturer_password !== '') {
                        $('#error_admin_password').text(response.error_admin_password);
                    }
                    else {
                        $('#error_admin_password').text('');
                    }
                }
            }
        });

    });
}


$(document).ready(function () {

    handlerLogin();

});
