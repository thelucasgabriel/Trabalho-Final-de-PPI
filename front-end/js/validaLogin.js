window.onload = function () {
    document.forms.formLogin.onsubmit = validaForm;
}

function validaForm(e) {
    let form = e.target;
    let formValido = true;

    const formEmail = form.email.nextElementSibling;
    const formSenha = form.senha.nextElementSibling;

    formEmail.textContent = "";
    formSenha.textContent = "";


    if (form.email.value === "") {
        formEmail.textContent = "O e-mail deve ser preenchido."
        formValido = false
    }

    if (form.senha.value === "") {
        formSenha.textContent = "A senha deve ser preenchida."
        formValido = false
    }

    if (!formValido)
        e.preventDefault();
}