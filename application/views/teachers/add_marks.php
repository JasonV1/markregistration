<style>
td, th
{
	padding:0.5em;
}

input[type=text]
{
	width:1.5em;
}

input[type=submit]
{
	padding:0.5em;
}
</style>

<table>
	<form action='<?php echo BASE_URL; ?>teachers/add_marks/<?php echo $url; ?>' method='post'>
		<tr>
			<th>llnr</th>
			<th>voornaam</th>
			<th>tussenvoegsel</th>
			<th>Achternaam</th>
			<?php echo $th_marks; ?>
		</tr>
		<?php echo $students; ?>
		<tr>
			<td colspan='4'></td>
			<td colspan='3'><input type='submit' name='submit' value='verstuur' /></td>
		<tr>
	</form>
</table>