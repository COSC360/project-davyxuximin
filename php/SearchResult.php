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
    <h1>Search Results</h1>

    <?php
    include "search.php";
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Display the search results (replace 'your_column' with the actual column name)
            echo "<p>".$row['questcontent']."</p>";
        }
    } else {
        echo "<p>No results found</p>";
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>