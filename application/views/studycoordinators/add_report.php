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
	<form action='<?php echo BASE_URL; ?>studycoordinators/add_report' method='post'>
		<tr>
			<td>Jaar</td>
			<td>
				<select name='year'>
					<?php echo $year; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Blok</td>
			<td>
				<select name='term'>
					<?php echo $term; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Klas</td>
			<td>
				<select name='class'>
					<?php echo $class; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Cesuur blokcijfer</td>
			<td>
				<input type='text' name='cesure' />
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