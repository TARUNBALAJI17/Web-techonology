<html>
    <head>
        <Title>Login Form</Title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap');
*
{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Oswald', sans-serif;
}
body
{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #060c21;
}
.form
{
    position: relative;
    background: #060c21;
    border: 1px solid #000;
    width: 350px;
    padding: 40px 40px 60px;
    border-radius: 10px;
    text-align: center;
}
.form::before
{
    content: '';
    position: absolute;
    top: -2px;
    right: -2px;
    bottom: -2px;
    left: -2px;
    background: linear-gradient(315deg,#e91e63,#5d02ff);
    z-index: -1;
    transform: skew(2deg,1deg);
    border-radius: 10px;
}
.form h2
{
    color: #fff;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 5px;
}
.form .input
{
    margin-top: 40px;
    text-align: left;
}
.form .input .inputBox
{
    margin-top: 10px;
}
.form .input .inputBox label
{
    display: block;
    color: #fff;
    margin-bottom: 5px;
    font-size: 18px;
    letter-spacing: 1px;
}
.form .input .inputBox input
{
    position: relative;
    width: 100%;
    height: 40px;
    border: none;
    outline: none;
    padding: 5px 15px;
    background:linear-gradient(315deg,#e91e63,#5d02ff) ;
    color: #fff;
    font-size: 18px;
    border-radius: 10px;
}
.form .input .inputBox input[type="submit"]
{
    cursor: pointer;
    margin-top: 20px;
    letter-spacing: 1px;
}
.form .input .inputBox input[type="submit"]:hover
{
    background:linear-gradient(315deg,#5d02ff,#e91e63) ;
}
.form .input .inputBox input[type="submit"]:active
{
    color: rgba(255, 255, 255, 0.521);
    background:linear-gradient(315deg,#e91e6271,#5f02ff8c) ;
}
.forgot
{
    margin-top: 10px;
    color: #fff;
    font-size: 14px;
    letter-spacing: 1px;
}
.forgot a
{
    color: #ff0800;
}
.social
{
    margin-top: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.social button
{
    width: 75%;
    border-radius: 20px;
    margin-bottom: 15px;
    padding: 5px 10px;
    background: transparent;
    border: 3px solid #222;
    outline: none;
    cursor: pointer;
    display: flex;
    align-items: center;

}
.social button i
{
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    width: 20px;
    height: 20px;
    border-radius: 50%;

}
.social button p
{
    color: #fff;
    font-size: 15px;
    margin-left: 10px;
    letter-spacing: 1px;
}
.social button:hover
{
    background: linear-gradient(315deg,#326cd6,#5d02ff);
}
.social button:hover i
{
    filter: invert(1);
}
.social button:active
{
    background:linear-gradient(315deg,#5d02ff,#e91e63)
}


        </style>
    </head>
    <body>

    <?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: index.php");
        } else {
            echo "<div class='form'>
                  <h3 style='color:white'>Incorrect Username/password.</h3><br/>
                  <p style='color:white' class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>



        <form class="form" method="post" name="login">
        <h2>TARUN HOLIDAYS</h2><br>
            <h2>Login</h2>
            <div class="input">
                <div class="inputBox">
                    <label for="">Username</label>
                    <input name="username" type="text" autofocus="true"/>
                </div>
                <div class="inputBox">
                    <label for="">Password</label>
                    <input type="password" name="password">
                </div>
                <div class="inputBox">
                    <input onclick="console.write('Successfully logged in!')" type="submit" value="Login" name="submit"> 
                </div>
            </div>
            <p class="forgot">No Account?? <a href="registration.php">Click Here</a></p>
            <div class="social">
                <button onclick="alert('Currently unavailable!')"><i class="fa fa-facebook" aria-hidden="true"></i><p>Signin with Facebook</p></button>
                <button onclick="alert('Currently unavailable!')"<i class="fa fa-twitter" aria-hidden="true"></i><p>Signin with Twitter</p></button>
            </div>
        </form>

        <?php
    }
?>
        
</body>
</html>