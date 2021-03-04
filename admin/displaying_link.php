<?php
$conn = mysqli_connect("localhost", "root", "", "old_book_sales");
if (!$conn)
    echo "Unable to connect to database";
// Retreiving all the book details
$query_result = mysqli_query($conn, "SELECT * FROM book_link_details");
$books_link_details = mysqli_fetch_all($query_result, MYSQLI_ASSOC);



// Checking if there is any book
if (!empty($books_link_details)) {

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
    <a href='" . $book_link_detail['link_book_link'] . "'>" . 'get downlod link' . "</a></td><td>
    <button data-id=" . $book_link_detail["book_link_id"] . "   class='delete_btn'>Delete</button></td>
    </div>";
    }
} else {
    echo "<h1>No Link to show</h1>";
}
