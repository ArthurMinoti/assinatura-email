<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Assinaturas de Email</title>

    <!-- Estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css?<?=filemtime("style.css")?>" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script type="module" src="../controller/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--Google tag (gtag.js)-->
    <script src="https://www.googletagmanager.com/gtag/js?id=G-29EZ3X1WTK" async></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-29EZ3X1WTK');
    </script>
</head>

<body>
<div class="container">
    <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <div class="alert alert-info" role="alert">
            Gerador de assinaturas de email - Primeiramente entre com sua conta da Agência:
        </div>
        <br><br>
        <div id="g_id_onload"
             data-client_id="307383647900-fp0aguqagh8h8i8o8sms6kv22s93fsps.apps.googleusercontent.com"
             data-context="signin"
             data-ux_mode="popup"
             data-callback="handleCredentialResponse"
             data-auto_prompt="false">
        </div>
        <div class="g_id_signin"
             data-type="standard"
             data-shape="rectangular"
             data-theme="filled_blue"
             data-text="signin_with"
             data-size="large"
             data-logo_alignment="left">
        </div>

        <script>
            function handleCredentialResponse (response) {
                //a credencial vem criptografada
                let decoded = parseJwt(response.credential);

                const id = decoded.sub;
                const name = decoded.name;
                const email = decoded.email;

                getSignature(email);
            }

            function parseJwt (token) {
                let base64Url = token.split('.')[1];
                let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                let jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));

                return JSON.parse(jsonPayload);
            }

            function getSignature (email) {
                $.ajax({
                    method: "POST",
                    url: "https://assinatura.baciaspcj.org.br/controller/gerar_ass_dao.php",
                    data: {email : email}
                })
                    .done(function (response) {
                        document.getElementById("email").innerHTML = String(response);
                    })
            }
        </script>
        <a class="btn btn-outline-primary" href="login.php" role="button">Área Interna</a><br><br><br>
        <br><br><div id="email"></div>
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

https://developers.google.com/identity/protocols/oauth2/javascript-implicit-flow#oauth-2.0-endpoints_4
https://developers.google.com/identity/gsi/web => principal code source
https://developers.google.com/identity/gsi/web/tools/configurator
https://code.tutsplus.com/tutorials/how-to-call-a-php-function-from-javascript--cms-36508
-->