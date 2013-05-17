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
	
	public function insert_into_students_class($post)
	{
		for ($i = 0; $i < sizeof($_POST['id']); $i++)
		{
			$query = "INSERT INTO `students_class` ( `year`,
													 `class`,
													 `student` )
										VALUES	   ( '2012',
													 '".$post['class'][$i]."',
													 '".$post['id'][$i]."')";
			echo $query."<br />";
			$this->query($query);
		}
		
	}
	
	public function find_class_student($id)
	{
		$query = "SELECT *
				  FROM `students_class`, `class`
				  WHERE `student_id`.`student_id` = '".$id."'
				  AMD `students_class`.`class` = `class`.`class_id`
				  AND `students_class`.`year` = '2012'";
		echo $query;
		return $this->query($query);
	}
 }
?>