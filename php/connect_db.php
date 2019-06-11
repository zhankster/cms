<?php
require('env.php');
date_default_timezone_set("America/Chicago");

$host = $GLOBALS['host'];
$db   = $GLOBALS['db'];
$user = $GLOBALS['user'];
$pass = $GLOBALS['pass'];
$charset = $GLOBALS['charset'];
$pdo = NULL;


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

function select_table($select_table_sql) {
    global $pdo;
    $id = 0;
    $id_found = false;
    $table = "<table id='example' border='1' class='bwp-table display'>
    <thead><tr class='bwp-row-header'>";

    $rs = $pdo->query($select_table_sql." LIMIT 0");
    for ($i = 0; $i < $rs->columnCount(); $i++) {
        $col = $rs->getColumnMeta($i);
        $columns[] = $col['name'];
        $table .= "<th>".$col['name']."</th>";
    }

    foreach ($columns as $value){
        if ($value === "id"){
            $id_found = true;
        }
    }

    $table .= "</thead>
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
        $table .= "</tr>\n\r";
    }
    $table .= "</tbody></tr></table>";
    return $table;
}

function select_parm($dept){
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE dept =:dept ');
    $stmt->execute(['dept' => $dept]);
    //$user = $stmt->fetch();
    while ($row = $stmt->fetch())
    {
        //echo $row['first_name']. "--" .$row['last_name'] ."\n\r";
        echo $row['first_name']. "--" .$row['last_name'] ."<br />";
    }

}

function select_class($name){
    global $pdo;
    $news = $pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_CLASS, $name);
    print_r($name);
}

function select_array(){
    global $pdo;
    $data = $pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
    //print_r(var_export($data));
    $json = json_encode($data);  //JSON object
    print_r($json);
}

function insert_users(){
    global $pdo;
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

//select_test();
//select_parm('Injection');
// $output = select_table("select * from users");
// echo $output."Test";
//select_class('Users');
//select_array()
//insert_users();

?>