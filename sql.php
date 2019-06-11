<?php 

$sql = "";
if(isset($_POST['btnSql'])){ //check if form was submitted
  $sql = $_POST['txtSql']; //get input text
}else{
	$sql = "select  * from users";
}  

$css_lib = '<link href="css/site.css" rel="stylesheet">
<link href="css/sql.css" rel="stylesheet">';
$js_lib ="<script src='js/sql.js'></script>";
require('php/template.php');
require('php/connect_db.php');
$table = select_table($sql);
$db_tables = get_tables('option', true);

// $css_lib = '<link href="css/sql.css" rel="stylesheet">';
// $js_lib="<script>src='js/sql.js'</script>";


print_header($css_lib);

?>

<div id="t-wrapper">
	<div class="container-fluid header">
		<div class = "row">
			<div class="col-md-3">
				Tables
				<select>
					<?php echo $db_tables; ?>
				</select>
			</div>
			<div class="col-md-4">
				<form action="" method="post">
					<input type=submit class="btn btn-primary bwp-btn" id="btnSql" name="btnSql" value="Run" />
					<textarea id="txtSql" class="bwp-ta" rows="4" cols="45" name="txtSql"></textarea>
					<br />
					<span>Last Script: <code><?php echo $sql ?></code></span>
				</form>
			</div>
		</div>
	</div>
	<?php
	echo $table;
	?>

</div>

<?php
print_footer($js_lib);

?>