<?php


class ValidarLogin
{


  public function Validar($conexao, $email, $senha)
  {

    $this->conexao = $conexao->conectar();
    $this->email = $email;
    $this->senha = $senha;
    $query = "SELECT * FROM tb_user";
    $stmt = $this->conexao->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $key => $value) {
      $value['email_user'];
      echo '<hr>';
      if ($value['email_user'] == $this->email && $value['senha_user'] == $this->senha) {

        echo 'ACHADO';
        header('location:nova_tarefa.php');
  
        
      } else {
        echo 'EMAIL OU PASSWORD NOT FOUND';
        
      }
    }
  }
}
