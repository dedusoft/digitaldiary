// UI Elements
const API_URL = "http://localhost:8080/api";

const loginForm = "#formLogin";
const loginBtn = "#btnLogin";
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
                    toastr.clear()
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.href = 'http://localhost:8080/dashboard';
                    }, 1000);
                }
                if (response.error) {
                    $(loginBtn).text('Login');
                    $(loginBtn).attr('disabled', false);

                    if (response.errorEmail !== '') {
                        toastr.error(response.errorEmail);

                    } else {
                        $(errorEmail).text('');
                    }

                    if (response.errorPassword !== '') {
                        toastr.error(response.errorPassword);
                    }
                    else {
                        $(errorPassword).text('');
                    }
                }
            }
        });

    });
}


$(document).ready(function () {

    handlerLogin();

});
