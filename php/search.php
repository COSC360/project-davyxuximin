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
                <button type="submit"><img src="topsearch.png"></button>
              </form>
            </div>
              <a href="../login.html" class="right">Login</a>
              <a href="#" class="right">Ask Question</a>
          </div>
    </header>
</head>
<body>
    <div id = "main">
    <h1>Search Results</h1>

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
    $sql = "SELECT * FROM questions WHERE questcontent LIKE '%$search%'";
    $result = $connection->query($sql);
    }
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Display the search results (replace 'your_column' with the actual column name)
            echo '<div class="question">';
                echo '<div class="title">';
                echo "<h3>".$row['questtitle']."</h3>";
                echo "</div>";
            echo "<p>".$row['questcontent']."</p>";
            echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['questimage'] ).'"/>';
        }
    } else {
        echo "<p>No results found</p>";
    }

    // Close the database connection
    $connection->close();
    ?>
    </div>
</body>
</html>
