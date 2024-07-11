<?php include("header.php"); ?>

<?php
    //Bloco para Declaração de Variáveis
    $fotoUsuario = $nomeUsuario = $cidadeUsuario = $telefoneUsuario = $emailUsuario = $senhaUsuario = $confirmarSenhaUsuario = "";
    $erroPreenchimento = false;

    //Verifica o método de envio do FORM
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //Verifica se o campo do formulário está vazio utilizando a função empty
        if(empty($_POST["nomeUsuario"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }
        else{
            $nomeUsuario = filtrar_entrada($_POST["nomeUsuario"]);
        }

        //Validação do campo cidadeUsuario
        if(empty($_POST["cidadeUsuario"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>CIDADE</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }
        else{
            $cidadeUsuario = filtrar_entrada($_POST["cidadeUsuario"]);
        }

        //Validação do campo telefoneUsuario
        if(empty($_POST["telefoneUsuario"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>TELEFONE</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }
        else{
            $telefoneUsuario = filtrar_entrada($_POST["telefoneUsuario"]);
        }

        //Validação do campo emailUsuario
        if(empty($_POST["emailUsuario"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }
        else{
            $emailUsuario = filtrar_entrada($_POST["emailUsuario"]);
        }

        //Validação do campo senhaUsuario
        if(empty($_POST["senhaUsuario"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>SENHA</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }
        else{
            //Utiliza a função MD5 para criptografar a senha
            $senhaUsuario = md5(filtrar_entrada($_POST["senhaUsuario"]));
        }

         //Validação do campo confirmarSenhaUsuario
         if(empty($_POST["confirmarSenhaUsuario"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>CONFIRMAR SENHA</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }
        else{
            $confirmarSenhaUsuario = md5(filtrar_entrada($_POST["confirmarSenhaUsuario"]));
            if($senhaUsuario != $confirmarSenhaUsuario){
                echo "<div class='alert alert-warning text-center'>As <strong>SENHAS</strong> não coincidem!</div>";
            $erroPreenchimento = true;
            }
        }
    }

    //Se não houverem erros de preenchimento, monta uma tabela com os dados do usuário
    if(!$erroPreenchimento){
        echo "
            <div class='alert alert-success text-center'>Usuário cadastrado com sucesso!</div>
            <div class='container mt-3'>
                <div class='table-responsive'>
                    <table class='class'>
                        <tr>
                            <th>NOME</th>
                            <td>$nomeUsuario</td>
                        </tr>
                        <tr>
                            <th>CIDADE</th>
                            <td>$cidadeUsuario</td>
                        </tr>
                        <tr>
                            <th>TELEFONE</th>
                            <td>$telefoneUsuario</td>
                        </tr>
                        <tr>
                            <th>EMAIL</th>
                            <td>$emailUsuario</td>
                        </tr>
                        <tr>
                            <th>SENHA</th>
                            <td>$senhaUsuario</td>
                        </tr>
                </div>
            </div>
        ";
    }

    //Função para filtrar as entradas de dados do formulário e evitar SQL INJECTION
    function filtrar_entrada($dado){
        $dado = trim($dado); //Remove espaços desnecessarios
        $dado = stripslashes($dado); //Remove as barras invertidas
        $dado = htmlspecialchars($dado); //Converte caracteres especiais em entidade HTML

        return($dado); //Retorna o dado já filtrado para a variável que efetuou a chamada da função
    }
?>

<?php include("footer.php"); ?>