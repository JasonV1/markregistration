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
		<th><?php echo $blokcijfer; ?></th>
	</tr>
	
	<form action='<?php echo BASE_URL; ?>teachers/show_report_student' method='post'>
	<tr>
		<td>Toelichting</td>
		<td><textarea rows='4' maxlength="150" name='toelichting'></textarea></td>
	</tr>
</table>

<SCRIPT LANGUAGE="JavaScript"> 
if (window.print) {
document.write('<form><input type=button name=print value="Pagina printen" onClick="window.print()"></form>');
}
</script>