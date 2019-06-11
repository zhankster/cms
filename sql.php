<?php 

$css_lib = '<link href="css/sql.css" rel="stylesheet">';
$js_lib ="<script src='js/sql.js'></script>";
require('php/template.php');
require('php/connect_db.php');
$table = select_table("select  * from users");

// $css_lib = '<link href="css/sql.css" rel="stylesheet">';
// $js_lib="<script>src='js/sql.js'</script>";


print_header($css_lib);

?>

<div id="t-wrapper">
			<?php
			echo $table;
			?>

</div>

<?php
print_footer($js_lib);

?>