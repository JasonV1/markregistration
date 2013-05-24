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

<h3><?php echo $header; ?></h3>
<table>
	<form action='<?php echo BASE_URL; ?>teachers/add_marks' method='post'>
		<tr>
			<th>LLNR</th>
			<th>Voornaam</th>
			<th>Tussenvoegsel</th>
			<th>Achternaam</th>
			<?php echo $th_marks; ?>
		</tr>
		<?php echo $students; ?>
		<tr>
			<td colspan='4'></td>
			<td colspan'2'><input type='submit' name='submit' value='Versturen' width='40em' /></td>
		</tr>
	</form>
</table>