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
		var_dump($result);
		foreach ($result as $value)
		{
			$value['Course']['number_of_marks'];
		}

		$report = "";

		foreach ($result as $value)
		{
			$marks = $this->_model->find_marks_by_course_id_and_student_id($value['Course']['course_id']);
			var_dump($marks);
			$report .= "<tr>
							<td>".$value["Course"]["course"]."</td>";
						foreach ($marks as $value)
						{
								$report .= "<td>".$value['Grade']['mark']."</td>";
						}
			$report .= "</tr>";
		}

		$this->set("report", $report);
		var_dump($result);
	}
 }
?>