<?php
$username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

$username = isset($_POST['username']) ? $_POST['username'] : $username;
$password = isset($_POST['password']) ? $_POST['password'] : NULL;
$errorMessage = array();
        $successMessage = "";

        if (empty($username) || empty($password))
        {
            array_push($errorMessage, "Empty values not allowed");
        }

if($username == 'admin' && $password == 'admin'){
    $successMessage = "Logged In Successfully";
    header("Location: http://localhost/power_mitigation_and_theft_control/admin/about.php?");

} else {
    if(!empty($username) && !empty($password) )
    array_push($errorMessage, "Invalid Username or Password");

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="admin_login.css" rel="stylesheet" type="text/css" />
</head>
<body>

<form name="frmRegistration" method="post" action="">
    
        <div class="demo-table">
        <?php
if (empty($errorMessage) && !empty($successMessage))
{
?>	
            <div class="success-message">
            <?php
    echo $successMessage . "<br/>";
?>
            </div>
<?php
}
?>

<?php
if (!empty($errorMessage) && is_array($errorMessage))
{
?>	
            <div class="error-message">
            <?php
    foreach ($errorMessage as $message)
    {
        echo $message . "<br/>";
    }
?>
            </div>
<?php
}
?>
        <div class="form-head">Login</div>
        <div class="field-column">
                <label>User name</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="username"
                        value="">
                </div>
            </div>
            
            <div class="field-column">
                <label>Password</label>
                <div><input type="password" class="demo-input-box"
                    name="password" value=""></div>
            </div>
            <div class="field-column">
                <div>
                    <input type="submit"
                        name="register-user" value="Login"
                        class="btnRegister">
                </div>
            </div>
        </div>
</form>
</body>
</html>