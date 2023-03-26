

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/kw_main.css">
    <link rel="stylesheet" href="../css/post.css">
    <title>Knowwell</title>
    <header>
        <div class="topnav">
            <a class="active" href="#home" id="home">Home</a>
            <div class="search-container">
                <form action="search.php" method="GET">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="../images/topsearch.png"></button>
              </form>
            </div>
            <?php session_start()?>
              <a href="login.php" class="right">Login</a>
              <a href="#" class="right">Ask Question</a>
          </div>
    </header>
</head>
<body>
    <form action="image.php" method="post" enctype="multipart/form-data">
        <div id="main">
            <div id="EnterText">
                <input type="text" id="text" placeholder="Enter Text Here" name="text" >
            </div>

            <div id="choose">
                <input type="file" name="image" id="image">
                
            </div>

            <div id="button">
                <button type="submit" value="Upload Image" name="submit" id="post">Post</button>
            </div>

        </div>
    </form>

</body>
</html>

