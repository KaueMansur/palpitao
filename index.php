<?php 

require "src/model/jogador.php";

require "src/controller/session_on.php";

if(isset($_POST["nome"])){
    if(isset($_POST["senha"])){
        $jogador = new Jogador($_POST["nome"], sha1($_POST["senha"]));

        if($jogador->fazerLogin()){
            
            if($jogador->getAdm() == 1){
                $_SESSION["adm"] = $jogador->getObject();
                header("Refresh: 0; URL = src/view/adm.php");
            } else{
                $_SESSION["jogador"] = $jogador->getObject();
                header("Refresh: 0; URL = src/view/main.php");
            }
            
        } else{
            echo "<script>alert('Dados incorretos')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palpitão dupla grenal</title>
</head>
<body>
    <header></header>
    <main>
        <form action="#" method="post">
            <h1>Login</h1>
            <div>
                <label for="campo_nome">Nome:</label>
                <input type="text" name="nome" id="campo_nome">
            </div>
            <div>
                <label for="campo_senha">Senha:</label>
                <input type="password" name="senha" id="campo_senha">
            </div>
            <input type="submit" value="Fazer Login">
        </form>
    </main>
    <footer></footer>
</body>
</html>