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
        <div id="semCadastro" class="alert alert-warning" role="alert" style="display: none;">
            <h4 class="alert-heading">Parece que você não está cadastrado!</h4>
            <hr>
            <p class="mb-0">Entre em contato com a TI para realizar o cadastro.</p>
        </div>

        <div id="alertaErro" class="alert alert-danger" role="alert" style="display: none;">
            <h4 class="alert-heading">Houve um erro!</h4>
            <hr>
            <p class="mb-0">Entre em contato com a TI para resolver o problema.</p>
        </div>

        <div id="sucesso" class="alert alert-success" role="alert" style="display: none;">
            <h4 class="alert-heading">Tudo certo!</h4>
            <hr>
            <p class="mb-0">Assinatura inserida com sucesso.</p>
        </div>

        <div class="alert alert-primary" role="alert">
            Gerador de assinaturas de email - Selecione a opção desejada:
        </div>


    <br><br>
        <div style="text-align: center;">
            <button class="btn btn-primary center" type="button" data-bs-toggle="collapse" data-bs-target="#renovar" aria-expanded="false" aria-controls="collapseExample">
                Já tenho uma assinatura
            </button>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#criar" aria-expanded="false" aria-controls="collapseExample">
                Ainda não tenho uma assinatura
            </button>
        </div>
        <br>
        <div class="collapse" id="renovar">
            <div class="card card-body">
                <div class="alert alert-dark" role="alert">
                    Já tenho uma assinatura
                </div>
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            No computador, <a href="https://mail.google.com/">Acesse o Gmail</a>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            No canto superior direito, clique em <strong>Configurações</strong>
                            <img src="config.png" width="18" height="18" alt="Configurações" data-mime-type="image/png">
                            <img src="seta.png" width="13" height="18" alt="Seta" data-mime-type="image/png">
                            <strong>Ver todas as configurações</strong><br>
                            <img src="conf.png" alt="Print Configurações" data-mime-type="image/png">
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            Na parte superior selecione <strong>Geral</strong>
                            <img src="seta.png" width="13" height="18" alt="Seta" data-mime-type="image/png">
                            <strong>Assinatura</strong><br>
                            <img src="geral.png" alt="Print Configurações" data-mime-type="image/png">
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            Alterar os <strong>Padrões de Assinatura</strong> para <strong>Sem assinatura</strong>:<br>
                            <img src="alteracoes.png" alt="Alerações" data-mime-type="image/png">
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            Excluir as assinaturas antigas clicando na lixeira:<br>
                            <img src="excluir.png" alt="Escluir" data-mime-type="image/png">
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            Realizar o login do Google:
                        </div>
                    </li>
                </ol>
            </div>
        </div><br>
        <div class="collapse" id="criar">
            <div class="card card-body">
                <div class="alert alert-dark" role="alert">
                    Não tenho uma assinatura
                </div>
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            Realizar o login do Google:
                        </div>
                    </li>
                </ol>
            </div>
        </div>
        <br>
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
        <br>
        <a class="btn btn-outline-primary" href="login.php" role="button">Área Interna</a><br><br><br>
        <script type="text/javascript">
            const CLIENT_ID = "438992293624-6c5uumgaak2146te3h85oc8v1pc4l156.apps.googleusercontent.com";
            const SCOPES = "https://www.googleapis.com/auth/gmail.settings.basic https://www.googleapis.com/auth/gmail.settings.sharing";

            const semcadastro = document.getElementById('semCadastro');
            const alertaErro = document.getElementById('alertaErro');
            const sucesso = document.getElementById('sucesso');

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
                let array = 'email=' + email;
                const xml = new XMLHttpRequest();
                let assinatura;

                xml.open("POST", "http://localhost/Assinatura_email/controller/gerar_ass_dao.php", true); //TODO alterar link em produção
                xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xml.onreadystatechange  = function (){
                    if( xml.readyState === 4 && xml.status === 200 ) {
                        assinatura = xml.responseText;
                        switch (assinatura){
                            case "Inexistente":
                                semcadastro.style.display = 'block';
                                break;
                            case "Erro":
                                alertaErro.style.display = 'block';
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
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        sucesso.style.display = 'block';
                                    }
                                    else {
                                        alertaErro.style.display = 'block';
                                    }
                                }
                                xhr.send(json);
                                break;
                        }
                    }
                }
                xml.send(array);
            }
        </script>
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

GMAIL:
https://developers.google.com/gmail/api/reference/rest/v1/users.settings.sendAs/update

StackOverflow:
https://stackoverflow.com/questions/72612704/how-to-get-oauth-token-after-google-one-tap-sign-in-jwt-token-response-of-one-t
-->