<?php
 class UsersController extends Controller
 {
	public function adduser()
	{
		$headertekst = "Like a siren in my head that always threatens to repeat...";
		$this->set('headertekst', $headertekst);
		$all_users = $this->_model->select_all();
		$this->set('all_users', $all_users);
	} 
 }
?>