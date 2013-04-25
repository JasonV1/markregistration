<?php
 class Administrator extends Model
 {
	public function select_all_students()
	{
		$query = "SELECT * FROM `users`, `userroles`
				  WHERE `userroles`.`userrole_id` = `users`.`user_id`
				  AND `userroles`.`userrole` = 'student'";
		return $this->query($query);
	}
	
	public function select_all_classes()
	{
		$query = "SELECT * FROM `class`";
		return $this->query($query);
	}
 }
?>