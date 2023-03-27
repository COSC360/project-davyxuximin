
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
    <div class="name">
        <h1>Know Well</h1>
    </div>


<div class="login">
    <form name="loginInfo" onsubmit="return validateForm();" method="post" action="signupInfo.php" enctype="multipart/form-data">
        <fieldset id="fs">
            <h3>Sign Up</h2>
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Password:</label>
        <input type="password" name="password2" required><br>
        <label>Image:</label>
        <input type="file" name="image" accept="image/*" required><br>
        <label>Address:</label>
        <input type="text" name="address" required></textarea><br>
        <label>Phone Number:</label>
        <input type="tel" name="phone_number" placeholder="123-456-7890" required><br>
        <label>Gender:</label>
        <select name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br>
        <label>School:</label>
        <input type="text" name="school" required><br>
        <button type="submit" name="submit">Register</button>
       </fieldset>
    </form>
    <p id="error-message" style="color: red;"></p>
    <script>
      document.querySelector("form").addEventListener("submit", function(event) {
        const password = document.querySelector("input[name='password']");
        const confirmPassword = document.querySelector("input[name='password2']");
        const errorMessage = document.getElementById("error-message");

        if (password.value !== confirmPassword.value) {
          event.preventDefault(); // Prevent form submission
          password.value = ""; // Clear password field
          confirmPassword.value = ""; // Clear confirm password field
          errorMessage.textContent = "Passwords do not match. Please try again.";
        } else {
          errorMessage.textContent = "";
        }
      });
    </script>

    
</div>











</body>

</html>