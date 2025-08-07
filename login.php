<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="css/login.css">
  <title>Login & Sign Up</title>
   
</head>
<body>
  <div class="wrapper">
    <a href="index.php" class="close-btn">&times;</a>

    <input type="radio" name="tab" id="login" checked>
    <input type="radio" name="tab" id="signup">
    <div class="form-container">
      <div class="tab-buttons">
        <label for="login" class="tab login-tab">Login</label>
        <label for="signup" class="tab signup-tab">Sign Up</label>
      </div>

      <!-- Login Form -->
      <form class="form login-form" action="login_process.php" method="post">
        <h2>Welcome Back</h2>
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Password" name="pwd" >
        <button type="submit">Login</button>
        <a href="#" class="link">Forgot password?</a>
      </form>

      <!-- Sign Up Form -->
      <form class="form signup-form" action="signup_process.php" method="post">
        <h2>Create your account</h2>
        <input type="text" placeholder="Full Name" name="fnm">
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Password" name="pwd">
        <input type="password" placeholder="re-password" name="rpwd">
        <button type="submit">Sign Up</button>
      </form>
      
    </div>
  </div>
</body>
</html>
