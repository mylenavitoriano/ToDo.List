<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


// arquivo com operaões bando de dados e conexao
include_once 'dados.php';
//classe para operar com os dados
$dados = new dados();

function logado() {
  if (!(isset($_SESSION['id']))) {
      $logado = 0;
      header('Location: login.php');
  } else {
      $logado = 1;
  }
  return $logado;
}

if(isset($_POST['action'])){
  session_start();
  $action = $_POST['action'];

  switch ($action){
    case 'cadastro':
      global $dados;
      $existe = $dados->verificar_email($_POST['email']);
      if($existe){
        echo "false";
      }else{
        $id_inserido = $dados->criar_conta($_POST);
        $return = $dados->informacoes_usuario($id_inserido);
        $_SESSION['id'] = $return['id'];
        $_SESSION['nome'] = $return['nome'];
        $_SESSION['email'] = $return['email'];
        echo "true";
      }
      break;

    case 'nova_tarefa':
      logado();
      global $dados;
      $id_tarefa = $dados->nova_tarefa($_POST);
      $return = $dados->buscar_tarefa($id_tarefa);
      $json_return = json_encode($return);
      echo $json_return;
      break;

    case 'check_tarefa':
      logado();
      global $dados;
      $result = $dados->check_tarefa($_POST['id_tarefa']);
            
      if ($result['concluida'] == 1) {
          $check = 0;
          $dados->update_check_tarefa($_POST['id_tarefa'], $check);
          return 'Pendente';
      }else if($result['concluida'] == 0){
          $check = 1;
          $dados->update_check_tarefa($_POST['id_tarefa'], $check);
          return 'Concluido';
      }
      break;

    case 'deletar_tarefa':
      logado();
      global $dados;
      $dados->deletar_tarefa($_POST['id_tarefa']);
      break;

    case 'logoff':
      session_destroy();
      echo "logoff";
      break;
  }
}

function buscar_tarefas_user($id_usuario){
  global $dados;
  $result = $dados->buscar_tarefas_user($id_usuario);

  return $result;
}
