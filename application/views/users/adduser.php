<?php echo $headertekst; ?>
<form action='../users/add' method='post'>
	<table>
		<tr>
			<td>voornaam:</td>
			<td><input type='text' name='firstname' placeholder='Hier uw voornaam' /></td>
		</tr>
		<tr>
			<td>tussenvoegsel:</td>
			<td><input type='text' name='infix' placeholder='Hier uw tussenvoegsel' /></td>
		</tr>
		<tr>
			<td>achternaam:</td>
			<td><input type='text' name='surname' placeholder='Hier uw achternaam' /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='submit' value='verstuur' /></td>
		</tr>
	</table>
</form>