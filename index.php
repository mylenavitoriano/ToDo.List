<?php
session_start();
include_once 'sis/functions.php';
logado();

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
      <a href="#">
        <img src="images/logo.svg" alt="ToDo.List Logo">
      </a>

      <div class="user" id="user">
        <?=$nomeUser;?>
        <img src="images/user.svg" alt="Ícone usuário">
        <img src="images/exit.svg" alt="Ícone sair" id="exit">
      </div>
    </header>
    <main>

     
        <section id="tasks">
          <?php if($tarefas){?>
            <div class="tasks">
              <?php foreach($tarefas as $tarefa){?>
                <div class="task-wrapper <?php verifica_finish($tarefa['concluida'], "class");?>" id_tarefa="<?=$tarefa['id'];?>">
                  <div class="task-content">
                    <input type="checkbox" class="checkbox-task" id_tarefa="<?=$tarefa['id'];?>" <?php verifica_finish($tarefa['concluida'], "check");?>>
                  </div>
                  <div class="task-info">
                    <div class="task-text">
                      <div class="task-title">
                        <p><?=$tarefa['titulo'];?></p>
                      </div>
                      <div class="task-description">
                        <p><?=$tarefa['descricao'];?></p>
                      </div>
                    </div>
                    <div class="buttons-info">
                      <button class="less-info"><img src="./images/up.svg"/></button>
                      <button class="more-info"><img src="./images/down.svg"/></button>
                    </div>
                  </div>

                  <div class="delete-task">
                    <button class="btn_delete" id_tarefa="<?=$tarefa['id'];?>"><img src="images/trash.svg"></button>
                  </div>
                </div>
              <?php }?>
            </div>   
          <?php }else{?>
            <div class="image_coffee">
              <div class="text-coffee">
                <p class="p-1">Que tal pegar um <span>café</span> e</p>
                <p class="p-2">planejar sua <span>rotina...</span></p>
              </div>
              <img src="images/coffee.svg" alt="Café">
            </div>
          <?php }?>
        </section>
    
      <section id="new-tasks">
        <div class="open_modal">
            <button id="btn_open_modal">Nova tarefa<img src="images/add.svg" alt="Botão adicionar nova tarefa"></button>
          </div>
        </div>         
      </section>

    </main>
  </div>

  <!-- MODAL -->
  <div class="modal-task">
    <div class="modal">
      <h2>Nova tarefa</h2>
        <div class="form">
          <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$id_usuario;?>">
          <input type="text" name="title_task" id="title_task" placeholder="Título">
          <textarea name="text_task" id="text_task" class="input" placeholder="Descrição"></textarea>
        </div>

        <div class="buttons">
          <div class="button grey cancel" id="cancel_add">Cancelar</div>
          <button class="button send" id="add_task">Adicionar</button>
        </div>
      
    </div>
  </div>

    
  <script src="js/jquery-3.6.0.min.js"></script>

  <script>
    $("#btn_open_modal").click(function(){
      $(".modal-task").addClass("active");
    });

    $("#add_task").click(function(){
      if($("#title_task").val() == ""){
        alert("Preencha o campo de tarefa!");
      }else{
        $.post('sis/functions.php', {
          titulo: $("#title_task").val(),
          descricao: $("#text_task").val(),
          usuario: $("#id_usuario").val(),
          action: 'nova_tarefa'
        }).done(function(data){
          dados = JSON.parse(data);

          $(".modal-task").removeClass("active");
          $("#title_task").val("");
          $("#text_task").val("");

          location.reload();
        });
      }
    });

    $(".btn_delete").click(function(){
      var id_tarefa = $(this).attr("id_tarefa");
      $.post('sis/functions.php', {
        id_tarefa:  id_tarefa,
        action: 'deletar_tarefa'
      }).done(function(data){
        $(".task-wrapper[id_tarefa='"+id_tarefa+"']").remove();
      });
    });

    $("#cancel_add").click(function(){
      $(".modal-task").removeClass("active");
    });

    $(".checkbox-task").click(function(){
      var id_tarefa = $(this).attr("id_tarefa");
      $(".task-wrapper[id_tarefa='"+id_tarefa+"']").toggleClass("finished");
      $.post('sis/functions.php', {
        id_tarefa:  $(this).attr("id_tarefa"),
        action: 'check_tarefa'
      }).done(function(data){
        console.log(data);
      });
    });

    $(".more-info").click(function(){
      $(this).parent().parent().parent().addClass("details");
    });

    $(".less-info").click(function(){
      $(this).parent().parent().parent().removeClass("details");
    });

    $("#exit").click(function(){
      $.post('sis/functions.php', {
        action: 'logoff'
      }).done(function(){
        window.location.href = "login.php";
      });
    });

  </script>

</body>
</html>