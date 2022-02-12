<?php
session_start();
include_once 'sis/functions.php';
$nomeUser = $_SESSION['nome'];
$id_usuario = $_SESSION['id'];


$tarefas = buscar_tarefas_user($id_usuario);

function verifica_finish($x, $elemento){
  if($x == 1 && $elemento == "class"){
    echo "finished";
  }else if($x == 1 && $elemento == "check"){
    echo "checked";
  }else{
    echo "";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <!--Style-->
  <link rel="stylesheet" href="style/global.css">
  <link rel="stylesheet" href="style/index.css">

  <!--Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

</head>
<body>
  <div id="index" class="content">
    <header>
      <a href="/">
        <img src="images/logo.svg" alt="ToDo.List Logo">
      </a>

      <div class="user" id="user">
        <?=$nomeUser;?>
        <img src="images/vector.svg" alt="Ícone usuário">
      </div>
    </header>

    <main>

      <section id="tasks">
        <div class="tasks">
          <?php foreach($tarefas as $tarefa){?>
            <div class="task-wrapper <?php verifica_finish($tarefa['concluida'], "class");?>" id_tarefa="<?=$tarefa['id'];?>">
              <div class="task-content">
                <input type="checkbox" class="checkbox-task" id_tarefa="<?=$tarefa['id'];?>" <?php verifica_finish($tarefa['concluida'], "check");?>>
              </div>
              <div class="task-text">
                <p><?=$tarefa['tarefa'];?></p>
              </div>
              <div class="delete-task">
                <button><img src="images/trash.svg"></button>
              </div>
            </div>
          <?php }?>
        </div>        
      </section>

      <section id="new-tasks">
        <div class="form">
          <div class="inputs">
            <input type="hidden" id="id_usuario" value="<?=$id_usuario;?>">
            <input type="text" name="task" id="task" placeholder="Escreva sua tarefa...">

            <footer>
              <button id="btn_send"><img src="images/send.svg" alt="Ícone enviar"></button>
            </footer>
          </div>
        </div>         
      </section>
    </main>
  </div>


    
  <script src="js/jquery-3.6.0.min.js"></script>


  <script>
    $("#btn_send").click(function(){
      if($("#task").val() == ""){
        alert("Preencha o campo de tarefa!");
      }else{
        $.post('sis/functions.php', {
          tarefa: $("#task").val(),
          usuario: $("#id_usuario").val(),
          action: 'nova_tarefa'
        }).done(function(data){
          dados = JSON.parse(data);
          $("#task").val("");
          $(".tasks").prepend(
            "<div class='task-wrapper'>\n\
              <div class='task-content'>\n\
                <input type='checkbox' class='checkbox-task' id_tarefa='"+dados[0]['id']+"'>\n\
              </div>\n\
              <div class='task-text'>\n\
                <p>"+dados[0]['tarefa']+"</p>\n\
              </div>\n\
              <div class='delete-task'>\n\
                <button><img src='images/trash.svg'></button>\n\
              </div>\n\
            </div>"
          );

        });
      }
    });

    $(".checkbox-task").click(function(){
      $(this).parent().parent().toggleClass("finished");
      $.post('sis/functions.php', {
        id_tarefa:  $(this).attr("id_tarefa"),
        action: 'check_tarefa'
      }).done(function(data){
        console.log(data);
      });
    });

  </script>

</body>
</html>