<?php
 class AdministratorsController extends Controller
 {
	public function homepage()
	{
		$this->set('header', 'Dit is de administrators homepage');
	}

	public function view_students()
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
						  </tr>
						  <input type='hidden' name='id[]' value='".$value['User']['user_id']."' />";
		}
		$this->set('header', 'Plaats de onderstaande studenten in een klas');
		$this->set('students', $students);
	}
 }
?>