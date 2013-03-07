<?php
 class Template
 {
	//Fields
	protected $_variables = array();
	protected $_controller;
	protected $_action;
	
	//Properties
	public function set($name, $value)
	{
		$this->_variables[$name] = $value;
	}
	
	//Constructor
	public function __construct($controller, $action)
	{
		$this->_controller = $controller;
		$this->_action = $action;
	}
	
	public function render()
	{
		extract($this->_variables);
		if (file_exists(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.'header.php'))
		{
			include(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.'header.php');
		}
		else
		{
			include(ROOT.DS.'application'.DS.'views'.DS.'header.php');
		}
		if (file_exists(ROOT.DS.'application'.DS.'views'.DS.'link.php'))
		{
			include(ROOT.DS.'application'.DS.'views'.DS.'link.php');
		}
		else
		{
			echo "Ja dag, die bestaat niet";
		}
		if (file_exists(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.$this->_action.'.php'))
		{
			include(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.$this->_action.'.php');
		}
		else
		{
			echo "View: ".$this->_action.".php bestaat nog niet";
		}
		
		if (file_exists(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.'footer.php'))
		{
			include(ROOT.DS.'application'.DS.'views'.DS.$this->_controller.DS.'footer.php');
		}
		else
		{
			include(ROOT.DS.'application'.DS.'views'.DS.'footer.php');
		}
	}
 }
?>