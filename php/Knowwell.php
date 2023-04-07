<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/kw_main.css?v=<?php echo time(); ?>">
    <title>Knowwell</title>
    <header>
    <?php
  session_start();
  include "main.php";

  function getUserImage($connection, $user_id) {
      $sql = "SELECT userimage FROM users WHERE userid=?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row['userimage'];
}
?>
        <div class="topnav">
            <a class="active" href="#home" id="home">Home</a>
            <div class="search-container">
              <form action="search.php" method="GET">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="../images/topsearch.png"></button>
                
              </form>
            </div>
            <?php
    if (isset($_SESSION['user_id'])) {
        $user_image = getUserImage($connection, $_SESSION['user_id']);
        echo '<a href="Account.php" id="account">';
        echo '<img src="data:image/png;base64,' . base64_encode($user_image) . '" class="right user" />';
        echo '</a>';
    } else {
        echo "<a href='login.php' class='right'>Login</a>";
    }
    ?>
              
              <a href="Post.php" class="right">Ask Question</a>
          </div>
    </header>
</head>
<body>
<div class="content">
    <div class='questre'>
        <?php include "main.php" ?>
        <?php
        if($error != null)
        {
            $output = "<p>Unable to connect to database!</p>";
            exit($output);
        }
        else
        {
            $sql = "SELECT * FROM questions;";
            $results = mysqli_query($connection, $sql);
            $sql1="SELECT * FROM users";
            $results1 = mysqli_query($connection, $sql1);
            while ($row = mysqli_fetch_assoc($results))
            {
              echo '<div class="question">';
                echo '<div class="title">';
                echo "<h3><a href='detail.php?id=".$row['questionid']."' class='detail'>".$row['questtitle']."</a></h3>";
                echo "</div>";
                echo '<div class="qcon">';
                while ($row1=mysqli_fetch_assoc($results1)){
                  if($row1['userid']==$row['userid']){
                    echo '<div class="userinfo">';

                    echo '<figure>';
                      echo '<img src="data:image/png;base64,'.base64_encode( $row1['userimage'] ).'" class="user"/>';
                      echo '<figcaption> '.$row1['username'].'</figcaption>';
                    echo '</figure>';
                    echo '</div>';
                    break;
                  }
              }
              mysqli_data_seek($results1, 0); 
                echo '<div class="qcon-text">';
                echo "<p>".$row['questcontent']."</p>";
                echo '</div>';
                if($row['questimage']!=null){
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['questimage'] ).'"/>';
                }
                echo '</div>';
                echo '</div>';
            }
            mysqli_free_result($results);
            mysqli_close($connection);
        }
        ?>
    </div>
    <div class='rightbar'>
      <h4>TOPIC</h4>
    <ul class='rightbarlist'>
        <li>Sport</li>
        <li>Food</li>
        <li>Technology</li>
    </ul>
      </div>
</div>
      </form>
</body>
</html>