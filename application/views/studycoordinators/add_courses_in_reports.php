<style>
td, th
{
	padding:0.5em;
}
</style>

<h3><?php echo $header; ?></h3>
<table>
<form action='<?php echo BASE_URL; ?>studycoordinators/add_courses_in_reports/<?php echo $report_id; ?>' method='post'>
	<tr>
		<td>
			Kies een vak:
		</td>
		<td>
			<select name='course'>
				<?php echo $courses; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Kies een docent:
		</td>
		<td>
		
			<select name='teacher'>
				<?php echo $teachers; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Weging:
		</td>
		<td>
			<input type='text' name='weight' />
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
			<input type='submit' name='submit' />
		</td>
	</tr>
	<tr>
		<input type='hidden' name='report_id' value='<?php echo $report_id; ?>' />
	</tr>
</form>
</table>