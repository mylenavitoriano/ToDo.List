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
        Usuário
        <img src="images/vector.svg" alt="Ícone usuário">
      </div>
    </header>

    <main>

      <section id="tasks">
        <div class="tasks">
          <div class="task-wrapper finished">
            <div class="task-content">
              <input type="checkbox" class="checkbox-task">
            </div>
            <div class="task-text">
              <p>Tarefa W</p>
            </div>
            <div class="delete-task">
              <button><img src="images/trash.svg"></button>
            </div>
          </div>

          <div class="task-wrapper">
            <div class="task-content">
              <input type="checkbox" class="checkbox-task">
            </div>
            <div class="task-text">
              <p>Tarefa X</p>
            </div>
            <div class="delete-task">
              <button><img src="images/trash.svg"></button>
            </div>
          </div>

          <div class="task-wrapper">
            <div class="task-content">
              <input type="checkbox" class="checkbox-task">
            </div>
            <div class="task-text">
              <p>Tarefa Y</p>
            </div>
            <div class="delete-task">
              <button><img src="images/trash.svg"></button>
            </div>
          </div>

          
        </div>        
      </section>

      <section id="new-tasks">
        <div class="form">
          <form action="">
            <input type="text" name="task" id="task" placeholder="Escreva sua tarefa...">

            <footer>
              <button><img src="images/send.svg" alt="Ícone enviar"></button>
            </footer>
          </form>
        </div>         
      </section>
    </main>
  </div>
</body>
</html>