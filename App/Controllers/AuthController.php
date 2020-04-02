<?php


//recursos
//use MF\Controller\Action;
require_once "../Core/MF/Controller/Action.php";
//use MF\Model\Container;
require_once "../Core/MF/Model/Container.php";

class AuthController extends Action {

  public function autenticar() {
    
    $usuario = Container::getModel('Usuario');

    $usuario->__set('email', $_POST['email']);
    $usuario->__set('senha', md5($_POST['senha']));

    $usuario->autenticar();

    if ($usuario->__get('id') != '' && $usuario->__get('nome') != '') {
      
      session_start();

      $_SESSION['id'] = $usuario->__get('id');
      $_SESSION['nome'] = $usuario->__get('nome');
      header('Location: /timeline');
    } else {
      header('Location: /?login=erro');
    }
  }

  public function sair() {
    session_start();
    session_destroy();
    header('Location: /');
  }
}

?>