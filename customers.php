<?php 

$sql = "select  * from customers";

$css_lib = '<link href="css/site.css" rel="stylesheet">
<link href="css/sql.css" rel="stylesheet">';
$js_lib ="<script src='js/sql.js'></script>";
require('php/template.php');
require('php/connect_db.php');
$table = select_table($sql);

// $css_lib = '<link href="css/sql.css" rel="stylesheet">';
// $js_lib="<script>src='js/sql.js'</script>";


print_header($css_lib, '.bwp-customers');

?>

<div id="t-wrapper">
	<div class="container-fluid header">
		<div class = "row">
            <div class="col-md-12">
                <form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="txtCompanyName"></label>
      <input type="text" class="form-control" id="txtCompanyName"  name="txtCompanyName" placeholder="Company Name">
    </div>
    <div class="form-group col-md-6">
      <label for="txtDescription">Description</label>
      <input type="text" class="form-control" id="txtDescription" name="txtDescription" placeholder="Brief description of company">
    </div>
  </div>
<div class="form-row ">
  <div class="form-group col-md-6">
    <label for="txtAddress">Address Line 1</label>
    <input type="text" class="form-control" id="txtAddress1" placeholder="1234 Main St">
  </div>
  <div class="form-group col-md-6">
    <label for="txtAddress2">Address Line 2</label>
    <input type="text" class="form-control" id="txtAddress2" name="txtAddress2" placeholder="Apartment, studio, or floor">
  </div>
</div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="txtCity">City</label>
      <input type="text" class="form-control" id="txtCity" name="txtCity">
    </div>
    <div class="form-group col-md-4">
      <label for="txtState">State or Province</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
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