<!Doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Recaptcha</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
	<?php
	if(isset($_POST['name'])){$name = $_POST['name'];}else{$name='';}
	if(isset($_POST['mobilenumber'])){$mobilenumber = $_POST['mobilenumber'];}else{$mobilenumber='';}
	if(isset($_POST['email'])){$email = $_POST['email'];}else{$email='';}
	if(isset($_POST['password'])){$password = $_POST['password'];}else{$password='';}
	if(isset($_POST['confirm_password'])){$confirm_password = $_POST['confirm_password'];}else{$confirm_password='';}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '____________YOUR SECRET KEY_____________',//https://www.google.com/recaptcha/intro/v3.html
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        $error = 'Please check the security CAPTCHA box';
    } else {
        // If CAPTCHA is successfully completed...

        // Paste mail function or whatever else you want to happen here!

			if(empty($name) ||empty($mobilenumber) ||empty($email) ||empty($password) ||empty($confirm_password))
			{
				$error = "Please fill all the fields";
			}
			elseif($password != $confirm_password){
				$error =  "Your passwords don't match";
			}
			else{

				$success = "Congos! You are now registerd";
				//Insertion query here
			$name ='';
			$mobilenumber ='';
			$email = '';
			$password = '';
			$confirm_password = '';
			}
    }
}

	?>
</br>
	<div class = "container">
		<div class="row">
			<!--<div class="card-body">-->
	
				<div class="col-md-3 col-md-6">
				<h3>Register Now</h3>
				<?php if(isset($error)){ ?>
					<p id="message" style = "color:red"><?php echo $error ?></p>
				<?php }
				if(isset($success)){ ?>
					<p id="message" style = "color:green"><?php echo $success ?>,You can <a href='#'>Login </a>from here.</p>
				<?php } ?>
				<form action="index.php" method="post" id="register_form">
                    <div class="form-group">
						<label for="name"  class="head">Your Name</label>
						<input class="form-control login-box" name="name" value="<?php echo $name ?>" type="text" id="name"  />
					</div>
					<div class="form-group">
						<label for="mobilenumber"  class="head">Mobile Number</label>
						<input class="form-control login-box" name="mobilenumber" value="<?php echo $mobilenumber ?>" type="text" id="mobilenumber"  />
					</div>
					<div class="form-group">
						<label for="email"  class="head">Email</label>
						<input class="form-control login-box" name="email" value="<?php echo $email ?>" type="email" id="email"  />
					</div>
					<div class="form-group">
						<label for="password"  class="head">Password</label>
						<input class="form-control login-box" name="password"  type="password" id="password"  />
					</div>
					<div class="form-group">
						<label for="confirm_password"  class="head">Confirm Password</label>
						<input class="form-control login-box" name="confirm_password"  type="password" id="confirm_password"  />
					</div>
					<div class="g-recaptcha" data-sitekey="_________YOUR SITE KEY____________"></div>
					<br>
					<button type="submit" name= "submit" class="btn btn-primary" id="register_button">Register</button>
					<p class="click">By clicking this button, you are agree to our  <a href="#">Policy Terms and Conditions.</a></p> 
				</form>
				</div>
			<!--</div>-->
		</div>
	</div>
<script>
	/*
$('#register_form').submit(function(e){
	e.preventDefault();
	var name = $('#name').val();
	var mobilenumber = $('#mobilenumber').val();
	var email = $('#email').val();
	var password = $('#password').val();
	var confirm_password = $('#confirm_password').val();
	var captcha = grecaptcha.getResponse();

	$.post("register.php",
	{
		name : name,
		mobilenumber : mobilenumber,
		email : email,
		password : password,
		confirm_password : confirm_password,
		captcha : captcha,
	},
	function(data){

		$('#error').html(data);
		/*$('#name').val('');
		$('#mobilenumber').val('');
		$('#email').val('');
		$('#password').val('');
		$('#confirm_password').val('');
		grecaptcha.getResponse('');


	});
});
*/
</script>
</body>
</html>
