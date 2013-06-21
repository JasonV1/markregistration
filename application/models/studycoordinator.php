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
										  `class`,
										  `cesure`)
				  VALUES				( NULL,
										  '".$post['year']."',
										  '".$post['term']."',
										  '".$post['class']."'
										  '".$post['cesure']."')";
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
		$query = "INSERT INTO `courses_in_reports` ( `id`,
													 `reports_id`,
													 `courses_id`,
													 `teachers_id`,
													 `weight`)
							  VALUES	   	( 		NULL,
													'".$id."',
													'".$post['course']."',
													'".$post['teacher']."',
													'".$post['weight']."')";
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
	
	public function select_all_students()
	{
		$query = "SELECT * FROM `users`, `userroles`
				  WHERE `userroles`.`userrole_id` = `users`.`user_id`
				  AND `userroles`.`userrole` = 'student'";
		return $this->query($query);
	}
	
	
	public function find_class_student($id)
	{
		$query = "SELECT * 
				  FROM `students_class`, class
				  WHERE `students_class`.`student_id` = '".$id."'
				  AND `students_class`.`year` = '2012'
				  AND `students_class`.`class` = `class`.`class_id`
				  ";
		//echo $query;
		return $this->query($query);
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
	
	public function findstudent($id)
	{
		$query = "SELECT * FROM `users`, `logins`,
				  WHERE `user_id` = '".$id."'
				  AND `userrole` = `student`";
		return $this->query($query, 1);
	}
	
	public function find_all_reports()
	{
		$query = "SELECT DISTINCT `reports`.`year` FROM `students_class`, 
								`reports`
				  WHERE `student_id` = '".$_SESSION['id']."'
				  AND `students_class`.`class` = `reports`.`class`
				  AND `students_class`.`year` = `reports`.`year`";
		return $this->query($query);
	}
	
	public function find_marks_by_course_id_and_student_id($course_id)
	{
		$query = "SELECT * FROM `grades`
				  WHERE `course_id` = '".$course_id."'
				  AND `student_id` = '".$_SESSION['id']."'";
		return $this->query($query);
	}
	
	public function find_courses_by_teacher_id()
	{
		$query = "SELECT * FROM `courses_in_reports`,
								`courses`,
								`reports`,
								`class`
				  WHERE `teachers_id` = '".$_SESSION['id']."'
				  AND `courses_in_reports`.`courses_id` = `courses`.`course_id`
				  AND `courses_in_reports`.`reports_id` = `reports`.`id`
				  AND `reports`.`class` = `class`.`class_id`";
		return $this->query($query);
	}

	public function find_students_by_class_id_and_year($class_id, $year)
	{
		$query = "SELECT * 
				  FROM   `students_class`, `users`
				  WHERE  `students_class`.`class`		= '".$class_id."'
				  AND 	 `students_class`.`year`		= '".$year."'
				  AND	 `students_class`.`student_id`	= `users`.`user_id`";
		return $this->query($query);
	}

	public function insert_into_grades($post)
	{
		date_default_timezone_set("Europe/Amsterdam");
		$date = date("Y-m-d H:i:s");
		$query = "";
		//var_dump($post);exit();
		//echo sizeof($post);
		for ( $i = 0; $i < sizeof($post['user_id']); $i++)
		{
			for ($j = 0; $j <= $post['number_of_marks']; $j++)
			{
				$grade = $this->find_grade_record($post['course_id'], $post['user_id'][$i], $j );
				if (empty($grade))
				{
					$query = "INSERT INTO `grades` ( `id`,
													  `course_id`,
													  `mark`,
													  `date`,
													  `student_id`,
													  `exam_number`)
											VALUES  ( NULL,
													  '".$post['course_id']."',
													  '".$post['mark'.$j][$i]."',
													  '".$date."',
													  '".$post['user_id'][$i]."',
													  '".$j."');";
				}
				else
				{
					$query = "UPDATE `grades` SET `mark` = '".$post['mark'.$j][$i]."',
											  `date` = '".$date."'
							   WHERE `course_id`  = '".$post['course_id']."'
							   AND	 `student_id` = '".$post['user_id'][$i]."'
							   AND	 `exam_number`= '".$j."'";
				}
				$this->query($query);
			}		
		}
	}

	public function find_grade_record($course_id, $student_id, $exam_number)
	{
		$query = "SELECT * FROM `grades`
				  WHERE `course_id` 	= '".$course_id."'
				  AND 	`student_id`	= '".$student_id."'
				  AND	`exam_number`	= '".$exam_number."'";
		//echo $query; exit();		  
		return $this->query($query, 1);	
	}
 }
?>