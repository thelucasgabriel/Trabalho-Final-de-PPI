function buscaEspecialidade() {
    const listaEspecialidades = document.querySelector("#espec");
    //listaEspecialidades.innerHTML = "";

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../back-end/agendamento/buscaEspecialidade.php");

    xhr.onload = function () {
        if (xhr.status == 200) {
            const especialidades = JSON.parse(xhr.responseText);

            for (let i = 0; i < especialidades.length; i++) {
                let novoOption = document.createElement("option");
                novoOption.textContent = especialidades[i];
                novoOption.value = especialidades[i];
                listaEspecialidades.appendChild(novoOption);
            }
        } else {
            console.error("Falha: " + xhr.status + xhr.responseText);
        }
    };

    xhr.onerror = () => console.log("Erro de rede");
    xhr.send();
}

function buscaMedico() {
    const listaMedicos = document.getElementById("medespec");
    listaMedicos.innerHTML = "";

    let especSelecionada = document.getElementById("espec").value;

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../back-end/agendamento/buscaMedico.php?especialidade=" + especSelecionada);

    xhr.onload = function () {
        if (xhr.status == 200) {
            const medicos = JSON.parse(xhr.responseText);

            for (let i = 0; i < medicos.length; i++) {
                let novoOption = document.createElement("option");
                novoOption.textContent = medicos[i].nome;
                novoOption.value = medicos[i].codigo;
                listaMedicos.appendChild(novoOption);
            }
        } else {
            console.error("Falha: " + xhr.status + xhr.responseText);
        }
    };

    xhr.onerror = () => console.log("Erro de rede");
    xhr.send();
}

window.onload = function () {
    buscaEspecialidade();
    const selectEspec = document.getElementById("espec");
    selectEspec.addEventListener("change", buscaMedico);
}