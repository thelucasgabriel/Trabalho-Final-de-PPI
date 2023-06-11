window.onload = function () {
    document.forms.formCadastroFuncionarios.onsubmit = validaForm;
}

function validaForm(e) {
    let form = e.target;
    let formValido = true;

    const formNome = form.nome.nextElementSibling;
    const formEmail = form.mail.nextElementSibling;
    const formSenha = form.senha.nextElementSibling;
    const formEstadoCivil = form.estadocivil.nextElementSibling;
    const formDataNascimento = form.datanascimento.nextElementSibling;
    const formFuncao = form.funcao.nextElementSibling;

    formNome.textContent = "";
    formEmail.textContent = "";
    formSenha.textContent = "";
    formEstadoCivil.textContent = "";
    formDataNascimento.textContent = "";
    formFuncao.textContent = "";


    if (form.nome.value === "") {
        formNome.textContent = "O nome deve ser preenchido."
        formValido = false
    }

    if (form.mail.value === "") {
        formEmail.textContent = "O e-mail deve ser preenchido."
        formValido = false
    }

    if (form.senha.value === "") {
        formSenha.textContent = "A senha deve ser preenchida."
        formValido = false
    }

    if (form.estadocivil.value === "") {
        formEstadoCivil.textContent = "O estado civil deve ser selecionado."
        formValido = false
    }

    if (form.datanascimento.value === "") {
        formDataNascimento.textContent = "A data de nascimento deve ser informada."
        formValido = false
    }

    if (form.funcao.value === "") {
        formFuncao.textContent = "A função deve ser preenchida."
        formValido = false
    }

    if (!formValido)
        e.preventDefault();
}