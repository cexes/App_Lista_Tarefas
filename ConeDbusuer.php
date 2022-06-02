<?php
class ConeDbuser {

    public function __construct($conexao,$email,$senha) {
        $this->conexao =$conexao->conectar();
        $this->email = $email;
        $this->senha = $senha;
    
        
        
    }

    public function inserir(){

      if(!empty($this->email)&& !empty($this->senha)) {
        $query = 'insert into tb_user(email_user, senha_user)values(:email,:senha)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':email',$this->email);
        $stmt->bindValue(':senha',$this->senha);
        
        $stmt->execute();
      }
      }

  

      
      

    }
  ?>

