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

   
   