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
 }
?>