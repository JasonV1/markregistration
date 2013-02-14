<?php
 class Controller
 {
	//Fields
	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;
	
	//Properties
	public function set($name, $value)
	{
		$this->_template->set($name, $value);
	}
	
	//Constructor wordt aangeroepen omdat de UsersController class er geen heeft
	public function __construct($model, $controller, $action)
	{
		$this->_model = new $model(); //Er wordt een instantie gemaakt vna de User class, $this->_model = new User();
		$this->_controller = $controller; // $this->controller = users
		$this->_action = $action;
		$this->_template = new Template($controller, $action); // new Template(users, array(1,2,3))
	}


	//Destructor
	public function __destruct()
	{
		$this->_template->render();
	}
	
 }

 
?>