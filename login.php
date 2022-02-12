<?php
session_start();
include_once 'sis/functions.php';

if(isset($_SESSION['id'])){
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="stylesheet" href="style/login.css">
  <link rel="stylesheet" href="style/global.css">

</head>
<body>

  <div id="login" class="content">
    <header>
      <a href="/">
        <img src="images/logo.svg" alt="ToDo.List Logo">
      </a>
    </header>

    <div id="bg">
        <div class="ball top"></div>
        <div class="ball botton"></div>
    </div>

    <main>
      <div class="container">
        <section id="login">
          <h2>Acesse seu<img src="images/to-do.svg" alt=""></h2>
          <label class="erro"></label>
          
              <input type="email" id="email" id="email" placeholder="E-mail">
              <input type="password" id="senha" name="senha" placeholder="Senha">
              <button id="btn_entrar">
                <img src="images/enter.svg" alt="Entrar">
                Entrar
              </button>
                  
        </section>
      </div>
    </main>

  </div>
    
  <script src="js/jquery-3.6.0.min.js"></script>


  <script>
    $("#btn_entrar").click(function(){
      $.post('sis/function_login.php', {
        email: $("#email").val(),
        senha: $("#senha").val(),
        action: 'login'
      }).done(function(data){
        if(data == 'true'){
          window.location.href = 'index.php';
        }else{
          $(".erro").html("Usuário ou senha incorretos");
        }
      });
    });

  </script>

</body>
</html>