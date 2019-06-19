<?php 



$sql = "select  * from customers";

$css_lib = '<link href="css/site.css" rel="stylesheet">
<link href="css/sql.css" rel="stylesheet">';
$js_lib ="<script src='js/customers.js'></script>";
require('php/template.php');
require('php/connect_db.php');
//$table = select_table($sql, 'tblCustomers');

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

if (isset($_POST["post_type"])) {
  update_add_customer($_POST["post_type"]);
}

function update_add_customer($type){
  $pdo = $GLOABLS['pdo'];
  if ($type=="add"){

      $sql = "INSERT INTO `customers`
        (`id`,
        `company_name`,
        `description`,
        `address1`,
        `address2`,
        `city`,
        `state`,
        `postal_code`,
        `country`,
        `phone1`,
        `phone2`,
        `fax`,
        `email`,
        `active`,
        `create_date`,
        `last_update`)
        VALUES
        (NULL,
        :company_name,
        :description,
        :address1,
        :address2,
        :city,
        :state,
        :postal_code,
        :country,
        :phone1,
        :phone2,
        :fax,
        :email,
        :active,
        Now(),
        Now())";
  }
  else{
    $sql = "
    UPDATE `bwp_co`.`customers`
    SET
      `company_name` = :company_name,
      `description` = :description,
      `address1` = :address1,
      `address2` = :address2,
      `city` = :city,
      `state` = :state,
      `postal_code` = :postal_code,
      `country` = :country,
      `phone1` = :phone1,
      `phone2` = phone2,
      `fax` = fax,
      `email` = :email,
      `active` = :active,
      `last_update` = Now()
    WHERE `id` = :id;
    ";
  }

  $stmt = $pdo->prepare($sql);

  $stmt->bindParam(':company_name', $_POST['company_name'], PDO::PARAM_STR);                                     
  $stmt->bindParam(':description', $_POST['description'], PDO::PARAM_STR);       
  $stmt->bindParam(':address1', $_POST['address1'], PDO::PARAM_STR); 
  $stmt->bindParam(':address2', $_POST['address2'], PDO::PARAM_STR);       
  $stmt->bindParam(':city', $_POST['city'], PDO::PARAM_STR);
  $stmt->bindParam(':state', $_POST['state'], PDO::PARAM_STR);       
  $stmt->bindParam(':postal_code', $_POST['postal_code'], PDO::PARAM_STR);
  $stmt->bindParam(':country', $_POST['country'], PDO::PARAM_STR);       
  $stmt->bindParam(':phone1', $_POST['phone1'], PDO::PARAM_STR);
  $stmt->bindParam(':phone2', $_POST['phone2'], PDO::PARAM_STR);       
  $stmt->bindParam(':fax', $_POST['fax'], PDO::PARAM_STR); 
  $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR); 
  $stmt->bindParam(':active', $_POST['active'], PDO::PARAM_STR); 

  $stmt->execute();
 
  unset( $stmt);
  unset( $pdo);

}

// $css_lib = '<link href="css/sql.css" rel="stylesheet">';
// $js_lib="<script>src='js/sql.js'</script>";
//print_r($states_provinces);

$table = select_table($sql, 'tblCustomers');

print_header($css_lib, '.bwp-customers');

?>

<div id="t-wrapper" class="t-wrapper">
	<div class="container-fluid header">
		<div class = "row">
            <div class="col-md-12">
                <form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="txtCompanyName">Company</label>
      <input type="text" class="form-control customer" id="txtCompanyName"  name="company_name" placeholder="Person or Company Name">
    </div>
    <div class="form-group col-md-6">
      <label for="txtDescription">Description</label>
      <input type="text" class="form-control customer" id="txtDescription" name="description" placeholder="Brief description of company">
    </div>
  </div>
<div class="form-row ">
  <div class="form-group col-md-6">
    <label for="txtAddress1">Address Line 1</label>
    <input type="text" class="form-control customer" id="txtAddress1" name="address1" placeholder="1234 Main St">
  </div>
  <div class="form-group col-md-6">
    <label for="txtAddress2">Address Line 2</label>
    <input type="text" class="form-control customer" id="txtAddress2" name="address2" placeholder="Apartment, studio, or floor">
  </div>
</div>

  <div class="form-row">
     <div class="form-group col-md-3">
      <label for="selCountries">Country</label>
      <select id="selCountries" class="form-control customer" name="countries">
        <option selected val="NULL">Choose...</option>
        <option value="NA">N/A</option>
        <?php echo $countries_select_opt; ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="txtCity">City</label>
      <input type="text" class="form-control customer" id="txtCity" name="city">
    </div>
    <div class="form-group col-md-3">
      <label for="selState">State or Province</label>
      <select id="selState" class="form-control customer" name="state" >
        <option selected val="NULL">Choose...</option>
        <option value="NA">N/A</option>
        <?php echo $sp_select_opt; ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="txtPostalCode">Zip/Postal Code</label>
      <input type="text" class="form-control customer" id="txtPostalCode" name="postal_code"/>
    </div>
  </div>

  <div class="form-row">
     <div class="form-group col-md-3">
      <label for="txtPhone1">Phone 1</label>
      <input type="text" class="form-control customer" id="txtPhone1" name="phone1">
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="txtPhone2">Phone 2</label>
      <input type="text" class="form-control customer" id="txtPhone2" name="phone2">
    </div>
    <div class="form-group col-md-3">
      <label for="txtFax">Fax</label>
      <input type="text" class="form-control customer" id="txtFax" name="fax">
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="txtEmail">Email</label>
      <input type="text" class="form-control customer" id="txtEmail" name ="email">
    </div>
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="chkActive" name="active">
      <label class="form-check-label" for="chkActive">
        Active
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" id="custBtnSubmit">Add Customer</button>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <button type="button" class="btn btn-default" id="custBtnClear">Clear All</button>
  <input type="hidden" value = "0" id="txtID" name="id" />
  <input type="hidden" value = "add" id="txtPostType" name="post_type" />
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