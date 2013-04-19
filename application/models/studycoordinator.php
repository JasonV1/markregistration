<?php
 class Studycoordinator extends Model
 {
	public function find_all_teachers()
	{
		$query = "SELECT * FROM `users`, `userroles`
				  WHERE `userroles`.`userrole` 		= 'teacher'
				  AND   `userroles`.`userrole_id` 	= `users`.`user_id`";
		return $this->query($query); 
	}
	
	public function insert_into_courses($post)
	{
		$query = "INSERT INTO `courses` ( `course_id`,
										  `course`,
										  `course_description`,
										  `number_of_marks`,
										  `teacher_id`)
				  VALUES				( NULL,
										  '".$post['course']."',
										  '".$post['course_description']."',
										  '".$post['number_of_marks']."',
										  '".$post['teacher_id']."')";
		$this->query($query);
	}
	
	public function insert_into_class($post)
	{
		$query = "INSERT INTO `class` ( `class_id`,
										  `class`,
										  `mentor`,
										  `year`)
				  VALUES				( NULL,
										  '".$post['class']."',
										  '".$post['mentor']."',
										  '".$post['year']."')";
		return $this->query($query);
	}
	
	public function select_all_classes()
	{
		$query = "SELECT * FROM `class`";
		return $this->query($query);
	}
	
	public function insert_into_reports($post)
	{
		$query = "INSERT INTO `reports` ( `id`,
										  `year`,
										  `term`,
										  `class`)
				  VALUES				( NULL,
										  '".$post['year']."',
										  '".$post['term']."',
										  '".$post['class']."')";
		$this->query($query);
	}
	
	public function select_all_from_reports()
	{
		$query = "SELECT *
				  FROM `reports`, `class`
				  WHERE `reports`.`class` = `class`.`class_id`";
		return $this->query($query);
	}
	
	public function select_all_courses()
	{
		$query = "SELECT * 
				  FROM `courses`";
		return $this->query($query);
	}
	
	public function select_all_teachers()
	{
		$query = "SELECT * 
				  FROM `users`, `userroles`
				  WHERE `users`.`user_id` = `userroles`.`userrole_id`
				  AND `userroles`.`userrole` = 'teacher'";
		return $this->query($query);
	}
	
	public function insert_into_courses_in_report($post, $id)
	{
		
		
		$query = "INSERT INTO `courses_in_reports`
				  VALUES	   ( NULL,
								 '".$id."',
								 '".$post['course']."',
								 '".$post['teacher']."')";
		$this->query($query);
	}
	
	public function select_courses_in_report($id)
	{
		$query = "SELECT * 
				  FROM `courses`, `courses_in_reports`, `users`
				  WHERE `courses`.`course_id` = `courses_in_reports`.`courses_id`
				  AND `courses_in_reports`.`reports_id` = '".$id."'
				  AND `courses_in_reports`.`teachers_id` = `users`.`user_id`
				  ORDER BY `courses`.`course_id`";
		return $this->query($query);
	}
	
	public function remove_course_in_report($course_id, $report_id)
	{
		$query = "DELETE FROM `courses_in_reports`
				  WHERE `courses_id` = '".$course_id."'
				  AND 	`reports_id` = '".$report_id."'";
		$this->query($query);
	}
 }
?>