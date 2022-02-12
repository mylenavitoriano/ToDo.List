<?php


  error_reporting(E_ALL);
  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
  date_default_timezone_set('America/Sao_Paulo');

  class dados {
    // dados do banco 
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "to-do-list";
    public $db;
    
    // conecta com o banco
    public function __construct() {
        $this->db = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if (mysqli_connect_error()) {
            trigger_error("Conexão falhou: " . mysqli_connect_error());
        } else {
            return $this->db;
        }
    }

    public function validar_login($email, $senha){
      $result = $this->db->prepare("SELECT * FROM user WHERE email=? AND senha=?");
      $result->bind_param('ss', $email, $senha);
      $result->execute();
      $dados = $result->get_result();
      
      
      if($dados->num_rows > 0){
          $data = $dados->fetch_array(MYSQLI_ASSOC);
          
          return $data;
      }else{
          return false;
      }
    }

    public function nova_tarefa($dados){
      $result = $this->db->prepare("INSERT INTO tarefas (id_user, tarefa) VALUES (?, ?)");
      $result->bind_param('is', $dados['usuario'], $dados['tarefa']);
      $result->execute();

      return ($result->insert_id);
    }

    public function buscar_tarefa($id_tarefa){
      $result = $this->db->prepare("SELECT * FROM tarefas WHERE id=?");
      $result->bind_param('i', $id_tarefa);
      $result->execute();
      $dados = $result->get_result();
        
      while($dado = $dados->fetch_array(MYSQLI_ASSOC)){
          $data[] = $dado;
      }
      return $data;
    }

    public function buscar_tarefas_user($id_usuario){
      $result = $this->db->prepare("SELECT * FROM tarefas WHERE id_user=? ORDER BY id DESC");
      $result->bind_param('i', $id_usuario);
      $result->execute();
      $dados = $result->get_result();
        
      while($dado = $dados->fetch_array(MYSQLI_ASSOC)){
          $data[] = $dado;
      }
      return $data;
    }

    public function check_tarefa($id_tarefa){
      $result = $this->db->prepare("SELECT * FROM tarefas WHERE id=?");
      $result->bind_param('i', $id_tarefa);
      $result->execute();
      $dados = $result->get_result();
      $data = $dados->fetch_array(MYSQLI_ASSOC);

      return $data;
    }

    public function update_check_tarefa($id_tarefa, $concluido){
      $result = $this->db->prepare("UPDATE tarefas SET concluida=? WHERE id=?");
      $result->bind_param('ii', $concluido, $id_tarefa);
      $result->execute();
    }
  }

?>