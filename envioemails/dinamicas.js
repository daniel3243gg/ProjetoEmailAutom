// dinamicas.js

function adicionarEmail() {
    var container = document.getElementById('emails-container');

    if (!container) {
        console.error("Elemento 'emails-container' não encontrado.");
        return;
    }

    var novaCaixaEmail = document.createElement('div');
    novaCaixaEmail.className = 'caixa-email';

    var label = document.createElement('label');
    label.htmlFor = 'email' + (container.childElementCount + 1);
    label.textContent = 'Insira o próximo e-mail:';

    var input = document.createElement('input');
    input.type = 'email';
    input.id = 'email' + (container.childElementCount + 1);
    input.name = 'emails[]';
    input.required = true;

    var botaoAdicionar = document.createElement('button');
    botaoAdicionar.type = 'button';
    botaoAdicionar.textContent = '+';
    botaoAdicionar.onclick = adicionarEmail;

    var botaoRemover = document.createElement('button');
    botaoRemover.type = 'button';
    botaoRemover.textContent = '-';
    botaoRemover.onclick = removerUltimoEmail;

    novaCaixaEmail.appendChild(label);
    novaCaixaEmail.appendChild(input);
    novaCaixaEmail.appendChild(botaoAdicionar);
    novaCaixaEmail.appendChild(botaoRemover);

    container.appendChild(novaCaixaEmail);
}

function removerUltimoEmail() {
    var container = document.getElementById('emails-container');

    if (!container) {
        console.error("Elemento 'emails-container' não encontrado.");
        return;
    }

    var caixasEmail = container.getElementsByClassName('caixa-email');

    if (caixasEmail.length > 1) {
        container.removeChild(caixasEmail[caixasEmail.length - 1]);
    }
}

function limparECriar() {
    console.log('entrou')
    document.cookie = "login=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    // Redireciona para outra página (substitua 'outra_pagina.html' pelo URL desejado)
    window.location.href = "../index.html";
} 


function exibirCaixaDeTexto() {
    document.getElementById('caixaAdicionarTemplate').style.display = 'block';
}
function envio_for(){
    
}



function adicionarNovoTemplate() {
    var novoTemplate = document.getElementById('novoTemplate').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'templates/criatemplate.php', true);
    
    // Use 'application/x-www-form-urlencoded' como Content-Type
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Solicitação POST bem-sucedida. Resposta:', xhr.responseText);
            // Faça algo com a resposta, se necessário
        } else {
            console.error('Erro na solicitação POST. Status:', xhr.status);
        }
    };

    var data = 'novoTemplate=' + encodeURIComponent(novoTemplate);
    xhr.send(data);

    // Feche a caixa de texto após a solicitação ser enviada (opcional)
    document.getElementById('caixaAdicionarTemplate').style.display = 'none';
}





// Função para exibir a caixa para adicionar um novo template
function exibirCaixaAdicionarTemplate() {
    var caixaAdicionarTemplate = document.getElementById('caixaAdicionarTemplate');
    caixaAdicionarTemplate.style.display = 'block';
}

// Função para esconder a caixa para adicionar um novo template
function esconderCaixaAdicionarTemplate() {
    var caixaAdicionarTemplate = document.getElementById('caixaAdicionarTemplate');
    caixaAdicionarTemplate.style.display = 'none';
}

// Função para carregar a lista de templates
function carregarTemplates() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "templates/listar_templates.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var templates = JSON.parse(xhr.responseText);
            popularOpcoesDeSelecao(templates);
        } else {
            console.error('Erro ao carregar a lista de templates. Status:', xhr.status);
        }
    };
    xhr.send();
}

// Função para popular as opções de seleção no HTML
function popularOpcoesDeSelecao(templates) {
    var selectElement = document.getElementById('template');

    // Limpar opções existentes
    selectElement.innerHTML = '';

    // Adicionar uma opção padrão
    var optionDefault = document.createElement('option');
    optionDefault.value = ''; // Valor vazio
    optionDefault.textContent = 'Selecione um template';
    selectElement.appendChild(optionDefault);

    // Adicionar opções com base nos templates existentes
    templates.forEach(function (template) {
        var option = document.createElement('option');
        option.value = template;
        option.textContent = template;
        selectElement.appendChild(option);
    });
}

// Chamar a função para carregar os templates quando a página é carregada
document.addEventListener('DOMContentLoaded', function () {
    carregarTemplates();
});
