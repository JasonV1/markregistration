<?php
 class StudentsController extends Controller
 {			
	public function homepage()
	{
		//Beveiliging
		$this->check_userrole('Homepage voor students', array('administrator', 'student'));
	} 

	private function check_userrole($header, $admitance)
	{
		if (!(in_array($_SESSION['userrole'], $admitance)))
		{
			$text = 'U bent niet bevoegd deze pagina te bekijken<br />';
			$text .= 'U wordt doorgestuurd naar de algemene homepage';
			$this->set('header', $text);
			header('refresh:4;url=../users/viewall');
		}
		else
		{
			$this->set('header', $header);
		}
	}

	public function report_overview()
	{
		$this->set("header", "Overzicht rapporten");
		$result = $this->_model->find_all_reports();

		$reports = "";

		foreach ($result as $value)
		{
			$terms = $this->_model->find_all_term_reports_by_year($value['Report']['year']);
			//var_dump($terms);
			$reports .= "<tr>
							<td>".$value['Report']['year']."</td>";
			foreach ($terms as $value)
			{
			   $reports .= "<td>
								<a href='".BASE_URL."students/report/"
										  .$value['Report']['id']."'>"
										  .$value['Cla']['class']."
								</a>
						    </td>";						 
			}
			$reports .= "</tr>";
		}		

		$this->set("reports", $reports);
		//var_dump($result);
	}

	public function report($report_id)
	{
		$this->set("header", "Rapport");
		$th_table = "";

		$result = $this->_model->find_courses_report_by_report_id($report_id);
		//var_dump($result);

		$report = "";
		
		//Maximaal aantal number of marks
		$max = 0;
		foreach ($result as $value)
		{
			if ($value['Course']['number_of_marks'] > $max)
			{
				$max = $value['Course']['number_of_marks'];
			}
		}
		echo $max;
		$th_table .= "<tr>
						<th>Vak</th>";
							  for ($i = 0; $i < $max; $i++)
							  {
								$th_table .= "<th>Cijfer".($i + 1)."</th>";
							  }
							  
								$th_table .= "<th colspan='2'>
											  &nbsp;</th>";
								$th_table .= "<th>rapportcijfer</th>
						  </tr>";
							
							

		foreach ($result as $value1)
		{
			$marks = $this->_model->find_marks_by_course_id_and_student_id($value1['Course']['course_id']);
			//var_dump($marks);
			
			
			$report .= "<tr>
							<td>".$value1["Course"]["course"]."</td>";

					   foreach ($marks as $value)
					   {
							if ($value['Grade']['exam_number'] != $value1['Course']['number_of_marks'])
							{
								$report .= "<td>".$value['Grade']['mark']."</td>";
							}
							else
							{
								$report .= "<td colspan='".(5 - $value1['Course']['number_of_marks'])."'>&nbsp;</td>
											<td>".$value['Grade']['mark']."</td>";
							}
					   }

					   /*
					   for ($i = 0; $i < $value['Course']['number_of_marks']; $i++)
					   {
							$report .= "<td>".$marks[$i]['Grade']['mark']."</td>";
					   }*/
			$report .= "</tr>";
		}


		$this->set("report", $report);
		$this->set("th_table", $th_table);

		//var_dump($result);
	}
	
	public function student_data()	
	{
		$this->set("header", "Gegevens student");
		
		$student_id = "";
		
		$data = $this->_model->find_student_data_by_id($student_id);
		
		$name_student = $data[0]['User']['firstname']." ".
						$data[0]['User']['infix']." ".
						$data[0]['User']['surname'];
						
		$id_student	  = $data[0]['User']['user_id'];
		
		$class = 		$data[0]['Cla']['class'];
		
		$found_mentor = $this->_model->find_mentor_by_id($data[0]['Cla']['mentor']);
		
		$mentor = $found_mentor['User']['firstname']." ".
				  $found_mentor['User']['infix']." ".
				  $found_mentor['User']['surname'];

		
		$this->set("class", $class);
		$this->set("name_student", $name_student);
		$this->set("id_student", $id_student);
		$this->set("mentor", $mentor);
	}
 }
?>