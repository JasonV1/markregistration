<?php
 class Student extends Model
 {
	public function find_all_reports()
	{
		$query = "SELECT DISTINCT `reports`.`year` FROM `students_class`, 
								`reports`
				  WHERE `student_id` = '".$_SESSION['id']."'
				  AND `students_class`.`class` = `reports`.`class`
				  AND `students_class`.`year` = `reports`.`year`";
		return $this->query($query);
	}

	public function find_all_term_reports_by_year($year)
	{
		$query = "SELECT * FROM `students_class`, 
								`reports`,
								`class`
				  WHERE `student_id` = '".$_SESSION['id']."'
				  AND `students_class`.`class` = `reports`.`class`
				  AND `students_class`.`year` = `reports`.`year`
				  AND `reports`.`year` = '".$year."'
				  AND `students_class`.`class` = `class`.`class_id`";
		return $this->query($query);
	}

	public function find_courses_report_by_report_id($report_id)
	{
		$query = "SELECT * FROM `courses_in_reports`, 
								`courses`
				  WHERE `courses_in_reports`.`courses_id` = `courses`.`course_id`
				  AND   `courses_in_reports`.`reports_id` = '".$report_id."'";
		return $this->query($query);
	}

	public function find_marks_by_course_id_and_student_id($course_id)
	{
		$query = "SELECT * FROM `grades`
				  WHERE `course_id` = '".$course_id."'
				  AND `student_id` = '".$_SESSION['id']."'";
		return $this->query($query);
	}
	
	public function find_student_data_by_id($student_id)
	{
		$query = "SELECT * FROM `users`, `class`, `students_class`, `grades`
				  WHERE `users`.`user_id` = `students_class`.`student_id`
				  AND `students_class`.`class` = `class`.`class_id`
				  AND   `users`.`user_id`	   = '".$_SESSION['id']."'";
		return $this->query($query);
	}
	
	public function find_mentor_by_id($mentor_id)
	{
		$query = "SELECT * FROM `users` WHERE `user_id` = '".$mentor_id."'";
		return $this->query($query, 1);
	}
 }
?>