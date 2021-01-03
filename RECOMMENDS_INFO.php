<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/RECOMMENDS_INFO.css" >
    <title>Document</title>
</head>
<body>
        <ul>
            <li><a href="HOME.php">Home</a></li>
            <li><a href="OLD BOOKS.php">Books</a></li>
            <li><a href="RECOMMENDS.php">Recommend</a></li>
            <li><a href="LOGIN.php">Login</a></li>
            <li><a href="MY ACCOUNT.php">My Account</a></li>
        </ul>
    
    <div class="infoHeader">
        <h2>Fill the following contents to post your links of books</h2>
    </div>

    <div class="otherBooks-F">
        <form method="POST" action="">
            <div class="content-1">
                <label class="bookDetails">Book Name</label><br><input name="l_bName" type="text" height="2px" placeholder="Enter Book name"><div class="space"></div><br>
                <label class="bookDetails">Author Name</label><br><input name="l_aName" type="text" placeholder="Enter Authour name"><div class="space"></div><br>
                <label class="bookDetails">catagory</label><br>
                <select name="l_catagory">
                    <option value="">C -language</option>
                    <option value="">C++ -language</option>
                    <option value="">Java -language</option>
                    <option value="">R Programming  </option>
                    <option value="">ALP</option>
                    <option value="">Python</option>
                    <option value="">Andriod</option>
                    <option value="">HTML</option>
                    <option value="">CSS</option>
                    <option value="">PHP and MySQL</option>
                    <option value="">Visual Basics(VB6)</option>
                    <option value="">Oracle</option>
                    <option value="">Data Structures</option>
                    <option value="">Digital Principles</option>
                    <option value="">Discrete Mathematics</option>
                    <option value="">Operation Research</option>
                    <option value="">OS and UNIX</option>
                    <option value="">Cloud Computing</option>
                    <option value="">AI and ML</option>
                    <option value="">Data Communications and Networks</option>
                    <option value="">Software Engineering</option>
                    <option value="">Computer Graphics</option>
                    <option value="">DOT Net</option>
                    <option value="">OTHERS</option>

                </select><div class="space"></div><br>
                <label class="bookDetails">gmail</label><br><input name="l_gmail" type="text" placeholder="Enter your Gmail address"><div class="space"></div><br>
                <label class="bookDetails">Your Name</label><br><input name="l_yName" type="text" placeholder="Enter Your name"><div class="space"></div><br>
                <label class="bookDetails">Discription</label><br><!--<textarea name="" name="" cols="62" rows="5" placeholder="type your discription here "></textarea>-->
                <input name="l_disc" type="text" placeholder="Enter your discription "><div class="space"></div><br>
                <label class="bookDetails">Enter your Pdf/document Link Here</label><br>
                <input name="l_link" type="text" placeholder="Eg. Http://google.com">
            </div>
	
	    <div class="c-btn-1">
         
            <button>Button</button>
        </div>
        </form>
    </div>


</body>
</html>