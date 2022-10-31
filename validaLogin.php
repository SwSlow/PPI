    <?php
    session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("config.php");    
    //O campo usuário e senha preenchido entra no if para validar
    if((isset($_POST['num_matricula'])) && (isset($_POST['senha']))){
        $usuario = mysqli_real_escape_string($conn, $_POST['num_matricula']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
        $senha = md5($senha);
            
        //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
        $result_usuario = "SELECT * FROM usuarios WHERE num_matricula = '$usuario' && senha = '$senha' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = mysqli_fetch_assoc($resultado_usuario);
        
        //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        if(isset($resultado)){
            $_SESSION['idUsuario'] = $resultado['id_usuario'];
            $_SESSION['nomeUsuario'] = $resultado['nome'];
            $_SESSION['usuarioNiveisAcessoId'] = $resultado['tipo_usuario'];
            $_SESSION['num_matricula'] = $resultado['num_matricula'];
            $_SESSION['usuarioEmail'] = $resultado['email'];
            $_SESSION['curso'] = $resultado['curso'];
            $_SESSION['bibioteca'] = $resultado['bibioteca'];
            $_SESSION['situação'] = $resultado['situacao'];


            if($_SESSION['usuarioNiveisAcessoId'] == "1"){
                header("Location: ./principal.php");
            }elseif($_SESSION['usuarioNiveisAcessoId'] == "2"){
                header("Location: ./principal.php");
            }

            //redireciona o usuario para a página de login
            }else{    
            //Váriavel global recebendo a mensagem de erro
            $_SESSION['loginErro'] = "Usuário ou senha Inválido";
            header("Location: index.php");
        }
    //O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
    }else{
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
        header("Location: index.php");
    }