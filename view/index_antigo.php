<!DOCTYPE html>
<html>

<head>
    <title>Assinatura Digital</title>
    <meta charset="utf-8" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css?<?=filemtime("style.css")?>" rel="stylesheet">

    <!-- API do Google -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
    <br>
        <div class="alert alert-info" role="alert">
            <p id="Mensagem">Gerador de assinaturas de email - Primeiramente entre com sua conta da Agência:</p>
        </div>
    <br>
    <!--<p id="Mensagem">Primeiramente, logue na sua conta da agencia 'agencia.baciaspcj.org.br'</p>-->

    <button id="authorize_button" class="btn btn-primary" style="display: none;">Logar</button>
    <button id="signout_button" class="btn btn-primary" style="display: none;">Deslogar</button>

    <p class="font-weight-bold" id="Texto_Sucesso"></p>


    <button type="button" id="botao_geraAssi" class="btn btn-secondary" >Criar Assinatura</button>
    <pre id="content" style="white-space: pre-wrap;"></pre>

<script type="text/javascript">
    // Client ID and API key from the Developer Console
    //API utilizada é o OAtuh2.0, que precisa ser reabilitado ou configurado em outra conta
    const CLIENT_ID = '307383647900-fp0aguqagh8h8i8o8sms6kv22s93fsps.apps.googleusercontent.com';
    const API_KEY = 'AIzaSyCjLoFM8iauR_X5MLO2jMj6HiXuXLpuakY';
    var big_token = "";
    //var teste=0;


    // Array of API discovery doc URLs for APIs used by the quickstart
    const DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/gmail/v1/rest"];
    var send_Email = "";
    

    // Authorization scopes required by the API; multiple scopes can be
    // included, separated by spaces.
    const SCOPES = 'https://www.googleapis.com/auth/gmail.settings.basic https://www.googleapis.com/auth/gmail.compose';
    const authorizeButton = document.getElementById('authorize_button');
    const signoutButton = document.getElementById('signout_button');
    const lista_pessoasDropDown = document.getElementById('botao_geraAssi');
    const criaAssinaturaButton = document.getElementById('pessoa');
    const Mensagem = document.getElementById('Mensagem');

    function handleClientLoad() {
        gapi.load('client:auth2', initClient);
    }

  /*
  $(document).ready(function () {
    document.getElementById("botao_geraAssi").addEventListener("click", monta_assinatura);//evento para gerar a assinatura

    function monta_assinatura(){
      var e = document.getElementById("pessoa"); //drop down com os emails disponíveis para assinatura

      var id = e.options[e.selectedIndex].value; //pega o id do dorpdown selecionado

      $.ajax({
        type : "POST",  //metodo post
        url  : "monta_assinatura.php",  //página que gera a assinatura
        data : { id : id, email : send_Email}, //passando valores para o php 
        success: function(res){  
          alteraAssinatura(send_Email, res); //res é a assinatura que é recolhida pelo ajax
        }
      });
    }

  });*/

    function initClient() {
        gapi.client.init({
            apiKey: API_KEY,
            clientId: CLIENT_ID,
            discoveryDocs: DISCOVERY_DOCS,
            scope: SCOPES
        }).then(
            function() {
            // Listen for sign-in state changes.
                gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus); //aguarda até que o estado do login mude

                const googleUser = gapi.auth2.getAuthInstance().currentUser.get(); //recebe o usuário logado atualmente
                var id_token = googleUser.getAuthResponse().id_token; //pega o token do login
                var accessToken = "";
                try {
                    accessToken = googleUser.getAuthResponse(true).access_token; //pega o token de acesso para as funções
                }catch (err) {
                    accessToken = false;
                }
                finally {
                    updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get(), accessToken); //faz o update do estado de login para logado
                }

                authorizeButton.onclick = handleAuthClick; //define o evento de clique o botão
                signoutButton.onclick = handleSignoutClick; //define o evento de clique o botão

                },
                function (error) {
                    appendPre(JSON.stringify(error, null, 2)); //chama a função appendPre, caso o login de errado e passa as diretrizes
            }
        );

    }

    function updateSigninStatus(isSignedIn, token) {
        if (isSignedIn) {
            authorizeButton.style.display = 'none';
            signoutButton.style.display = 'block';
            criaAssinaturaButton.style.visibility = 'visible';
            Mensagem.innerHTML = "Logado com Sucesso!";

            big_token = token;
            listLabels();
        }
        else {
            authorizeButton.style.display = 'block';
            signoutButton.style.display = 'none';
            criaAssinaturaButton.style.visibility = 'hidden';
            Mensagem.innerHTML = "Gerador de assinaturas de email - Primeiramente entre com sua conta da Agência:";
        }
    }

    function handleAuthClick(event) {
        gapi.auth2.getAuthInstance().signIn();
    }

    function handleSignoutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
    }

    function appendPre(message) {
        var pre = document.getElementById('content'); //busca o pre no html
        var textContent = document.createTextNode(message + '\n'); //cria a mensagem de erro com o node
        pre.appendChild(textContent); //concat da mensagem de erro no pre
    }

    function listLabels() {
        var xmlHttp = new XMLHttpRequest();

        //função para identificar qual o e-mail/sendAs principal da pessoa logada:
        xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState === 4 && xmlHttp.status === 200){ //verifica se a resposta do servidor foi confirmado
            if (this.responseText != null && this.responseText !== ""){ //verifica se o servidor retornou o email utilizado
                resposta = this.responseText;

                var Retorno = JSON.parse(resposta); //transforma a resposta de json para vetor javascript

                var i;

                //Aqui eu procuro qual o email logado no sistema
                for (i = 0; i <= Retorno.length; i++) {
                    if (Retorno.sendAs[i].isPrimary = true) {
                        send_Email = Retorno.sendAs[i].sendAsEmail;
                        break;
                    }
                }
                if(send_Email === "" || send_Email === undefined || send_Email == null){
                    send_Email = Retorno.sendAs[0].sendAsEmail;
                }
            }
        }
      }

      var url = "https://www.googleapis.com/gmail/v1/users/me/settings/sendAs?access_token=" + big_token; //url da api
      if (url == "https://www.googleapis.com/gmail/v1/users/me/settings/sendAs?access_token=undefined"){ //verifica se o usuário está logado corretamente
        window.location.reload(false); 
      }
      xmlHttp.open("GET", url, true); // true for asynchronous 
      xmlHttp.send(null); 
    }

/*
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
    }*/
  </script>
  


  <script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};handleClientLoad()"
    onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
    </div>
</body>

</html>