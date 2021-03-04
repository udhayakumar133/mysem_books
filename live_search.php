<?php
session_start();
include "config.php";
$user_email = $_SESSION["email"];

$search_txt = $_POST["search_txt"];
$table_name = $_POST["table_name"];
$column_name = $_POST["column_name"];

$sql = "SELECT * FROM {$table_name} WHERE {$column_name} LIKE '{$search_txt}%' AND u_email!='$user_email'";
$books_details = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);


if ($table_name == "book_details") {

    if (count($books_details) > 0) {
        // Displaying each book details
        foreach ($books_details as $books_detail) {
            $image_name = explode("/", $books_detail['book_image']);
            $image_name = $image_name[count($image_name) - 1];
            echo "<div class='book'>
        <div class='imgBox'>
            <img src='book_images/" . $image_name . "' alt='book image'>
        </div>
        <div class='content'>
            <label>Book Name :</label> " . $books_detail['book_name'] . "<br>
            <label>Book Author :</label> " . $books_detail['book_author'] . "<br>
            <label>Description :</label>" . $books_detail['book_description'] . "<br>
            <label>catagory :</label>" . $books_detail['catagory'] . "<br>
            <label>Price :</label>" . $books_detail['price'] . "<br>
            <button class='btn-a'>Book now</button>
        </div> </div>";
        }
    } else
        echo "<h1>No results Found</h1>";
} else {
    // Checking if there is any book
    if (!empty($books_details)) {

        // Books container
        echo "<div id='book-container'>";

        // Looping through book details
        foreach ($books_details as $book_detail) {
            echo "<div class='book'>
            
            <label>Book Name :</label>" . $book_detail['link_book_name'] . "<br>
            <label>Book Author :</label>" . $book_detail['link_book_author'] . "<br>
            <label>Description :</label>" . $book_detail['link_book_description'] . "<br>
            <label>catagory :</label>" . $book_detail['link_book_catagory'] . "<br>
            <button class='btn-a'><a href='" . $book_detail['link_book_link'] . "'>" . 'get downlod link' . "</a></button>
            </div>";
        }

        // Closing book container
        echo "</div>";
    } else {
        echo "<h1>No Link to show</h1>";
    }
}
