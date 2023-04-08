<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detail.css?v=<?php echo time(); ?>">
    <title>Knowwell</title>
    <header>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
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
            <a href="Knowwell.php" id="home">Home</a>
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
      echo "<script>
      alert('Please login first');
      window.location.href = 'login.php';
    </script>";
exit();
    }
    ?>
              
              <a href="Post.php" class="right">Ask Question</a>
          </div>
    </header>
</head>
<body>
<div class="content">
    <div class='questre'>
        <?php

        //question
        $questionId = $_GET['id'];
        $sql = "SELECT * FROM questions WHERE questionid=?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $questionId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);



        while($row = mysqli_fetch_assoc($result)){
            echo '<div class="question">';
                echo '<div class="title">';
                echo "<h3>".$row['questtitle']."</h3>";
                echo "</div>";
                echo '<div class="qcon">';
                
                //user
                $sql1 = "SELECT * FROM users WHERE userid=?";
                $stmt1 = mysqli_prepare($connection, $sql1);
                mysqli_stmt_bind_param($stmt1, "i", $row['userid']);
                mysqli_stmt_execute($stmt1);
                $result1 = mysqli_stmt_get_result($stmt1);

                while ($row1=mysqli_fetch_assoc($result1)){
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
              mysqli_data_seek($result1, 0); 
                echo '<div class="qcon-text">';
                echo "<p>".$row['questcontent']."</p>";
                echo '</div>';
                if($row['questimage']!=null){
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['questimage'] ).'"/>';
                }
                echo '</div>';
                echo '</div>';

        }
        $sql2 = "SELECT * FROM comments WHERE questionid = ?";
        $stmt2 = mysqli_prepare($connection, $sql2);
        mysqli_stmt_bind_param($stmt2, "i", $questionId);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
                
        echo "<div class='comment-form'>";
        echo "<h2>Submit your comment</h2>";
        echo "<form action='comment.php' method='POST'>";
        echo "<input type='hidden' name='questionid' value='{$questionId}'>";
        echo "<input type='hidden' name='userid' value='{$_SESSION['user_id']}'>";
        echo "<div>";
        echo "<label for='commentcontent'>Comment:</label>";
        echo "<textarea name='commentcontent' id='commentcontent' rows='4' cols='50' required></textarea>";
        echo "</div>";
        echo "<button type='submit'>Submit Comment</button>";
        echo "</form>";
        echo "</div>";

        while ($row2 = mysqli_fetch_assoc($result2)) {
          $commentContent = $row2['commentcontent'];
          $commentDate = $row2['commentdate'];
          $userId = $row2['userid'];
      
          // Get user information
          $sql3 = "SELECT * FROM users WHERE userid = ?";
          $stmt3 = mysqli_prepare($connection, $sql3);
          mysqli_stmt_bind_param($stmt3, "i", $userId);
          mysqli_stmt_execute($stmt3);
          $result3 = mysqli_stmt_get_result($stmt3);
          $row3 = mysqli_fetch_assoc($result3);
      
          $username = $row3['username'];
          $userImage = $row3['userimage'];
      
          // Display comment, date, and user information
          echo '<div class="comment">';
          echo '<div class="comment-user">';
          echo '<img src="data:image/png;base64,' . base64_encode($userImage) . '" class="user" />';
          echo '<span class="username">' . $username . '</span>';
          echo '</div>';
          echo '<div class="comment-content">';
          echo '<p>' . $commentContent . '</p>';
          echo '<span class="comment-date">' . $commentDate . '</span>';
          echo '</div>';
          if($_SESSION['admin']==true||$_SESSION['user_id']==$userId){
            $commentid=$row2['commentid'];
                  echo '<form action="deletecom.php" method="POST">';
                  echo '<input type="hidden" name="commentid" value="'.$commentid.'">';
                  echo '<button type="submit">DELETE</button>';
                  echo '</form>';
          }
         
          echo '</div>';
      }
      echo '</div>';
        ?>
        <div class='rightbar'>
    <h4>Recommended Post</h4>
    <ul class='rightbarlist'>
      
      <?php
      
      $sql = "SELECT * FROM questions LIMIT 3;";
      $results = mysqli_query($connection, $sql);
      while (($row = mysqli_fetch_assoc($results))) {
          echo "<li><a href='detail.php?id=".$row['questionid']."' class='detail'>".$row['questtitle']."</a></li>";
      }
      
      mysqli_close($connection);
      ?>
    </ul>
      </div>
      </div>
    </div>
    </div>
</body>
</html>