<?php
 class User extends Model
 { 
	public function select_all()
	{
		return $this->query("select * from users");
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
 }
?>