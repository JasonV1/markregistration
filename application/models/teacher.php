<?php
 class Teacher extends Model
 {
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
			for ($j = 0; $j < $post['number_of_marks']; $j++)
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