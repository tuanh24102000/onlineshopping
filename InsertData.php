<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>Add data in product table</h1>
    <ul>
        <form name="InsertData" action="InsertData.php" method="POST" >
            <li>products_id:</li><li><input type="text" name="products_id" /></li>
            <li>name:</li><li><input type="text" name="name" /></li>
            <li>price:</li><li><input type="text" name="price" /></li>
            <li><input type="submit" value="Add" /></li>
        </form>
    </ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-50-19-26-235.compute-1.amazonaws.com;port=5432;user=
qrzonzcutacifz;password=f32c21bfe7876974b51afbbb0dd08be35e5f85424b98d580871c6a09b2cc567b;dbname=d1vqnh4ipl8vs5",
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}


$sql = "INSERT INTO products(products_id, name, price) VALUES ('$_POST[products_id]','$_POST[name]', '$_POST[price]')";
$stmt = $pdo->prepare($sql);

    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }

?>
</body>
</html>
