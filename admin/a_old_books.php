<!DOCTYPE html>
<html lang="en">
<?php

// including files
include "config.php";

// Starting the session
session_start();

// user email
$user_email = $_SESSION['email'];
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include"a_header.php" ?>
    
    <?php

// Retreiving all the book details
$query_result = mysqli_query($conn, "SELECT * FROM book_details WHERE u_email!='$user_email'");
$books_details = mysqli_fetch_all($query_result, MYSQLI_ASSOC);

// Checking if there is any book
if (!empty($books_details)) {

    // Books container
    echo "<div class='book-container'>";
    
    
   

    // Looping through book details
    echo "<div class='book'><table style='width:100%; position: absolute; top: 20%; color:balck; background:white;';><tr><th><label>provider email</label></th><th> <label>Book Image</label></th><th>
        <label>Book Name </label></th><th><label>Book Author </label></th><th><label>Description </label></th><th><label>catagory </label></th><th><label>price</label></th><th><label>DELETE</label></th></tr>";
        
    foreach ($books_details as $books_detail) {
        $image_name = explode("/", $books_detail['book_image']);
        $image_name = $image_name[count($image_name) - 1];
        echo "<div class='book'>
        
        <div class='content'><tr><td>
        " . $books_detail['u_email'] . "</td><td>
           " . $books_detail['book_image'] . "</td><td>
           " . $books_detail['book_name'] . "</td><td>
           " . $books_detail['book_author'] . "</td><td>
           " . $books_detail['book_description'] . "</td><td>
           " . $books_detail['catagory'] . "</td><td>
           " . $books_detail['price'] . "</td><td>
            <a href='#'>Delete</a></td>
        </div>";
    }

    // Closing book container
    echo "</div></table>";
} else {
    echo "<h1>No books to show</h1>";
}
?>
</body>
</html>