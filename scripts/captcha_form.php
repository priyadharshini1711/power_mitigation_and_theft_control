<?php
    session_start();

    $servername = "localhost";
$username = "root";
$password = "";
$db = "power_consumption";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}
else
{
    if(!empty($_POST["consumer_no"])) {
      $consumer_no = $_POST["consumer_no"];
      $phone_no = $_POST["phone_no"];
      $captcha = $_POST["captcha"];
      $captchaUser = filter_var($_POST["captcha"], FILTER_SANITIZE_STRING);
        if (empty($consumer_no))
        {
          $captchaError = array(
            "status" => "alert-success",
            "message" => "Empty values not allowed."
          );
        }

        $sql = "select consumer_no from user_registration";
        $result = mysqli_query($conn, $sql);
        $flag = 0;

        if (mysqli_num_rows($result) > 0)
        {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result))
            {
                if (strcmp($row['consumer_no'], $consumer_no) == 0)
                {
                    $flag = 1;
                    break;
                }
            }
        }

        if($flag == 0){
          $captchaError = array(
            "status" => "alert-danger",
            "message" => "User does not exists."
          );
        }

      if(empty($captcha)) {
        $captchaError = array(
          "status" => "alert-danger",
          "message" => "Please enter the captcha."
        );
      }
      else if($_SESSION['CAPTCHA_CODE'] != $captchaUser){

        $captchaError = array(
          "status" => "alert-danger",
          "message" => "Captcha is invalid."
        );
        
      }
      else{
        if(empty($captchaError)){
          $captchaError = array(
            "status" => "alert-success",
            "message" => "Your form has been submitted successfuly."
          );
          // echo "sample $captchaError";
          header("Location: http://localhost/power_mitigation_and_theft_control/user/user.php?consumer_no=$consumer_no");
      }
    }      
    }  
}
?>