<?php
require('env.php');
date_default_timezone_set("America/Chicago");

$host = $GLOBALS['host'];
$db   = $GLOBALS['db'];
$user = $GLOBALS['user'];
$pass = $GLOBALS['pass'];
$charset = $GLOBALS['charset'];
$pdo = NULL;


function createConn(){
    global $host, $db, $user, $pass, $charset;
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    return $pdo;
}

    $GLOBALS['pdo'] = createConn();


    if (isset($_POST["selectQuery"])) {
        $selectQuery = $_POST["selectQuery"];
        select_json($selectQuery);
    }


function select_table($select_table_sql, $table_id) {
    $pdo = $GLOBALS['pdo'];
    $id = 0;
    $id_found = false;
    $table = "<table id='$table_id' class='bwp-table display compact cell-border'>
    <thead><tr class='bwp-row-header'>";
    try{
    $rs = $pdo->query($select_table_sql." LIMIT 0");
    for ($i = 0; $i < $rs->columnCount(); $i++) {
        $col = $rs->getColumnMeta($i);
        $columns[] = ucwords($col['name']);
        $val_replace = str_replace( '_', ' ', $col['name']);
        $table .= "<th>". ucwords($val_replace) ."</th>";
    }

    foreach ($columns as $value){
        if ($value === "id"){
            $id_found = true;
        }
    }

    $table .= "</tr></thead>\n
    <tbody class='bwp-tbody'>";

    $stmt = $pdo->query($select_table_sql);
    while ($row = $stmt->fetch())
    {
        if($id_found) {
            $id = $row['id'];
        }
        $table .= "<tr class='bwp-row-body' id='".$id."'>";
        foreach ($row as $value){
            $table .= "<td>$value</td>";
        }
        $table .= "</tr>\n";
    }
    $table .= "</tbody></table>";
    }catch (PDOException $e) {
        $table = 'Error in query: ' . $e->getMessage();
    }
    unset($pdo); unset($stmt);
    return $table;
}


function select_json($select_json){
    $pdo = $GLOBALS['pdo'];
    $encodable = array();
    $stmt = $pdo->prepare($select_json);
    $stmt->execute();
    while ($obj = $stmt->fetchObject()) {
        //print_r($obj);
        $encodable[] = $obj;
    }
    $encoded = json_encode($encodable);

    echo $encoded;
    unset($pdo); unset($stmt);
}

function get_tables($element, $option_val ){
    $pdo = $GLOBALS['pdo'];
    $sql = "SHOW TABLES";
    $db_tables = "";
    
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $tables = $statement->fetchAll(PDO::FETCH_NUM);   

    foreach($tables as $table){
        $val = $option_val ? 'value ="'.$table[0].'"': '';

        $db_tables .= "<$element $val >{$table[0]}</$element>\r";
    }
    return $db_tables;

}


function select_parm($dept){
    $pdo = $GLOBALS['pdo'];
    $stmt = $pdo->prepare('SELECT * FROM users WHERE dept =:dept ');
    $stmt->execute(['dept' => $dept]);
    $tables = "";
    //$user = $stmt->fetch();
    while ($row = $stmt->fetch())
    {
        //echo $row['first_name']. "--" .$row['last_name'] ."\n\r";
        echo $row['first_name']. "--" .$row['last_name'] ."<br />";
    }

}

function select_class($name){
    $pdo = $GLOBALS['pdo'];
    $news = $pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_CLASS, $name);
    print_r($name);
}

function select_array(){
    $pdo = $GLOBALS['pdo'];
    $data = $pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
    //print_r(var_export($data));
    $json = json_encode($data);  //JSON object
    print_r($json);
}

function insert_users(){
    $pdo = $GLOBALS['pdo'];
    $data = array(1019, 'Fred', 'Neil', 'HR', 'Manager', 0);
    $sql = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `dept`, `position`, `manager`, `start_date`)
     VALUES (?, ?, ?, ?, ?, ?, Now())";
    try {
        $pdo->prepare($sql)->execute($data);
    } catch (PDOException $e) {
        $existingkey = "Integrity constraint violation: 1062 Duplicate entry";
        if (strpos($e->getMessage(), $existingkey) !== FALSE) {
            echo $existingkey;
            // Take some action if there is a key constraint violation, i.e. duplicate name
        } else {
            echo $e;
            throw $e;
        }
    }
    finally{
        echo "Row Added";
    }
}

function update_query($sql){
  try{
	$con = $GLOBALS['pdo'];
	$encodable = array();
   }
  catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }
  	$res = $con->prepare($sql);
    $res->execute();
    $num_r = $res->rowCount();
  	if ($num_r < 1) {
        echo "No Rows updated";
  	}
  	else {
    	print("Success");
  	}

    unset( $res);
    unset( $con);
}

//select_test();
//select_parm('Injection');
// $output = select_table("select * from users");
// echo $output."Test";
//select_class('Users');
//select_array()
//insert_users();
//get_tables('option', true);
//select_json('select * from users');
//update_query("update customers set phone2='555-555-5555'");

?>