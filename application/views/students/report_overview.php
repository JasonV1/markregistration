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
	<tr>
		<th>Jaar</th>
		<th>Blok 1</th>
		<th>Blok 2</th>
		<th>Blok 3</th>
		<th>Blok 4</th>	
	<tr>
	<?php echo $reports; ?>
</table>