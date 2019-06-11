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
            <h2>Future home of Some Thing</h2>
		</div>
	</div>


</div>

<?php
print_footer($js_lib);

?>