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
	
	<?php echo $th_table; ?>
	<?php echo $report; ?>
</table>

<SCRIPT LANGUAGE="JavaScript"> 
if (window.print) {
document.write('<form><input type=button name=print value="Pagina printen" onClick="window.print()"></form>');
}
</script>