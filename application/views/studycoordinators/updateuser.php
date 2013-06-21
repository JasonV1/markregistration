<h3><?php echo $header; ?></h3>
<table>
	<form action='../updateuser/<?php echo $id; ?>' method='post'>
		<tr>
			<td>Voornaam</td>
			<td><input type='text' name='firstname' value='<?php echo $firstname; ?>' /></td>
		</tr>
		<tr>
			<td>Tussenvoegsel</td>
			<td><input type='text' name='infix'value='<?php echo $infix; ?>' /></td>
		</tr>
		<tr>
			<td>Achternaam</td>
			<td><input type='text' name='surname' value='<?php echo $surname; ?>' /></td>
		</tr>
		<tr>
			<td>E-mailadres</td>
			<td><input type='text' name='emailaddress' value='<?php echo $emailaddress; ?>' /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='submit' value='Update' /></td>
		</tr>
	</form>
</table>