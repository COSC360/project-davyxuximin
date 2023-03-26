<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Account.css">
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
    <div id="main">
    <h2>Account Info</h2>
    <?php
    include "main.php";

    if ($error != null) {
        $output = "<p>Unable to connect to database!</p >";
        exit($output);
    } else {
        if (isset($_SESSION['user_id'])) {
            $userid = $_SESSION['user_id'];
            $sql = "SELECT * FROM users WHERE userid='$userid';";
            $result = $connection->query($sql);
            $sql1 = "SELECT * FROM questions WHERE userid='$userid';";
            $results1 = mysqli_query($connection, $sql1);
            while ($row = $result->fetch_assoc()){
                echo '<div class="leftAcc"><figure>';
                echo '<img src="data:image/png;base64,'.base64_encode( $row['userimage'] ).'" class="user"/>';
                echo '<figcaption><h3>'.$row['username'].'</h3></figcaption>';
                echo '</figure>';
                echo '<h3>Email: </h3>';
                echo '<p>'.$row['email'].'</p>';
                echo '</div>';
                echo '<div class="rightAcc">';
                echo '<h3>Address: </h3>';
                echo '<p>'.$row['address'].'</p><br>';
                echo '<h3>Phone Number: </h3>';
                echo '<p>'.$row['phone'].'</p><br>';
                echo '<h3>Gender: </h3>';
                echo '<p>'.$row['sex'].'</p><br>';
                echo '<h3>School: </h3>';
                echo '<p>'.$row['school'].'</p><br>';
                echo '</div>';
                echo '<div class="posts">';
                echo '<h3>Posts: </h3>';
                while ($row1=mysqli_fetch_assoc($results1)){
                    if($row['userid'] == $row1['userid']){
                        
                        
                        echo '<div class="posted">';
                        echo '<div class="title">';
                        echo "<h3>".$row1['questtitle']."</h3>";
                        echo "</div>";
                        echo '<div class="qcon-text">';
                        echo "<p>".$row1['questcontent']."</p>";
                        echo '</div>';
                        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row1['questimage'] ).'"/>';
                        echo '</div>';
                        
                        
                        
            }
                
                }
                
                echo '</div>';
            }
        }
    }

    // Close the database connection
    $connection->close();
    ?>
    </div>
</body>
</html>
