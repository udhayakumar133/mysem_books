<?php

include "config.php";
$id = $_POST["id"];
$table_name = $_POST["table_name"];
$column_name = $_POST["column_name"];

$sql = "DELETE FROM {$table_name} WHERE {$column_name}=$id";
$query_result = mysqli_query($conn, $sql);
if ($query_result)
    echo 1;
else
    echo 0;
