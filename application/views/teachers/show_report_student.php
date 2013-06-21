<style>
td
{
	padding:0.3em;
}
</style>

<?php echo $header; ?>
<h1><p>Rapport</h1></p>
<table>
	<tr>
		<td>naam student: </td>
		<td><?php echo $name_student; ?></td>
	</tr>
	<tr>
		<td>leerlingnr: </td>
		<td><?php echo $id_student; ?></td>
	</tr>
	<tr>
		<td>klas: </td>
		<td><?php echo $class; ?></td>
	</tr>
	<tr>
		<td>jaar: </td>
		<td><?php echo $year; ?></td>
	</tr>
	<tr>
		<td>blok: </td>
		<td><?php echo $term; ?></td>
	</tr>
	<tr>
		<td>studieloopbaanbegeleider: </td>
		<td><?php echo $mentor; ?></td>
	</tr>
	<tr>
		<td>datum: </td>
		<td><?php echo $date; ?></td>
	</tr>
	<tr>
		<th>Vak</th>
		<th>Cijfer</th>
	</tr>
	<?php echo $grades; ?>
	<tr>
		<th>Blokcijfer</th>
		<th><?php echo $max_points; ?> | <?php echo $points; ?> | <?php echo $blokcijfer; ?></th>
	</tr>
</table>