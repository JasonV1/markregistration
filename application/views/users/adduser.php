<?php echo $headertekst; ?>
<form action='../users/add' method='post'>
	<table>
		<tr>
			<td>voornaam:</td>
			<td><input type='text' name='firstname' placeholder='Hier de voornaam' /></td>
		</tr>
		<tr>
			<td>tussenvoegsel:</td>
			<td><input type='text' name='infix' placeholder='Hier het tussenvoegsel' /></td>
		</tr>
		<tr>
			<td>achternaam:</td>
			<td><input type='text' name='surname' placeholder='Hier de achternaam' /></td>
		</tr>
		<tr>
			<td>e-mailadres:</td>
			<td><input type='text' name='emailaddress' placeholder='Hier het e-mailadres' /></td>
		</tr>
		<tr>
			<td>gebruikersrol:</td>
			<td>
				<select name='userrole'>
					<?php echo $userroles; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>password:</td>
			<td><input type='password' name='password' placeholder='Hier het wachtwoord' /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='submit' value='verstuur' /></td>
		</tr>
	</table>
</form>