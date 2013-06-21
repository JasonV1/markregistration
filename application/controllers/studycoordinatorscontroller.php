<?php
 class StudycoordinatorsController extends Controller
 {
	public function homepage()
	{
		$this->set('header', "Studycoordinator homepage");
	}
	
	public function add_courses()
	{
	
		if ( isset($_POST['submit']))
		{
			$this->_model->insert_into_courses($_POST);
			$style = "<style>
						h3.header { color:white;}
						p.header { background-color: green; 
								   width:300px; 
								   height:20px;
								   padding:1em;}
						
					  </style>";
			$this->set('style', $style);
			$this->set('header', 'Het vak is toegevoegd');
			header('refresh:4;url=./add_courses');
		}
		else
		{
			$this->set('header', 'Voeg een vak toe');
			$this->set('style', '');
		}
			$number_of_marks = '';
			for ( $i = 1; $i < 5; $i++)
			{
				$number_of_marks .= "<option value='".$i."'>".$i."</option>";
			}
			$this->set('number_of_marks', $number_of_marks);
			$teachers = $this->_model->find_all_teachers();
			//var_dump($teachers);
			$all_teachers = "";
			foreach($teachers as $value)
			{
				$all_teachers .="<option value='".$value['User']['user_id']."'>".
													 $value['User']['firstname']." ".
													 $value['User']['infix']." ".
													 $value['User']['surname'].
								"</option>";
			}
			$this->set('all_teachers', $all_teachers);
		
		
	}
	
	public function add_report()
	{
	
		if ( isset($_POST['submit']))
		{
			$this->_model->insert_into_reports($_POST);
			$style = "<style>
						h3.header { color:white;}
						p.header { background-color: green; 
								   width:300px; 
								   height:20px;
								   padding:1em;}
						
					  </style>";
			$this->set('style', $style);
			$this->set('header', 'Het rapport is toegevoegd');
			header('refresh:4;url=./add_report');
		}
		else
		{
			$this->set('header', 'Voeg een rapport toe');
			$this->set('style', '');
		}
			$year = '';
			for ( $i = 2012; $i < 2017; $i++)
			{
				$year .= "<option value='".$i."'>".$i."</option>";
			}
			$this->set('year', $year);
			
			$term = '';
			for ( $i = 1; $i < 5; $i++)
			{
				$term .= "<option value='".$i."'>".$i."</option>";
			}
			$this->set('term', $term);
			
			$class = '';
			$classes = $this->_model->select_all_classes();
			foreach ($classes as $value)
			{
				$class .= "<option value='".$value['Cla']['class_id']."'>".
											$value['Cla']['class'].
						  "</option>";
			}
			$this->set("class", $class);
	}
	
	public function add_class()
	{
		if ( isset($_POST['submit']))
		{
			$succes = $this->_model->insert_into_class($_POST);
			if ($succes)
			{
				$style = "<style>
							h3.header { color:white;}
							p.header { background-color: red; 
								   width:300px; 
								   height:20px;
								   padding:1em;}
						
							</style>";
				$this->set('header', 'De klas is niet toegevoegd');
			
			}
			else
			{
				$style = "<style>
							h3.header { color:white;}
							p.header { background-color: green; 
								   width:300px; 
								   height:20px;
								   padding:1em;}
							</style>";
				$this->set('header', 'De klas is toegevoegd');
			}
			$this->set('style', $style);
			header('refresh:4;url=./add_class');
		}
		else
		{
			$this->set('header', 'Voeg een klas toe');
			$this->set('style', '');
		}
		$teachers = $this->_model->find_all_teachers();
		$mentor = "";
		foreach ($teachers as $value)
		{
			$mentor .= "<option value='".$value['User']['user_id']."'> ".
										 $value['User']['firstname']." ".
										 $value['User']['infix']." ".
										 $value['User']['surname']."</option>";
		}
		
		$year = '';
			for ( $i = 2012; $i < 2017; $i++)
			{
				$year .= "<option value='".$i."'>".$i."</option>";
			}
			$this->set('year', $year);
		$this->set('mentor', $mentor);
	}
	
	public function report_overview()
	{
		$this->set('header', "Overzicht Rapporten");
		$all_reports = $this->_model->select_all_from_reports();
		//var_dump($all_reports);
		$reports = "";
		foreach ( $all_reports as $value )
		{
			$reports .= "<tr>
							<td>".$value['Report']['id']."</td>
							<td>".$value['Report']['year']."</td>
							<td>".$value['Report']['term']."</td>
							<td>".$value['Cla']['class']."</td>
							<td>
								<a href='../studycoordinators/view_courses_in_reports/".
									$value['Report']['id']."'>
									<img src='../public/img/b_view.png' alt='view'/>
								</a>
							</td>
							<td><a href='../studycoordinators/add_courses_in_reports/".$value['Report']['id']."'>
									<img src='../public/img/b_edit.png' alt='drop'/>
								</a>
							</td>
						</tr>";
		}
		$this->set('reports', $reports);
	}
	
	public function view_courses_in_reports($id)
	{
		$courses = $this->_model->select_courses_in_report($id);
		//var_dump($courses);
		$tbl_courses = "";
		foreach ( $courses as $value )
		{
			$tbl_courses .= "<tr>
								<td>".$value['Course']['course_id']."</td>
								<td>".$value['Course']['course']."</td>
								<td>".$value['Course']['course_description']."</td>
								<td>".$value['Course']['number_of_marks']."</td>
								<td>".$value['User']['surname']."</td>
								<td>".$value['Courses_in_report']['weight']."</td>
								<td>
									<a href='../remove_course_in_report/".
												$value['Course']['course_id']."/".
												$id."'>
										<img src='../../public/img/kruisje.png' alt='remove' />
									</a>
								</td>
							 </tr>";
		}
		$this->set("table", $tbl_courses);
		$this->set('header', "Vakken in het rapport");
	}
	
	public function add_courses_in_reports($id)
	{
		if ( isset($_POST['submit']) )
		{
			$this->_model->insert_into_courses_in_report($_POST, $id);
			header('location:../report_overview');
		}
		else
		{
			$all_courses = $this->_model->select_all_courses();
			//var_dump($all_courses);
			$courses = "";
			foreach ( $all_courses as $value )
			{
				 $courses .= "<option value='".$value['Course']['course_id']."'>".
									$value['Course']['course'].
							"</option>";
			}
			$this->set('courses', $courses);

			$all_teachers = $this->_model->select_all_teachers();
			//var_dump($all_teachers);
			$teachers = "";
			foreach ( $all_teachers as $value )
			{
				 $teachers .= "<option value='".$value['User']['user_id']."'>".
									$value['User']['firstname']." ".
									$value['User']['infix']." ".
									$value['User']['surname'].
							"</option>";
			}
			$this->set('teachers', $teachers);
		}
		$this->set('report_id', $id);
		$this->set("header", "Add Courses to report");
	}
	
	public function remove_course_in_report($course_id, $report_id)
	{
		$this->_model->remove_course_in_report($course_id, $report_id);
		//echo "echo <a href='../../view_courses_in_reports/".$reports_id."'>test</a>";exit();
		$url = "location:../../view_courses_in_reports/".$reports_id."";
		header($url);
	}
	
 }
?>