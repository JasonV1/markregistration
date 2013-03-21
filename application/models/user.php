<?php
 class User extends Model
 { 
	public function select_userroles()
	{
		$query = "SELECT DISTINCT `userrole` FROM `userroles`";
		return $this->query($query);
	}
	
	public function select_all()
	{
		return $this->query("SELECT * FROM `users`, `logins`, `userroles`
						     WHERE `users`.`user_id` = `logins`.`login_id`
							 AND   `userroles`.`userrole_id` = `logins`.`login_id`");
	}
	
	public function updateuser($post, $id)
	{
		$query = "UPDATE `users` SET `firstname` = '".$post['firstname']."',
									 `infix` = '".$post['infix']."',
									 `surname` = '".$post['surname']."'
					WHERE `user_id` = '".$id."'";
					
		$this->query("UPDATE `users` SET `firstname` = '".$post['firstname']."',
									 `infix` = '".$post['infix']."',
									 `surname` = '".$post['surname']."'
					WHERE 			 `user_id` = '".$id."'");
					
		$this->query("UPDATE `logins` SET `emailaddress` = '".$post['emailaddress']."',
										  `password` 	 = '".$post['password']."'
					  WHERE 			  `login_id` 	 = '".$id."'");
					  
		$this->query("UPDATE `userroles` SET `userrole` = '".$post['userrole']."'
					  WHERE 				 `userrole_id` = '".$id."'");
	}
	
	public function removeuser($id)
	{
		$query = "DELETE FROM `users` WHERE `user_id` = '".$id."'";
		$this->query($query);
	}
	
	public function finduser($id)
	{
		$query = "SELECT * FROM `users`, `logins`, `userroles`
				  WHERE `user_id` = '".$id."'
				  AND `login_id` = '".$id."'
				  AND `userrole_id` = '".$id."'";
		return $this->query($query, 1);
	}
	
	public function insert_into_users($post)
	{
		$this->query("INSERT INTO `logins` ( `login_id`,
										 `emailaddress`,
										 `password`)
				  VALUES			   ( NULL,
										 '".$post['emailaddress']."',
										 '".$post['password']."')");
		//Vind het autonummering id
		$id = $this->fine_last_inserted_id();
		
		$this->query("INSERT INTO `users` (`user_id`, 
										   `firstname`, 
										   `infix`, 
										   `surname`)
								VALUES 	   ( '".$id."',
											 '".$post['firstname']."',
											 '".$post['infix']."',
											 '".$post['surname']."')");
											 
		$this->query("INSERT INTO `userroles` ( `userrole_id`,
											   `userrole`)
					  VALUES				 ( '".$id."',
											   '".$post['userrole']."')");
	}
	
	public function select_user_from_login($post)
	{
		$query = "SELECT * FROM `logins`, `userroles`
				  WHERE `logins`.`login_id` = `userroles`.`userrole_id`
				  AND `logins`.`emailaddress` = '".$post['username']."'
				  AND `logins`.`password` = '".$post['password']."'";
		return $this->query($query);
	}
 }
?>