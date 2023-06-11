window.onload = function () {
    document.formCadastroMedicos.onsubmit = validaForm;
}

function validaForm(e) {
    let form = e.target;
    let formValido = true;

    const formNome = form.nome.nextElementSibling;
    const formEspec = form.espec.nextElementSibling;
    const formCrm = form.crm.nextElementSibling;

    formNome.textContent = "";
    formEspec.textContent = "";
    formCrm.textContent = "";

    if (form.nome.value === "") {
        formNome.textContent = "O nome deve ser preenchido.";
        formValido = false;
    }

    if (form.espec.value === "") {
        formEspec.textContent = "Selecione a especialidade.";
        formValido = false;
    }

    if (form.crm.value === "") {
        formCrm.textContent = "O CRM deve ser preenchido.";
        formValido = false;
    }

    if (!formValido) {
        e.preventDefault();
    }
}
