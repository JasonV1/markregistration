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
							<td>".$value['Cla']['class']."</td>
							<td>".$value['Report']['year']."</td>
							<td>".$value['Report']['term']."</td>
							<td>".$value['Course']['course']."</td>
							<td>".$value['Course']['number_of_marks']."</td>
							<td>
								<a href='../teachers/add_marks'>
									<img src='../public/img/b_edit.png' alt='drop'/>
								</a>
							</td>
						 </tr>";
		}
		$this->set('courses', $courses);
	}
	
	public function add_marks()
	{
		$this->set('header', 'Invoeren cijfer');
	}
 }
?>