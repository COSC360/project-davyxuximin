<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>KnowWell</title>
    <link rel = "stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
    <script>
        function validateForm(){
            var x=document.forms["loginInfo"]["email"].value;
            var y=document.forms["loginInfo"]["password"].value;
            var at=x.indexOf("@");
            var dot=x.lastIndexOf(".");
            if (at<1 || dot<at+2 || dot+2>=x.length){
                alert("Invalid Email");
                  return false;
            }else if(x==""||y==""){
                alert("Please enter in the blank space");
                return false;
            }
        }
    </script>
</head>

<body>
    <?php session_start(); ?>
    <div class="name">
        <a href="Knowwell.php">
        <h1>Know Well</h1>
    </a>
    </div>


<div class="login">
    <form name="loginInfo" onsubmit="return validateForm();" method="POST" action="logininfo.php">
        <fieldset id="fs">
            <h3>Log in</h2>
        <label>Email:</label>
        <input type="text" name="email" id="email" placeholder="Enter Email"><br><br>

        <label>Password:</label>
        <input type="password" name="password" value=""><br><br>
        
        <input type="submit" value="Log in">
        <p>Don't have an account?<a href="signup.php">Sign up</a></p>
       </fieldset>
    </form>

    <?php if (isset($_SESSION['error_message'])): ?>
    <p class="error-message" color='red'><?php echo $_SESSION['error_message']; ?></p>
    <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
    
</div>

</body>

</html>