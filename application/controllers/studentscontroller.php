<?php
 class StudentsController extends Controller
 {
	public function homepage()
	{
		//Beveiliging
		$this->check_userrole('Homepage voor students', array('administrator', 'student'));
	}
	
	
	
	private function check_userrole($header, $admitance)
	{
		if (!(in_array($_SESSION['userrole'], $admitance)))
		{
			$text = 'U bent niet bevoegd deze pagina te bekijken<br />';
			$text .= 'U wordt doorgestuurd naar de algemene homepage';
			$this->set('header', $text);
			header('refresh:4;url=../users/viewall');
		}
		else
		{
			$this->set('header', $header);
		}
	}
 }
?>