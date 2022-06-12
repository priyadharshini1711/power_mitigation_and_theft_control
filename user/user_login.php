<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>User Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="user_login.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <div class="container mt-5">
 
    
    <!-- Contact form -->
    <form action="" name="contactForm" method="post" enctype="multipart/form-data">
    <?php include('../scripts/captcha_form.php'); ?>
    <!-- Captcha error message -->
    <?php if(!empty($captchaError)) {?>
      <div class="form-group col-12 text-center">
        <div class="alert text-center <?php echo $captchaError['status']; ?>">
          <?php echo $captchaError['message']; ?>
        </div>
      </div>
    <?php }?>
    <div class="form-container">
    <div class="form-head">Login</div>
      <div class="form-group">
        <label>Consumer No</label>
        <input type="text" class="form-control" name="consumer_no" id="consumer_no">
      </div>
      <div class="Phone No">
        <label>Phone No (Optional)</label>
        <input type="email" class="form-control" name="phone_no" id="phone_no">
      </div>
      <div class="row">
        <div class="form-group col-6">
          <label>Enter Captcha</label>
          <input type="text" class="form-control" name="captcha" id="captcha">
        </div>
        <div class="form-group col-6">
          <label>Captcha Code</label>
          <img src="../scripts/captcha.php" alt="PHP Captcha">
        </div>
      </div>
      <input type="submit" name="Submit" value="Submit" class="btn btn-dark btn-block">
      <input type="button" name="Back" value="Back" class="btn btn-dark btn-block" onclick='location.href="../index.html"'>
      <input type="button" name="Register" value="Register" class="btn btn-dark btn-block" onclick='location.href="user_registration.php"'>
    </div>
    </form>
  </div>
</body>
</html>