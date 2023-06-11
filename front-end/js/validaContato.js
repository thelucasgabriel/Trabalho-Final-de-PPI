window.onload = function () {
    document.forms.formContato.onsubmit = validaForm;
}

function validaForm(e) {
    let form = e.target;
    let formValido = true;

    const formNome = form.nome.nextElementSibling;
    const formEmail = form.email.nextElementSibling;
    const formTelefone = form.telefone.nextElementSibling;
    const formMensagem = form.mais.nextElementSibling;


    formNome.textContent = "";
    formEmail.textContent = "";
    formTelefone.textContent = "";
    formMensagem.textContent = "";

    if (form.nome.value === "") {
        formNome.textContent = "O nome deve ser preenchido."
        formValido = false
    }

    if (form.email.value === "") {
        formEmail.textContent = "O e-mail deve ser preenchido."
        formValido = false
    }

    if (form.telefone.value === "") {
        formTelefone.textContent = "O telefone deve ser preenchido."
        formValido = false
    }

    if (form.mais.value === "") {
        formMensagem.textContent = "Você deve deixar uma mensagem."
        formValido = false
    }

    if (!formValido)
        e.preventDefault();
}