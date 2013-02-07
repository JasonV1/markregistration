<?php
	function callHook()
	{
		//In geval van url /users/adduser/1/2/3
		global $url;
		$urlArray = explode('/', $url);
		//var_dump($urlArray);
		//echo $url;
		$controller = $urlArray[0]; //$controller = users
		//echo $controller;
		array_shift($urlArray);
		$action = $urlArray[0]; //$action = adduser(methode in de usercontroller class)
		array_shift($urlArray);
		$queryString = $urlArray; //$queryString = array(1, 2, 3)
		$controllerName = $controller; //mapnaam waar de controller in komt heet application\user
		$controller = ucwords($controller);
		$model = rtrim($controller, 's');
		//echo $model;
		$controller .= 'Controller'; // $controller = UsersControllers
		//echo $controller;
		//var_dump($urlArray);
		$dispatch = new $controller($model, $controllerName, $action);
	}
	
	function __autoload($classname)
	{
		echo "Justice.".strtolower($classname);
		
		if ( file_exists(ROOT.DS.'libary'.DS.strtolower($classname).'.class.php'))
		{
			require_once(ROOT.DS.'libary'.DS.strtolower($classname).'.class.php');
		}
		
		else if ( file_exists(ROOT.DS.'application'.DS.'controllers'.DS.strtolower($classname).'.php'))
		{
			require_once(ROOT.DS.'application'.DS.'controllers'.DS.strtolower($classname).'.php');
		}
		else if ( file_exists(ROOT.DS.'application'.DS.'models'.DS.strtolower($classname).'.php'))
		{
			require_once(ROOT.DS.'application'.DS.'models'.DS.strtolower($classname).'.php');
		}
		else
		{
			echo $classname.'TODO Class not found Error';
		}
	}
	callHook();
?>