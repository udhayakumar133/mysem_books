<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
     
    /* .book-container {
         position: relative;
         justify-content: center;
         display: flex;
         justify-content: space-between;
         align-items: center;
         flex-wrap: wrap;
         font-size:18px;
         margin: 0px 1%;
         
     }
     
     .book-container .book {
         position: relative;
         width: 46%;
         border:1px solid black;
         border-radius:10px;
         background: white;
         margin: 10px;
         padding: 15px;
         display: flex;
     }

     .book-container .book .imgBox {
         max-width: 150px;
         flex: 0 0 150px ;

     }

     .book-container .book .imgBox img {
         max-width: 100%;
     }

     .book-container .book .content {
         margin-left: 20px;
         color: black;
         font-weight:bold;


     }

     .book-container .book .content label {
         font-weight: bold;
         color: green;
         font-family:cursive;
     }
     button.btn-a {
 justify-content: center;
 float: right;
 margin-left: 0;
 padding: 5%;
 margin: 2%;
 margin-top: 12%;
 background: lightgreen;
 border: 0;
 font-weight: bold;
 font-family: arial;
 cursor: pointer;
}

button.btn-a:hover {
 background:red;
} */

    </style>
</head>
<body>
<?php include "a_header.php" ?>

<?php


$conn=mysqli_connect("localhost","root","","old_book_sales");
if(!$conn)
echo "Unable to connect to database";
// Retreiving all the book details
$query_result = mysqli_query($conn, "SELECT * FROM book_link_details");
$books_link_details = mysqli_fetch_all($query_result, MYSQLI_ASSOC);



// Checking if there is any book
if (!empty($books_link_details)) {

    // Books container
    echo "<div class='book-container'>";

    // Looping through book details
 echo "<div class='book'><table style='width:100%;  position: absolute; top: 20%; color:balck; background:white;';><tr><th><label>provider email</label></th><th>
        <label>Book Name </label></th><th><label>Book Author </label></th><th><label>Description </label></th><th><label>catagory </label></th><th><label>downlod link</label></th><th><label>DELETE</label></th></tr>";
    foreach ($books_link_details as $book_link_detail) {
       echo "<tr><td>" 
	. $book_link_detail['u_email'] . "</td><td>
        " . $book_link_detail['link_book_name'] . "</td><td>
        " . $book_link_detail['link_book_author'] . "</td><td>
        " . $book_link_detail['link_book_description'] . "</td><td>
        " . $book_link_detail['link_book_catagory'] . "</td><td>
        <a href='" . $book_link_detail['link_book_link'] . "'>" . 'get downlod link' ."</a></td><td>
        <a href='#'>Delete</a></td>
        </div>";
    }

    // Closing book container
    echo "</div></table>";
} else {
    echo "<h1>No Link to show</h1>";
}
?>
</body>
</html>
</body>
</html>