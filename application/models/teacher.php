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
 }
?>