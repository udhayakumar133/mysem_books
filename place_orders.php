<?php
include "config.php";

session_start();
$email = $_SESSION["email"];

$sql = "INSERT INTO order_table(owner_email,book_id,customer_email) VALUES('{$_POST['owner_email']}',{$_POST['book_id']},'$email')";

if (mysqli_query($conn, $sql))
    echo "1";
else
    echo "0";
