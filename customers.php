<?php 



$sql = "select  * from customers";

$css_lib = '<link href="css/site.css" rel="stylesheet">
<link href="css/sql.css" rel="stylesheet">';
$js_lib ="<script src='js/customers.js'></script>";
require('php/template.php');
require('php/connect_db.php');
$table = select_table($sql, 'tblCustomers');

$states = $GLOBALS['states'];
$provinces = $GLOBALS['provinces'];
$countries = $GLOBALS['countries'];

$states_provinces = array_merge($states, $provinces);
asort($states_provinces);
$sp_select_opt = "";
$countries_select_opt = "";

foreach ($states_provinces as $key => $value) {
    global $sp_select_opt;
    $sp_select_opt .= "<option value='$key'>".ucwords(strtolower($value))."</option>\n";
}

foreach ($countries as $key => $value) {
    global $countries_select_opt;
    $countries_select_opt .= "<option value='$value'>".$value."</option>\n";
}


// $css_lib = '<link href="css/sql.css" rel="stylesheet">';
// $js_lib="<script>src='js/sql.js'</script>";
//print_r($states_provinces);

print_header($css_lib, '.bwp-customers');

?>

<div id="t-wrapper">
	<div class="container-fluid header">
		<div class = "row">
            <div class="col-md-12">
                <form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="txtCompanyName">Company</label>
      <input type="text" class="form-control" id="txtCompanyName"  name="txtCompanyName" placeholder="Person or Company Name">
    </div>
    <div class="form-group col-md-6">
      <label for="txtDescription">Description</label>
      <input type="text" class="form-control" id="txtDescription" name="txtDescription" placeholder="Brief description of company">
    </div>
  </div>
<div class="form-row ">
  <div class="form-group col-md-6">
    <label for="txtAddress1">Address Line 1</label>
    <input type="text" class="form-control" id="txtAddress1" placeholder="1234 Main St">
  </div>
  <div class="form-group col-md-6">
    <label for="txtAddress2">Address Line 2</label>
    <input type="text" class="form-control" id="txtAddress2" name="txtAddress2" placeholder="Apartment, studio, or floor">
  </div>
</div>

  <div class="form-row">
     <div class="form-group col-md-3">
      <label for="selCountries">Country</label>
      <select id="selCountries" class="form-control" name="selCountries">
        <option selected val="NULL">Choose...</option>
        <option value="NA">N/A</option>
        <?php echo $countries_select_opt; ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="txtCity">City</label>
      <input type="text" class="form-control" id="txtCity" name="txtCity">
    </div>
    <div class="form-group col-md-3">
      <label for="selState">State or Province</label>
      <select id="selState" class="form-control" name="selState" >
        <option selected val="NULL">Choose...</option>
        <option value="NA">N/A</option>
        <?php echo $sp_select_opt; ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="txtPostalCode">Zip/Postal Code</label>
      <input type="text" class="form-control" id="txtPostalCode" name="txtPostalCode"/>
    </div>
  </div>

  <div class="form-row">
     <div class="form-group col-md-3">
      <label for="txtPhone1">Phone 1</label>
      <input type="text" class="form-control" id="txtPhone1" name="txtPhone1">
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="txtPhone2">Phone 2</label>
      <input type="text" class="form-control" id="txtPhone2" name="txtPhone2">
    </div>
    <div class="form-group col-md-3">
      <label for="txtFax">Fax</label>
      <input type="text" class="form-control" id="txtFax" name="txtFax">
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="txtEmail">Email</label>
      <input type="text" class="form-control" id="txtEmail" name ="txtEmail">
    </div>
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="chkActive">
      <label class="form-check-label" for="chkActive">
        Active
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