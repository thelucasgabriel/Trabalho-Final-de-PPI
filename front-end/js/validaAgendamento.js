window.onload = function () {
    document.forms.formAgendamento.onsubmit = validaForm;
}

function validaForm(e) {
    let form = e.target;
    let formValido = true;

    const formEspec = form.espec.nextElementSibling;
    const formMedEspec = form.medespec.nextElementSibling;
    const formDhconsulta = form.dhconsulta.nextElementSibling;
    const formNome = form.nome.nextElementSibling;
    const formSexo = form.sexo.nextElementSibling;
    const formEmail = form.email.nextElementSibling;
    const formTelefone = form.tel.nextElementSibling;


    formEspec.textContent = "";
    formMedEspec.textContent = "";
    formDhconsulta.textContent = "";
    formNome.textContent = "";
    formSexo.textContent = "";
    formEmail.textContent = "";
    formTelefone.textContent = "";

    if (form.espec.value === "") {
        formNome.textContent = "A especialidade deve ser selecionada."
        formValido = false
    }

    if (form.medespec.value === "") {
        formEmail.textContent = "O médico deve ser selecionado."
        formValido = false
    }

    if (form.dhconsulta.value === "") {
        formTelefone.textContent = "A data deve ser escolhida."
        formValido = false
    }

    if (form.nome.value === "") {
        formNome.textContent = "O nome deve ser preenchido."
        formValido = false
    }

    if (!form.sexo.value === "") {
        formSexo.textContent = "Um sexo deve ser escolhido."
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

    if (!formValido)
        e.preventDefault();
}