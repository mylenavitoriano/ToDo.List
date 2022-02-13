<?php
session_start();
include_once 'sis/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>

  <link rel="stylesheet" href="style/cadastro.css">
  <link rel="stylesheet" href="style/global.css">

</head>
<body>

  <div id="cadastro" class="content">
    <header>
      <a href="#">
        <img src="images/logo.svg" alt="ToDo.List Logo">
      </a>
    </header>

    <div id="bg">
        <div class="ball top"></div>
        <div class="ball botton"></div>
    </div>

    <main>
      <div class="container">
        <section id="cadastro">
          <h2>Criar sua conta</h2>
          <label class="erro"></label>
            <input type="text" id="nome" id="nome" placeholder="Nome">
            <input type="email" id="email" id="email" placeholder="E-mail">
            <input type="password" id="senha" name="senha" placeholder="Senha">
            <button id="btn_criar">
              Criar conta
            </button>
        </section>
      </div>
    </main>

  </div>
    
  <script src="js/jquery-3.6.0.min.js"></script>

  <script>
    $("#btn_criar").click(function(){
      if($("#nome").val() == "" || $("#email").val() == "" || $("#senha").val() == ""){
        $(".erro").text("Preencha todos os campos corretamente!");
      }else{
        $.post('sis/functions.php', {
          nome: $("#nome").val(),
          email: $("#email").val(),
          senha: $("#senha").val(),
          action: 'cadastro'
        }).done(function(data){
          if(data){
            window.location.href = 'index.php';
          }else{
            $(".erro").text("E-mail já cadastrado!");
          }
        });
      }
    });

  </script>

</body>
</html>