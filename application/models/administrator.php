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
			$query = "SELECT * FROM `students_class`
					  WHERE `student_id` = '".$post['id'][$i]."'
					  AND `class` = '".$post['class'][$i]."'";
			$record_found = $this->query($query);
			//echo sizeof($record_found);
			//var_dump($record_found);
			if ( sizeof($record_found == 0))
			{
				$query = "INSERT INTO `students_class` ( `year`,
														 `class`,
														 `student_id` )
											VALUES	   ( '2012',
														 '".$post['class'][$i]."',
														 '".$post['id'][$i]."')";
			}
			else
			{
				$query = "UPDATE `students_class` 
						  SET `class` = '".$post['class'][$i]."'
						  WHERE `year` = '2012'
						  AND `student_id` = '".$post['id'][$i]."'";
				//echo $query."<br />";
				
			}
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
		//echo $query;
		return $this->query($query);
	}
 }
?>