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
				  FROM 	`students_class`, `users`
				  WHERE `students_class`.`class` 		= '".$class_id."'
				  AND 	`students_class`.`year` 		= '".$year."'
				  AND 	`students_class`.`student_id` 	= `users`.`user_id`";
		return $this->query($query);
	}
 }
?>