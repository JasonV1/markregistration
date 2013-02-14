<?php
 class User extends Model
 { 
	public function select_all()
	{
		$this->query("select * from `users`");
	
	}
 }
?>