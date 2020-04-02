<?php


//recursos
//use MF\Controller\Action;
require_once "../Core/MF/Controller/Action.php";
//use MF\Model\Container;
require_once "../Core/MF/Model/Container.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class ForgotController extends Action {

  public function forgotPass() {

    require_once "../libs/PHPMailer/Exception.php";
    require_once "../libs/PHPMailer/OAuth.php";
    require_once "../libs/PHPMailer/PHPMailer.php";
    require_once "../libs/PHPMailer/SMTP.php";
    
    //print_r($_POST);

    //validar email enviado
    $user = Container::getModel('Usuario');
    $user->__set('email', $_POST['email']);

    if(count($user->getUsuarioPorEmail()) > 0 ) { //O usuario existe no BD

      $token = $this::generateToken();
      $email = $_POST['email'];

      $mail = new PHPMailer();
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;

      $mail->Username = 'contasendemail@gmail.com';
      $mail->Password = '!#@*4321';
      $mail->SMTPSecure = 'tls';
      $mail->port = 587;
      
      $mail->setFrom('contasendemail@gmail.com');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'Reset Password';
      $mail->Body = "
	            	Olá,<br><br>
	            	Um pedido de recuperação de senha foi feito, por favor click no link abaixo:<br>
	            	<a href='http://localhost:8000/reset_password?email=$email&token=$token
	            	'>http://localhost:8000/reset_password?email=$email&token=$token</a><br><br>
	            
	            	Forgot Password,<br>
	            	Tweeter";

      if ($mail->send()) {

        $userEmail = Container::getModel('ForgotPass');
        $userEmail->__set('email', $_POST['email']);
        $userEmail->__set('token', $token);
        $userEmail->setToken();

        exit('Por Favor verifique sua caixa de e-mail');

      }
      else {
        exit('Erro ao enviar e-mail');
      }
      
    } else {
      exit('E-mail não encontrado');
    }

  }

  public function resetPassword() {
    if(!isset($_GET['email']) || $_GET['email'] == '' || !isset( $_GET['token']) || $_GET['token'] == '') {
      header('Location: /');
    }
    $this->render('resetPassword');
  }

  public function setNewPass() {
    if(!isset($_POST['senha']) || $_POST['senha'] == '') {
      header('Location: /');
    }

    $forgotPass = Container::getModel('ForgotPass');
    $forgotPass->__set('email', $_POST['email']);
    $forgotPass->__set('token', $_POST['token']);
    $forgotPass->__set('newPass', md5($_POST['senha']));
    $forgotPass->updatePass();

    exit('Senha auterada com sucesso');


  }

  public static function generateToken($len = 10) {

    $token = "poiuztrewqasdfghjklmnbvcxy1234567890";
		$token = str_shuffle($token);
		$token = substr($token, 0, $len);

		return $token;
  }

}


?>