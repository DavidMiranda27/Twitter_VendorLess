<?php


require_once "../App/Connection.php";

class Container {

	public static function getModel($model) {

		require_once "../App/Models/".ucfirst($model).".php";
		$class = ucfirst($model);
		$conn = Connection::getDb();

		return new $class($conn);
	}
}


?>