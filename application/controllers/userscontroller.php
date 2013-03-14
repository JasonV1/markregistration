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
		$this->set('emailaddress', $_POST['emailaddress']);
		$this->set('userrole', $_POST['userrole']);
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
								<td>".$value['User']['user_id']."</td>
								<td>".$value['User']['firstname']."</td>
								<td>".$value['User']['infix']."</td>
								<td>".$value['User']['surname']."</td>
								<td>".$value['Login']['emailaddress']."</td>
								<td>".$value['Userrole']['userrole']."</td>
								<td>
									<a href='./removeuser/".$value['User']['user_id']."'>
									<img src='../public/img/kruisje.png' 
									alt='drop'/>
									</a>
								</td>
								<td>
									<a href='./updateuser/".$value['User']['user_id']."'>
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
		$this->set('id', $user['User']['user_id']);
		$this->set('firstname', $user['User']['firstname']);
		$this->set('infix', $user['User']['infix']);
		$this->set('surname', $user['User']['surname']);
		$this->set('emailaddress', $user['Login']['emailaddress']);
		$this->set('userrole', $user['Userrole']['userrole']);
		$this->set('password', $user['Login']['password']);
		//var_dump($user);
	}
	
	public function login()
	{
		//var_dump($_POST);
		if (!empty($_POST['username']) && !empty($_POST['password']))
		{
			$user = $this->_model->select_user_from_login($_POST);
			if ( sizeof($user) > 0)
			{
				$_SESSION['userrole'] = $user[0]['Userrole']['userrole'];
				switch($user[0]['Userrole']['userrole'])
				{
					
					case 'student':
						
						$homepage = '../students/homepage';
					break;
					case 'teacher':
						$homepage = '../teachers/homepage';
					break;
					case 'root':
						$homepage = '../roots/homepage';
					break;
					case 'administrator':
						$homepage = '../administrators/homepage';
					break;
					default:
				}
				
				$header = "Inlog succesvol<br />
					       U wordt nu doorgestuurd naar de homepage";
			}
			else
			{
				$header = "Inlog onsuccesvol<br />
						   En nu opzouten";
				$homepage = '../users/viewall';
			}
			$this->set('header', $header);
			header('refresh:4;url='.$homepage);
		}
		else
		{
			$header = "U heeft een van de velden of beiden niet ingevuld.<br />
					   U wordt doorgestuurd naar de homepage.";
			$this->set('header', $header);
			header('refresh:4;url=../users/viewall');
		}
	}
	
	public function logout()
	{
		if(isset($_SESSION['userrole']))
		{
			session_destroy();
			header('location:../users/logout');
		}
		else
		{
			$this->set('header', 'U bent succesvol uitgelogd, u wordt doorgestuurd naar home');
			header('refresh:4;url=../users/generalhomepage');
		}
	}
	
	public function generalhomepage()
	{
		$this->set('header', 'Welkom bij het cijferregistratie systeem van MBO-Utrecht.');
	}
 }
?>