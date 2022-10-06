<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Assinaturas de Email</title>

    <!-- Estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="style.css?<?=filemtime("style.css")?>" rel="stylesheet">

    <!-- Scripts  type="text/javascript"-->
    <script src="https://accounts.google.com/gsi/client"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
    <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <div id="alerta" class="alert alert-warning" role="alert" style="display: none;">
            <h4 class="alert-heading">Parece que você não está cadastrado!</h4>
            <hr>
            <p class="mb-0">Entre em contato com a TI para realizar o cadastro</p>
        </div>
        <div class="alert alert-info" role="alert">
            Gerador de assinaturas de email — Primeiramente entre com a sua conta da Agência:
        </div>
<!--
Dominio:
438992293624-6c5uumgaak2146te3h85oc8v1pc4l156.apps.googleusercontent.com
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
API: AIzaSyA91XEqZfw9UYu5zaHOYqjH0BehKoj7oUU

Pessoal:
307383647900-fp0aguqagh8h8i8o8sms6kv22s93fsps.apps.googleusercontent.com
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
API: AIzaSyCjLoFM8iauR_X5MLO2jMj6HiXuXLpuakY
-->
        <!--
    <div id="g_id_onload"
         data-client_id="307383647900-fp0aguqagh8h8i8o8sms6kv22s93fsps.apps.googleusercontent.com"
         data-context="signin"
         data-ux_mode="popup"
         data-callback="handleCredentialResponse"
         data-auto_select="true"
         data-itp_support="true">
    </div>
    <div class="g_id_signin"
         data-type="standard"
         data-shape="rectangular"
         data-theme="filled_blue"
         data-text="signin_with"
         data-size="large"
         data-logo_alignment="left">
    </div>
-->
    <br><br>
    <div id="g_id_onload"
         data-client_id="438992293624-6c5uumgaak2146te3h85oc8v1pc4l156.apps.googleusercontent.com"
         data-context="signin"
         data-ux_mode="popup"
         data-callback="handleCredentialResponse"
         data-auto_select="true"
         data-itp_support="true">
    </div>

    <div class="g_id_signin"
         data-type="standard"
         data-shape="rectangular"
         data-theme="outline"
         data-text="signin_with"
         data-size="large"
         data-logo_alignment="left">
    </div>

<script type="text/javascript">
    const CLIENT_ID = "438992293624-6c5uumgaak2146te3h85oc8v1pc4l156.apps.googleusercontent.com";
    const SCOPES = "https://www.googleapis.com/auth/gmail.settings.basic https://www.googleapis.com/auth/gmail.settings.sharing";

    var semcadastro = document.getElementById('alerta');
    var texto = document.getElementById('texto');

    var assinatura = "";

    function handleCredentialResponse (response) {
        let decoded = parseJwt(response.credential);

        let email = decoded.email;
        console.log("Email: " + email);

        getToken(email);
    }

    function getToken(email){
        const client = google.accounts.oauth2.initTokenClient({
            client_id: CLIENT_ID,
            scope: SCOPES,
            hint: email,
            prompt: '',
            callback: (tokenResponse) => {
                alteraAssinatura(email, tokenResponse.access_token);
            }
        });
        client.requestAccessToken();
    }

    function parseJwt (token) {
        let base64Url = token.split('.')[1];
        let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        let jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));

        return JSON.parse(jsonPayload);
    }

    function alteraAssinatura(email, token) {
        getSignature(email);

        let array = 'email=' + email;
        const xml = new XMLHttpRequest();
        let assinatura;


        xml.open("POST", "http://localhost/controller/gerar_ass_dao.php", true);
        xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xml.onreadystatechange  = function (){
            if( xml.readyState === 4 && xml.status === 200 ) {
                assinatura = xml.responseText;
                switch (assinatura){
                    case "Inexistente":
                        alert("Inexistente!");
                        semcadastro.style.display = 'block';
                        break;
                    case "Erro":
                        alert("Erro! Contate a TI!");
                        break;
                    default:
                        var url = "https://www.googleapis.com/gmail/v1/users/me/settings/sendAs/" + email + "?access_token=" + token;
                        var data = {};
                        data.token = token;
                        data.signature = assinatura;
                        data.isPrimary = true;
                        data.isDefault = true;
                        var json = JSON.stringify(data);
                        var xhr = new XMLHttpRequest();
                        xhr.open("PUT", url, true);
                        xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
                        xhr.onload = function () {
                            var users = JSON.parse(xhr.responseText);
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                console.log(users);
                                document.getElementById("Texto_Sucesso").innerHTML = "Assinatura criada com sucesso!";
                            }
                            else {
                                document.getElementById("Texto_Sucesso").innerHTML = "Houve um erro. Entre em contato com a TI";
                            }
                        }
                        xhr.send(json);
                        break;
                }
            }
        }
        xml.send(array);

/*
        var url = "https://www.googleapis.com/gmail/v1/users/me/settings/sendAs/" + email + "?access_token=" + token;
        var data = {};
        data.token = token;
        data.signature = assinatura;
        var json = JSON.stringify(data);
        var xhr = new XMLHttpRequest();
        xhr.open("PUT", url, true);
        xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        xhr.onload = function () {
            var users = JSON.parse(xhr.responseText);
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log("Sucesso");
                document.getElementById("Texto_Sucesso").innerHTML = "Assinatura criada com sucesso!";
            }
            else {
                console.error("Erro!");
                document.getElementById("Texto_Sucesso").innerHTML = "Houve um erro. Entre em contato com a TI";
            }
        }
        xhr.send(json);*/
    }

    function getSignature (email){
        /*$.ajax({
            method: "POST",
            //url: "https://assinatura.baciaspcj.org.br/controller/gerar_ass_dao.php",
            data: {email : email}
        })
        .done(function (response) {
            response = String(response);
            switch (response){
                case "Inexistente":
                    alert("Inexistente!");
                    semcadastro.style.display = 'block';
                    break;
                case "Erro":
                    alert("Erro! Contate a TI!");
                    break;
                default:
                    alert("Tudo ok");
                    break;
            }
        })*/
    }
</script>
        <a class="btn btn-outline-primary" href="login.php" role="button">Área Interna</a><br><br><br>
        <div id="google"></div>
        <div id="email"></div>
        <div id="Texto_Sucesso"></div>
    </div>
</body>
</html>






<!--
  _      _       _             __  _       _     
 | |    (_)     | |          _/_/_| |     (_)    
 | |     _ _ __ | | _____   | | | | |_ ___ _ ___ 
 | |    | | '_ \| |/ / __|  | | | | __/ _ \ / __|
 | |____| | | | |   <\__ \  | |_| | ||  __/ \__ \
 |______|_|_| |_|_|\_\___/   \___/ \__\___|_|___/


https://developers.google.com/identity/gsi/web => principal code source
https://developers.google.com/identity/protocols/oauth2/openid-connect?hl=pt-br#exchangecode → Trocar code por token
https://developers.google.com/identity/oauth2/web/guides/use-token-model
https://www.youtube.com/watch?v=C0DUNy6RjNw
https://developers.google.com/identity/oauth2/web/guides/migration-to-gis#httprest-using-redirect → Authorization code flow examples

GMAIL:
https://developers.google.com/gmail/api/reference/rest/v1/users.settings.sendAs/update

StackOverflow:
https://stackoverflow.com/questions/72612704/how-to-get-oauth-token-after-google-one-tap-sign-in-jwt-token-response-of-one-t
-->