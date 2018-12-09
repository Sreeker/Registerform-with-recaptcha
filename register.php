<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LdK7ioUAAAAAKds9qXDtDIhU_68ITuVDFidcqOo',//https://www.google.com/recaptcha/intro/v3.html
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
        echo 'Please check the security CAPTCHA box';
    } else {
        // If CAPTCHA is successfully completed...

        // Paste mail function or whatever else you want to happen here!
        	$name = $_POST['name'];
			$mobilenumber = $_POST['mobilenumber'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];

			if(empty($name) ||empty($mobilenumber) ||empty($email) ||empty($password) ||empty($confirm_password))
			{
				echo "Please fill all the fields";
			}
			elseif($password != $confirm_password){
				echo "Your passwords don't match";
			}
			else{

				echo "Congos! You are now registerd";
				//Insert query here
			}
    }
}
?>
