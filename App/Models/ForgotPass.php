<?php

//use MF\Model\Model;
require_once "../Core/MF/Model/Model.php";


class ForgotPass extends Model {

  private $email;
  private $token;
  private $newPass;

  public function __get($atributo) {
    return $this->$atributo;
  }

  public function __set($atributo, $valor) {
    $this->$atributo = $valor;
  }

  public function setToken() {

    $query = "update usuarios set token = :token, tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE) where email = :email";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':token', $this->__get('token'));
    $stmt->bindValue(':email', $this->__get('email'));
    $stmt->execute();
    
  }

  public function updatePass() {
    try {
      $query = "update usuarios set token = '',senha = :newPass, tokenExpire = NULL 
      where email = :email and token = :token and tokenExpire > NOW()";
      $stmt = $this->db->prepare($query);
      $stmt->bindValue(':token', $this->__get('token'));
      $stmt->bindValue(':email', $this->__get('email'));
      $stmt->bindValue(':newPass', $this->__get('newPass'));
      $stmt->execute();  
    } catch (PDOException $e) {
      exit('Error: ' . $e->getMessage());
    }
    
  }

}


?>