<style>
td, th
{
	padding:0.3em;
}
</style>
<h3><?php echo $header; ?></h3>
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
		<td><input type='submit' value='Verstuur' /></td>
	</tr>
</table>