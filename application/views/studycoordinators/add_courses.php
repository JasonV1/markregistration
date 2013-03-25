<style>
	select
	{
		min-width:154px;
	}
	td
	{
		padding:0.3em;
		font-size:1em;
	}
	input
	{
		padding:0.2em;
		min-width:158px;
	}
</style>
<?php echo $style; ?>
<h3 class='header'><p class='header'><?php echo $header; ?></p></h3>
<table>
	<form action='./add_courses' method='post'>
		<tr>
			<td>Vaknaam</td>
			<td>
				<input type='text' name='course' />
			</td>
		</tr>
		<tr>
			<td>Beschrijving</td>
			<td>
				<input type='text' name='course_description' />
			</td>
		</tr>
		<tr>
			<td>Aantal cijfers</td>
			<td>
				<select name='number_of_marks'>
					<?php echo $number_of_marks; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Docent</td>
			<td>
				<select name='teacher_id'>
					<?php echo $all_teachers; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type='submit' name='submit' />
			</td>
		</tr>
	</form>
</table>