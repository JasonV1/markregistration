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
<?php
	echo $style;
	
?>
<h3 class='header'><p class='header'><?php echo $header; ?></p></h3>
<table>
	<form action='./add_class' method='post'>
		<tr>
			<td>Kies een klas</td>
			<td>
				<select name='class'>
					<option value='AM1A'>AM1A</option>
					<option value='AM2A'>AM2A</option>
					<option value='AM3A'>AM3A</option>
					<option value='AM4A'>AM4A</option>
					<option value='MB1A'>MB1A</option>
					<option value='MB2A'>MB2A</option>
					<option value='MB3A'>MB3A</option>
					<option value='MB4A'>MB4A</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Kies een mentor</td>
			<td>
				<select name='mentor'>
					<?php echo $mentor; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Kies een jaar</td>
			<td>
				<select name='year'>
					<?php echo $year; ?>
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
<a href=''>Test</a>