<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kw_main.css">
    <link rel="stylesheet" href="post.css">
    <title>Knowwell</title>
    <header>
        <div class="topnav">
            <a class="active" href="#home" id="home">Home</a>
            <div class="search-container">
              <form action="http://www.randyconnolly.com/tests/process.php">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="topsearch.png"></button>
              </form>
            </div>
              <a href="../login.html" class="right">Login</a>
              <a href="#" class="right">Ask Question</a>
          </div>
    </header>
</head>
<body>
    <form action="image.php" method="post">
        <div id="main">
            <div id="EnterText">
                <input type="text" id="text" placeholder="Enter Text Here" name="text" >
            </div>

            <div id="choose">
                <input type="file" id="upload" multiple = "multiple" accept="image/png, image/jpg">
                <?php

                include 'main.php';

                $query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");
                if($error != null)
                {
                    $output = "<p>Unable to connect to database!</p >";
                    exit($output);
                }else{
                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        $imageURL = 'uploads/'.$row["file_name"];
                        ?>
                        <img src="<?php echo $imageURL; ?>" alt="" />
                        <?php }
                    }else{ ?>
                    <p>No image(s) found...</p>
                    <?php } 
                }?>
            </div>

            <div id="AddTag">
                <img src = "pound.png" id="pound">
                <input type="text" id="tag" placeholder="Enter Tag Here" name="text" >
            </div>

            <div id="button">
                <button type="submit" id="post">Post</button>
            </div>

        </div>
    </form>

<script src="post_chooseimage.js"></script>
</body>
</html>