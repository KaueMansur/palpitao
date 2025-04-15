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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body id="index">
    <header>
        <h1> <span style="color: blue;">Palpitão Du</span><span style="color: red;">pla Grenal</span></h1>
    </header>
    <main>
        <form action="#" method="post" id="login">
            <h2>Login</h2>
            <div class="campos_container">
                <div class="campos_div">
                    <label for="campo_nome" class="campos_label">Nome:</label>
                    <input type="text" name="nome" id="campo_nome" class="campos_campos">
                </div>
                <div class="campos_div">
                    <label for="campo_senha" class="campos_label">Senha:</label>
                    <input type="password" name="senha" id="campo_senha" class="campos_campos">
                </div>
            </div>
            <input type="submit" value="Fazer Login" class="btn">
        </form>
    </main>
    <footer></footer>
</body>
</html>