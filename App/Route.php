<?php

//use MF\Init\Bootstrap;
require_once "../Core/MF/Init/Bootstrap.php";

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['timeline'] = array(
			'route' => '/timeline',
			'controller' => 'AppController',
			'action' => 'timeline'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$routes['tweet'] = array(
			'route' => '/tweet',
			'controller' => 'AppController',
			'action' => 'tweet'
		);

		$routes['quem_seguir'] = array(
			'route' => '/quem_seguir',
			'controller' => 'AppController',
			'action' => 'quemSeguir'
		);

		$routes['acao'] = array(
			'route' => '/acao',
			'controller' => 'AppController',
			'action' => 'acao'
		);

		$routes['remover_tweet'] = array(
			'route' => '/remover_tweet',
			'controller' => 'AppController',
			'action' => 'removerTweet'
		);

		$routes['forgot_password'] = array(
			'route' => '/forgot_password',
			'controller' => 'ForgotController',
			'action' => 'forgotPass'
		);

		$routes['reset_password'] = array(
			'route' => '/reset_password',
			'controller' => 'ForgotController',
			'action' => 'resetPassword'
		);

		$routes['set_new_pass'] = array(
			'route' => '/set_new_pass',
			'controller' => 'ForgotController',
			'action' => 'setNewPass'
		);

		$this->setRoutes($routes);
	}

}

?>