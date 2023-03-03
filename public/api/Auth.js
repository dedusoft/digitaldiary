// UI Elements
const API_URL = "http://localhost:8080/api";

// FORMS
const formLogin = "#formLogin";
const formRegistration = "#formRegistration";

// BUTTONS
const btnLogin = "#btnLogin";

// FORM DATA
const email = "#email";
const password = "#password";
const passwordConfirm = "#passwordConfirm";


const handlerLogin = () => {
    $(formLogin).on('submit', (e) => {
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
                $(btnLogin).text('Validating ...');
                $(btnLogin).attr('disabled', true);
            },
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.href = 'http://localhost:8080/dashboard';
                    }, 1000);
                }
                if (response.error) {
                    $(btnLogin).text('Login');
                    $(btnLogin).attr('disabled', false);

                    if (response.errorEmail !== '') {
                        toastr.error(response.errorEmail);

                    }

                    if (response.errorPassword !== '') {
                        toastr.error(response.errorPassword);
                    }
                }
            }
        });

    });
}


const handlerRegistration = () => {
    $(formLogin).on('submit', (e) => {
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
                $(btnLogin).text('Validating ...');
                $(btnLogin).attr('disabled', true);
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
                    $(btnLogin).text('Login');
                    $(btnLogin).attr('disabled', false);

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
    // handlerRegistration();

});
