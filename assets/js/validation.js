var password = document.getElementById("password");
var confirm_password = document.getElementById("confirm-password");
var username = document.getElementById("username");
var id_num = document.getElementById("no-id");
var email = document.getElementById("email");
var confirm_email = document.getElementById("confirm-email");


function validatePassword() {
	if(!/^[\S]{6,}$/.test(password.value)){
		password.setCustomValidity("Password minimal 6 karakter");
	} else {
		password.setCustomValidity('');
	}
}


function unameValidation(){
	var res1 = validateUsername();
	if(res1 == 1) {
		username.setCustomValidity("Username hanya boleh mengandung huruf, angka, dan titik");
	} else {
		unameExistsCheck();
	}
}


function validateEmail() {
	if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email.value)) {
		email.setCustomValidity("Email tidak valid, coba lagi dengan email yang valid");
	} else {
		email.setCustomValidity('');
	}
}


function unameExistsCheck() {
	var data = $('#username').val();
	var result = '';
	$.post("uname-check.php", {username: data}, function(result){
		if(result != 1) {
			username.setCustomValidity("Username Sudah Diambil");
		} else {
			username.setCustomValidity('');
		}
	});
}


function confirmPassword() {
	if (password.value !== confirm_password.value) {
		confirm_password.setCustomValidity("Passwords tidak sama");
	} else {
		confirm_password.setCustomValidity('');
	}
}


function confirmEmail() {
	if (email.value !== confirm_email.value) {
		confirm_email.setCustomValidity("Email tidak sama");
	} else {
		confirm_email.setCustomValidity('');
	}
}


function validateUsername() {
    if (!/^[a-zA-Z0-9.]*$/.test(username.value)) {
        return 1;
    } else {
        return 0;
    }
}


function validateIdNum() {
	if (!/^[\d]{16,16}$/.test(id_num.value)) {
		id_num.setCustomValidity("Nomor identitas harus berupa angka sepanjang 16 karakter");
	} else {
		id_num.setCustomValidity('');
	}
}


password.onchange = validatePassword;
confirm_password.onkeyup = confirmPassword;
username.onchange = unameValidation;
id_num.onchange = validateIdNum;
email.onchange = validateEmail;
confirm_email.onkeyup = confirmEmail;

