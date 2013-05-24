<?php
 class TeachersController extends Controller
 {
	public function homepage()
	{
		$this->set('header', 'Dit is de teachers homepage');
	}
	
	public function view_marks()
	{
		$this->set('header', 'Overzicht cijfers');
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
									$value['Course']['number_of_marks']."'>
									<img src='../public/img/b_edit.png' alt='drop'/>
								</a>
							</td>
						 </tr>";
		}
		$this->set('courses', $courses);
	}
	
	public function add_marks($class_id, $year, $number_of_marks)
	{
		if (isset($_POST['submit']))
		{
			var_dump($_POST);
			$this->set("students", "");
			$this->set("th_marks", "");
		}
		$this->set('header', 'Invoeren cijfer');
		$found_students = $this->_model->find_students_by_class_id_and_year($class_id, $year);
		var_dump($found_students);
		
		$students = "";
		foreach($found_students as $value)
		{
			$students .= "<tr>
							<td>".$value['User']['user_id']."</td>
							<td>".$value['User']['firstname']."</td>
							<td>".$value['User']['infix']."</td>
							<td>".$value['User']['surname']."</td>";
							for ($i = 0; $i < $number_of_marks; $i++)
							{
								$students .= "<td>
												<input type='text' name=mark".$i."[] />
											 </td>";
							}
			$students .="</tr>";
		}
		
		$this->set("students", $students);
		
		$th_marks = "";
		for ($i = 1; $i <= $number_of_marks; $i++)
		{
				$th_marks .= "<th>mark".$i."</th>";
		}
							
		$this->set("th_marks", $th_marks);
	}
 }
?>