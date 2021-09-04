<!DOCTYPE html>
<html>
<head>
    <title>SignUp and Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
.error {color: #FF0000;}
</style>

<body>



<div class="container" id="container">

<div class="form-container sign-up-container">
<form action="signup_user.php" method="post">
    <h1>Create Account</h1> 
    <input type="text" name="name" placeholder="Name" required pattern="[a-zA-Z\s]+" title="Only letters and white space allowed!">
   
    <input type="email" name="email" placeholder="Email" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="eg., someone@gmail.com">
    
    <input type="password" name="password" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
    
<select name="role" required>
   <h4>Select role</h4>
<option value="" disabled="disabled" selected>Select role</option>
  <option value="admin">admin</option>
  <option value="user">User</option>
</select><br>
        
    <button type="submit" name="sign_up" >SignUp</button>
</form>
</div>  





<div class="form-container sign-in-container">
    <form method="post" action="signin_user.php">
        <h1>Sign In</h1>
    
    <input type="email" name="email" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="eg., someone@gmail.com">
    
    <input type="password" name="password" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Sorry, your password was incorrect. Please double-check your password.">
    
    <button  type="submit" name="sign_in" >Sign In</button>
    
    </form>
</div>




<div class="overlay-container">
    <div class="overlay">
        <div class="overlay-panel overlay-left">
            <h1>Welcome Back!</h1>
            <p>To keep connected with us please login with your personal info</p>
            <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
            <h1>Hello, Friend!</h1>
            <p>Enter your details and start journey with us</p>
            <button class="ghost" id="signUp">Sign Up</button>
        </div>
    </div>
</div>
</div>



<script type="text/javascript">
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });
    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
</body>
</html>