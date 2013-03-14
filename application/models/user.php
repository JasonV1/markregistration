<?php
 class User extends Model
 { 
	public function select_all()
	{
		return $this->query("select * from users");
	}
	
	public function updateuser($post, $id)
	{
		$query = "UPDATE `users` SET `firstname` = '".$post['firstname']."',
									 `infix` = '".$post['infix']."',
									 `surname` = '".$post['surname']."'
					WHERE `id` = '".$id."'";
		$this->query($query);
	}
	
	public function removeuser($id)
	{
		$query = "DELETE FROM `users` WHERE `id` = '".$id."'";
		$this->query($query);
	}
	
	public function finduser($id)
	{
		$query = "SELECT * FROM `users` WHERE `id` = '".$id."'";
		return $this->query($query);
	}
	
	public function insert_into_users($post_array)
	{
		$this->query("INSERT INTO `users` (`id`, 
										   `firstname`, 
										   `infix`, 
										   `surname`)
								VALUES 	   ( null,
											 '".$post_array['firstname']."',
											 '".$post_array['infix']."',
											 '".$post_array['surname']."')");
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