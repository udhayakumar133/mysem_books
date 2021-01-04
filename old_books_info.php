<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/old_books_info.css" >
    <title>Document</title>
</head>
<body>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="old_books.php">Old Books</a></li>
            <li><a href="recommends.php">Recommend</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="my_account.php">My Account</a></li>
        </ul>
    
    <div class="infoHeader">
        <h2>Fill the following contents to sale your Old semester books</h2>
    </div>

    <div class="otherBooks-F">
        <form method="POST" action="">
            <div class="content-1">
		<label class="bookDetails">Select Book image:</label>
  		<input type="file" name="uploadfile" >
                <label class="bookDetails">Book Name</label><br><input name="o_bName" type="text" height="2px" placeholder="Enter Book name"><div class="space"></div><br>
                <label class="bookDetails">Author Name</label><br><input name="o_aName" type="text" placeholder="Enter Authour name"><div class="space"></div><br>
                <label class="bookDetails">catagory</label><br>
                <select name="o_catagory">
                    <option value="C-language">C-language</option>
                    <option value="C++-language">C++-language</option>
                    <option value="Java-language">Java-language</option>
                    <option value="R Programming">R Programming </option>
                    <option value="ALP">ALP</option>
                    <option value="Python">Python</option>
                    <option value="Andriod">Andriod</option>
                    <option value="HTML">HTML</option>
                    <option value="CSS">CSS</option>
                    <option value="PHP and MySQL">PHP and MySQL</option>
                    <option value="Visual Basics(VB6)">Visual Basics(VB6)</option>
                    <option value="Oracle">Oracle</option>
                    <option value="Data Structures">Data Structures</option>
                    <option value="Digital Principles">Digital Principles</option>
                    <option value="Discrete Mathematics">Discrete Mathematics</option>
                    <option value="Operation Research">Operation Research</option>
                    <option value="OS and UNIX">OS and UNIX</option>
                    <option value="Cloud Computing">Cloud Computing</option>
                    <option value="AI and ML">AI and ML</option>
                    <option value="Data Networks">Data Communications and Networks</option>
                    <option value="Software Engineering">Software Engineering</option>
                    <option value="Computer Graphics">Computer Graphics</option>
                    <option value="DOT Net">DOT Net</option>
                    <option value="OTHERS">OTHERS</option>
                </select><div class="space"></div><br>
                <label class="bookDetails">Discription</label><br><!--<textarea name="" name="" cols="62" rows="5" placeholder="type your discription here "></textarea>-->
                <input name="o_disc" type="text" placeholder="Enter your discription "><div class="space"></div><br>
                <label class="bookDetails">Price Amount</label><br>
                <input name="o_rate" type="number" placeholder="Rupees">
            	</div>
	<div class="c-btn-1">
            <button>Button</button>
	</div>
        </form>
    </div>


</body>
</html>