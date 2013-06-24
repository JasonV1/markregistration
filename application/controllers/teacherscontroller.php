<?php
 class TeachersController extends Controller
 {
	public function homepage()
	{
		$this->set('header', 'Dit is de teachers homepage');
	}

	public function view_marks()
	{
		$this->set('header', 'Overzicht in te vullen cijfers');
		$view_courses = $this->_model->find_courses_by_teacher_id();
		//var_dump($view_courses);
		$courses = "";
		foreach ($view_courses as $value)
		{
			$courses .= "<tr>
							<td>".$value['Report']['year']."</td>
							<td>".$value['Cla']['class']."</td>							
							<td>".$value['Report']['term']."</td>
							<td>".$value['Course']['course']."</td>
							<td>".$value['Course']['number_of_marks']."</td>
							<td>
								<a href='../teachers/add_marks/".
									$value['Cla']['class_id']."/".
									$value['Report']['year']."/".
									$value['Course']['number_of_marks']."/".
									$value['Course']['course_id']."'>
									<img src='../public/img/b_edit.png' alt='edit' />
								</a>
							</td>
						</tr>";
		}
		$this->set('courses', $courses);
	}
	
	

	public function add_marks($class_id, $year, $number_of_marks, $course_id)
	{
		if (isset($_POST['submit']))
		{		
			$this->_model->insert_into_grades($_POST);
		}

		$this->set('header', 'Voeg uw cijfers toe');
		$found_students = $this->_model->find_students_by_class_id_and_year($class_id, $year);
		//var_dump($found_students);
		$students = "";
		foreach ($found_students as $value)
		{
			$students .= "<tr>
							<td>".$value['User']['user_id']."</td>
							<td>".$value['User']['firstname']."</td>
							<td>".$value['User']['infix']."</td>
							<td>".$value['User']['surname']."</td>";
							for ($i = 0; $i <= $number_of_marks; $i++)
							{
								$record = $this->_model->find_grade_record($course_id, 
																 $value['User']['user_id'], 
																 $i);
								$mark = ( empty($record)) ? "-" : $record['Grade']['mark'];
								$students .= "<td>
												<input type='text' 
													   name=mark".$i."[]
													   value='".
													   $mark
													   ."'/>
											  </td>";
							}
			$students .= "</tr>
						  <input type='hidden' value='".$course_id."' name='course_id' />
						  <input type	= 'hidden' 
								 value	= '".$value['User']['user_id']."'
								 name 	= 'user_id[]' />
						  <input type	= 'hidden'
								 value	= '".$number_of_marks."'
								 name	= 'number_of_marks'";
		}		
		$this->set("students", $students);

		$th_marks = "";
		for ($i = 1; $i <= $number_of_marks; $i++)
		{
			$th_marks .= "<th>mark ".$i."</th>";
		}
		$th_marks .= "<th>report mark</th>";

		$this->set("th_marks", $th_marks);
		$this->set("url", $class_id."/".$year."/".$number_of_marks."/".$course_id);
	}
	
	public function view_reports($report_id=0)
	{
		$this->set('header', 'Overzicht rapporten');
		$view_courses = $this->_model->find_courses_by_teacher_id();
		//var_dump($view_courses);
		$courses = "";
		foreach ($view_courses as $value)
		{
			$courses .= "<tr>
							<td>".$value['Report']['year']."</td>
							<td>".$value['Cla']['class']."</td>							
							<td>".$value['Report']['term']."</td>
							<td>
								<a href='../teachers/show_students/".
									$value['Report']['id']."'>
									<img src='../public/img/b_edit.png' alt='edit' />
								</a>
							</td>
						</tr>";
		}
		$this->set('courses', $courses);
	}
	
	public function show_students($report_id)
	{
		$this->set("header", "Klik op een student om zijn rapport te zien");
		$found_students = $this->_model->find_students_by_report_id($report_id);
		//var_dump($found_students);
		$students = "";
		
		foreach($found_students as $value)
		{
			$students .= "<tr>
							<td>".$value['User']['firstname']."</td>
							<td>".$value['User']['infix']."</td>
							<td>".$value['User']['surname']."</td>
							<td>
								<a href='".BASE_URL.
										 "teachers/show_report_student/".
									$value['Report']['id']."/".
									$value['User']['user_id']."'>
									<img src='".BASE_URL."public/img/b_edit.png' alt='edit' />
								</a>
							</td>
						  </tr>
						  ";
		}
		$this->set("students", $students);
	}
	
	public function show_report_student($report_id, $user_id)
	{
		date_default_timezone_set("Europe/Amsterdam");
		$date = Date("d-m-Y");

		$this->set("header", "Rapport student");

		$found_report_grades = $this->_model->find_marks_by_report_id($report_id, $user_id);

		$max_points = 0;
		foreach ($found_report_grades as $value)
		{
			$max_points += $value['Courses_in_report']['weight'];
		}

		//var_dump($found_report_grades);
		$name_student = $found_report_grades[0]['User']['firstname']." ".
						$found_report_grades[0]['User']['infix']." ".
						$found_report_grades[0]['User']['surname'];
		$id_student   = $found_report_grades[0]['User']['user_id'];

		$class        = $found_report_grades[0]['Cla']['class'];

		$year		  = $found_report_grades[0]['Students_cla']['year'];

		$term		  = $found_report_grades[0]['Report']['term'];

		$found_mentor = $this->_model->find_mentor_by_id($found_report_grades[0]['Cla']['mentor']);

		//var_dump($found_mentor);

		$mentor = $found_mentor['User']['firstname']." ".
				  $found_mentor['User']['infix']." ".
				  $found_mentor['User']['surname'];

		$grades = "";

		$points = 0;
		foreach ($found_report_grades as $value)
		{
			$grades .= "<tr>
							<td>".$value['Course']['course']
								 ." (".$value['Courses_in_report']['weight']
								 .")
							</td>
							<td>".$value['Grade']['mark']."</td>	
						</tr>";
			if ( $value['Grade']['mark'] == "V" || $value['Grade']['mark'] == "G")
			{
				$points += $value['Courses_in_report']['weight'];
			}
		}

		$blokcijfer = "";
		if ( $points > 0.7 * $max_points)
		{
			$blokcijfer = "V";
		}
		else
		{
			$blokcijfer = "O";
		}


		$this->set("grades", $grades);
		$this->set("name_student", $name_student);
		$this->set("id_student", $id_student);
		$this->set("class", $class);
		$this->set("year", $year);
		$this->set("term", $term);	
		$this->set("mentor", $mentor);	
		$this->set("date", $date);	
		$this->set("max_points", $max_points);
		$this->set("points", $points);
		$this->set("blokcijfer", $blokcijfer);
	}
 }
?>