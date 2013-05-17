<?php
 class AdministratorsController extends Controller
 {
	public function homepage()
	{
		$this->set('header', 'Admin homepage');
	}
	
	public function view_students()
	{
		if ( isset($_POST['submit']) )
		{
			var_dump($_POST);
			for ( $i = 0; $i < sizeof($_POST['id']); $i++)
			{
				
			}
			//$merged_array = array_merge($_POST['id'], $POST['class']);
			$this->_model->insert_into_students_class($_POST);
		}
		$select_students = $this->_model->select_all_students();
		//var_dump($select_students);
		$select_class = $this->_model->select_all_classes();
		var_dump($select_class);
		$students = "";
		foreach ($select_students as $value)
		{
			$find_class = $this->_model->find_class_student($value['User']['user_id']);
			$students .= "<tr>
							<td>".$value['User']['user_id']."</td>
							<td>".$value['User']['firstname']."</td>
							<td>".$value['User']['infix']."</td>
							<td>".$value['User']['surname']."</td>
							<td>
								<select name=''>
									<option>-kies een klas-</option>";
									foreach ($select_class as $class)
									{
										$students .= "<option>".$class['Cla']['class']."</option>";
									}
							 $students .= "</select>
							</td>
						  </tr>";
		}
		$this->set('header', 'Plaats de onderstaande studenten in een klas');
		$this->set('students', $students);
	}
 }
?>