<?php
$host = '192.168.50.201';
$db   = 'bwp_co';
$user = 'admin';
$pass = 'zhank2001';
$charset = 'utf8mb4';
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

//#########
$stmt = $pdo->query('SELECT first_name, last_name FROM users');
while ($row = $stmt->fetch())
{
    //echo $row['first_name']. "--" .$row['last_name'] ."\n\r";
    echo $row['first_name']. "--" .$row['last_name'] ."<br />";
}

//#########
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? AND status=?');
$stmt->execute([$email, $status]);
$user = $stmt->fetch();
// or
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND status=:status');
$stmt->execute(['email' => $email, 'status' => $status]);
$user = $stmt->fetch();


//#########
$data = [
    1 => 1000,
    5 =>  300,
    9 =>  200,
];
$stmt = $pdo->prepare('UPDATE users SET bonus = bonus + ? WHERE id = ?');
foreach ($data as $id => $bonus)
{
    $stmt->execute([$bonus, $id]);
}

$sql = "UPDATE users SET name = ? WHERE id = ?";
$pdo->prepare($sql)->execute([$name, $id]);

$stmt = $pdo->prepare("DELETE FROM goods WHERE category = ?");
$stmt->execute([$cat]);
$deleted = $stmt->rowCount();


//########
$stmt = $pdo->query('SELECT name FROM users');
foreach ($stmt as $row)
{
    echo $row['name'] . "\n";
}

//### get single row
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//#### Crete class
$news = $pdo->query('SELECT * FROM news')->fetchAll(PDO::FETCH_CLASS, 'News');

?>