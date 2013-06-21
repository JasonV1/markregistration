
	public function edit_students()
	{
		if ( isset($_POST['submit']) )
		{
			//var_dump($_POST);
			for ( $i = 0; $i < sizeof($_POST['id']); $i++)
			{
				//echo $_POST['id'][$i]." | ". $_POST['class'][$i]."<br />";
			}
			$this->_model->insert_into_students_class($_POST);
		}
		$select_students = $this->_model->select_all_students();
		//var_dump($select_students);
		$select_class = $this->_model->select_all_classes();
		//var_dump($select_class);		
		$students = "";
		foreach ($select_students as $value)
		{
			$find_class = $this->_model->find_class_student($value['User']['user_id']);
			$find_class = (sizeof($find_class) == 0) ? "-" : $find_class[0]['Students_cla']['class'];
			//var_dump($find_class);
			//var_dump($value);
			$students .= "<tr>
							<td>".$value['User']['user_id']."</td>
							<td>".$value['User']['firstname']."</td>
							<td>".$value['User']['infix']."</td>
							<td>".$value['User']['surname']."</td>
							
							<td>
								<select name='class[]'>
									<option value='0'>-kies een klas-</option>";
									foreach ($select_class as $class)
									{ 
										$students .= "<option ";
										if ($class['Cla']['class_id'] == 
											$find_class)
										{
											$students .= "selected='selected'";
										}
										$students .= "value='".$class['Cla']['class_id']."'>".$class['Cla']['class']."</option>";
									}
							$students .= "</select>
							</td>
							<td>".$class['Cla']['class']."</td>
								<td>
									<a href='./updateuser/".$value['User']['user_id']."'>
										<img src='../public/img/b_edit.png' alt='edit' />
									</a>
								</td>
						  </tr>
						  <input type='hidden' name='id[]' value='".$value['User']['user_id']."' />";
		}
		$this->set('header', 'Plaats de onderstaande studenten in een klas');
		$this->set('students', $students);
	}
	
	public function updateuser($id)
	{
		if (isset($_POST['submit']))
		{
			//var_dump($_POST);
			$this->_model->updateuser($_POST, $id);
			header("location:../viewall");
		}
		$this->set('header', 'Wijzig het onderstaande record');
		$user = $this->_model->findstudent($id);
		$this->set('id', $user['User']['user_id']);
		$this->set('firstname', $user['User']['firstname']);
		$this->set('infix', $user['User']['infix']);
		$this->set('surname', $user['User']['surname']);
		$this->set('emailaddress', $user['Login']['emailaddress']);

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
	public function mark_overview()
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