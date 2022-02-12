<?php

include_once 'dados.php';
$dados = new dados();


if(isset($_POST['action'])){
  global $dados;
  $action = $_POST['action'];

  if($action == 'login'){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
  
    $login = $dados->validar_login($email, $senha);
    if($login){
      session_start();
      $_SESSION['id'] = $login['id'];
      $_SESSION['nome'] = $login['nome'];
      $_SESSION['email'] = $login['email'];
  
      echo "true";
    }else{
      echo "false";
    }
  }
  
}