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
					echo "<li><a href='".BASE_URL."users/viewall'>View All</a></li>";
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