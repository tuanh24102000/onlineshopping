<!DOCTYPE html>
<html>
<body>

<h1>Update Product</h1>

<?php
ini_set('display_errors', 1);
echo "Update database!";
?>

<form name="update" action="UpdateData.php" method="POST">
    <label for="id">ID Product:</label><input type="text" name="id" placeholder="input id product"/>
    <label for="newname">New Name:</label><input type="text" name="newname" placeholder="input new product name"/><br>
    <input type="submit" value="Update">
</form>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-50-19-26-235.compute-1.amazonaws.com;port=5432;user=qrzonzcutacifz;password=f32c21bfe7876974b51afbbb0dd08be35e5f85424b98d580871c6a09b2cc567b;dbname=d1vqnh4ipl8vs5",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  


$sql = "UPDATE products SET name = '$_POST[newname]' WHERE products_id = '$_POST[id]'";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body>
</html>
