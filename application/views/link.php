<div id='link'>
	<ul>
		<?php if (isset($_SESSION['userrole']))
		{
			echo "<li><a href='../users/logout'>Logout</a></li>";
			switch ($_SESSION['userrole'])
			{
				case 'student':
				break;
				case 'teacher':
				break;
				case 'root':
				break;
				case 'administrator':
					echo "<li><a href='".BASE_URL."users/adduser'>Add User</a></li>";
					echo "<li><a href='".BASE_URL."users/viewall'>All Users</a></li>";
				break;
				case 'studycoordinator':
					echo "<li><a href='".BASE_URL."studycoordinators/add_class'>Add Class</a></li>";
					echo "<li><a href='".BASE_URL."studycoordinators/add_courses'>Add Course</a></li>";
					echo "<li><a href='".BASE_URL."studycoordinators/add_report'>Add Report</a></li>";
				break;
				default:
			}
		
		}
		else
		{
			echo "<li><a href=''>TODO</a></li>";
		}
		?>
		
		
	</ul>
</div>