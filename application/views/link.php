<div id='link'>
	<ul>
		<?php if (isset($_SESSION['userrole']))
		{
			echo "<li><a href='../users/logout'>Logout</a></li>";
			switch ($_SESSION['userrole'])
			{
				case 'student':
					echo "<li><a href='".BASE_URL."students/report_overview'>View Marks</a></li>";
				break;
				case 'teacher':
					echo "<li><a href='".BASE_URL."teachers/view_marks'>View Marks</a></li>";
				break;
				case 'root':
				break;
				case 'administrator':
					echo "<li><a href='".BASE_URL."users/adduser'>Add User</a></li>";
					echo "<li><a href='".BASE_URL."users/viewall'>All Users</a></li>";
					echo "<li><a href='".BASE_URL."administrators/view_students'>Students</a></li>";
				break;
				case 'studycoordinator':
					echo "<li><a href='".BASE_URL."studycoordinators/add_class'>Add Class</a></li>";
					echo "<li><a href='".BASE_URL."studycoordinators/add_courses'>Add Course</a></li>";
					echo "<li><a href='".BASE_URL."studycoordinators/add_report'>Add Report</a></li>";
					echo "<li><a href='".BASE_URL."studycoordinators/report_overview'>Report Overview</a></li>";
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