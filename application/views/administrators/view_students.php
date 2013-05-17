<style>
td, th
{
	padding:0.3em;
}
</style>
<h3><?php echo $header; ?></h3>
<form action='<?php echo BASE_URL; ?>administrators/view_students' method='post'>
<table>
	<tr>
		<th>id</th>
		<th>voornaam</th>
		<th>tussenvoegsel</th>
		<th>achternaam</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
	<?php echo $students; ?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type='submit' name='submit' value='Verstuur' /></td>
	</tr>
</table>