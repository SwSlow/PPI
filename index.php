<?php
//Inicializado primeira a sessão para posteriormente recuperar valores das variáveis globais. 
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css" />

</head>
<meta charset="utf-8">

<title>| Login</title>

<body>
    <img class="fundos" src="imagens/fundo.png">
    <img class="logoIff" src="imagens/IFF.png">

    <div class="bem_vindo">
        <img class="linha" src="imagens/linha.png">
        <h4>Bem vindo!</h4>
        <img class="linha2" src="imagens/linha.png">
    </div>

    <!-- painel login -->

    <div class="div_login">

        <br>

        <img class="logo" src="imagens/Vector.png">
        <br><br><br><br>
        <!-- Criado o formulário para o usuário colocar os dados de acesso.  -->
        <div class="form">
            <form method="post" action="valida.php">
                <h1>Endereço de email</h1>
                <input type="email" name="email" placeholder="email@seuemail.com">
                <h1>Senha</h1>
                <input type="password" name="senha" placeholder="senha">
                <br><br>
                <button type="submit">
                    <h2>Entrar</h2>
                </button>
                <h3>Esqueçeu sua senha?</h3>
            </form>
        </div>
        <>
            <?php
            //Recuperando o valor da variável global, os erro de login.
            if (isset($_SESSION['loginErro'])) {
                echo $_SESSION['loginErro'];
                unset($_SESSION['loginErro']);
            } ?>
            
            <?php
            //Recuperando o valor da variável global, deslogado com sucesso.
            if (isset($_SESSION['logindeslogado'])) {
                unset($_SESSION['logindeslogado']);
            }
            ?>
    </div>

    <!-- botões -->

    <button class="cadastrar1" onclick="window.location.href = 'cadastro.php'">
        <h2>Cadastrar</h2>
    </button>
    <button class="entrar1">
        <h2>Entrar</h2>
    </button>
</body>

<footer>
    <img src="imagens/ondaas.PNG" width="100%" height="50%">
</footer>

</html>