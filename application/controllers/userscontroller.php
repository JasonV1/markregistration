<?php
 class UsersController extends Controller
 {
	public function adduser()
	{
		$headertekst = "Vul hieronder uw gegevens in";
		$this->set('headertekst', $headertekst);
	}
	
	public function add()
	{
		$this->set('firstname', $_POST['firstname']);
		$this->set('infix', $_POST['infix']);
		$this->set('surname', $_POST['surname']);
		$this->set('announcement', 'Het volgende record is toegevoegd');
		
		$this->_model->insert_into_users($_POST);
		header("refresh:4;url=../users/viewall");
	}
	
	public function viewall()
	{
		$this->set('header', 'All Users');
		$all_users = $this->_model->select_all();
		$this->set("all_users", $all_users);
		$show_table = '';
		
		foreach ($all_users as $value)
		{
			$show_table .= "<tr>
								<td>".$value['User']['id']."</td>
								<td>".$value['User']['firstname']."</td>
								<td>".$value['User']['infix']."</td>
								<td>".$value['User']['surname']."</td>
								<td>
									<a href='./removeuser/".$value['User']['id']."'>
									<img src='../public/img/kruisje.png' 
									alt='drop'/>
									</a>
								</td>
								<td>
									<a href='./updateuser/".$value['User']['id']."'>
									<img src='../public/img/b_edit.png' 
									alt='drop'/>
									</a>
								</td>
							</tr>";
		}
		$this->set('show_table', $show_table);
	}
	
	public function removeuser($id)
	{
		$this->_model->removeuser($id);
	
		header('location:../viewall');
	}
	
	public function updateuser($id)
	{
		if (isset($_POST['submit']))
		{
			//var_dump($_POST);
			$user = $this->_model->updateuser($_POST, $id);
			header('location:../viewall');
		}
		$this->set('header', 'Wijzig record');
		$user = $this->_model->finduser($id);
		$this->set('id', $user[0]['User']['id']);
		$this->set('firstname', $user[0]['User']['firstname']);
		$this->set('infix', $user[0]['User']['infix']);
		$this->set('surname', $user[0]['User']['surname']);
		//var_dump($user);
	}
 }
?>