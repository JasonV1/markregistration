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
			
			$class = "";
			$this->_model->select_all_classes();
	}
	
	public function add_class()
	{
		if ( isset($_POST['submit']))
		{
			$succes = $this->_model->insert_into_class($_POST);
			if ($failure)
			{
				$failure = "<style>
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
				$failure = "<style>
							h3.header { color:white;}
							p.header { background-color: red; 
								   width:300px; 
								   height:20px;
								   padding:1em;}
							</style>";
				$this->set('header', 'De klas is toegevoegd');
			}
			$this->set('style', $style);
			$this->set('failure', $failure);
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
 }
?>