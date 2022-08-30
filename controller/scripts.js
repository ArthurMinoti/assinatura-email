function parseJwt (token) {
    let base64Url = token.split('.')[1];
    let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    let jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
}

function gerarAssinatura(id, nome, email){

}
function alteraAssinatura(sendAdress , assinatura) { //recebe os valores do ajax
    var email = "";
    email = String(sendAdress); //email que receberá a assinatura (vem da api de login)

    var url = "https://www.googleapis.com/gmail/v1/users/me/settings/sendAs/" + sendAdress + "?access_token=" + big_token; //url da api da goole

    var data = {};
    data.token = big_token; //big_token vem do updatesigninstatus()
    data.signature = assinatura; //assinatura gerada pelo monta_asinatura.php
    var json = JSON.stringify(data); //tranforma o vetor em string
    var xhr = new XMLHttpRequest(); //inicia o XMLHttpRequest para eviar e receber pacotes
    xhr.open("PUT", url, true); //abre a comunicação com a api do google
    xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8'); //seta um header para o request, definindo que será um json

    xhr.onload = function () { //monta o body do pacote
        var users = JSON.parse(xhr.responseText); //verifica a resposta do pacote
        if (xhr.readyState == 4 && xhr.status == "200") {
            console.log(users); //dá um retorno para o console
            document.getElementById("Texto_Sucesso").innerHTML = "Assinatura criada com sucesso!"; //exibe mensagem de sucesso
            acertaTexto(sendAdress); //chama a função para acertar o texto
        }
        else {
            console.error(users); //exibe uma mensagem de erro
            document.getElementById("Texto_Sucesso").innerHTML = "Houve um erro.<br>Entre em contato com a TI"; //exibe mesagem de erro
        }
    }
    xhr.send(json); //envia o body do pacote
}


function acertaTexto(sendAdress){
    var url1 = "https://www.googleapis.com/gmail/v1/users/me/settings/sendAs/labels/?access_token=" + big_token; //url do request da api

    var data1 = {};
    data1.token = big_token;
    data1.color = '#434343';
    var json1 = JSON.stringify(data1);
    var xhr1 = new XMLHttpRequest();
    xhr1.open("PUT", url1, true);
    xhr1.setRequestHeader('Content-type', 'application/json; charset=utf-8');

    xhr1.onload = function () {
        var users1 = JSON.parse(xhr1.responseText);
        if (xhr1.readyState == 4 && xhr1.status == "200") {
            console.log(users1);
            document.getElementById("Texto_Sucesso").innerHTML = "Concluido!";
        }
        else {
            console.error(users1);
            document.getElementById("Texto_Sucesso").innerHTML = "Houve um erro.<br>Entre em contato com a T.I";
        }
    }
    xhr1.send(json1);
}