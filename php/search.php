<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/kw_main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/post.css">
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
            <a class="active" href="Knowwell.php" id="home">Home</a>
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
              <a href="#" class="right">Ask Question</a>
          </div>
    </header>
</head>
<body>
    <h4 id="searchre">Search Results</h4>
 <div class="content">
    <div class='questre'>
    <?php
    include "main.php";

    if ($error != null) {
        $output = "<p>Unable to connect to database!</p >";
        exit($output);
    } else {
        // Get the search query from the GET parameters
        $search = isset($_GET['search']) ? $_GET['search'] : '';
    
        // Sanitize the search query to prevent SQL injection
        $search = $connection->real_escape_string($search);
    
    // Perform the search in your database
    $sql = "SELECT * FROM questions WHERE questcontent LIKE '%$search%' OR questtitle LIKE '%$search%'";
    $result = $connection->query($sql);
    $sql1="SELECT * FROM users";
    $results1 = mysqli_query($connection, $sql1);
    }
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="question">';
                echo '<div class="title">';
                echo "<h3>".$row['questtitle']."</h3>";
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
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['questimage'] ).'"/>';
                
                echo '</div>';
                echo '</div>';
        }
    } else {
        echo "<p>No results found</p>";
    }


    ?>
        </div>
        <div class='rightbar'>
    <h4>Recommended Post</h4>
    <ul class='rightbarlist'>
      <?php
      $sql = "SELECT * FROM questions LIMIT 3;";
      $results = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_assoc($results)){
        echo '<div class="rightbartitle">';
        echo "<li><a href='detail.php?id=".$row['questionid']."' class='detail'>".$row['questtitle']."</a></li>";
        echo "</div>";
      }            
      mysqli_close($connection);
      ?>
    </ul>
      </div>

    </ul>
      </div>
    </div>
</body>
</html>