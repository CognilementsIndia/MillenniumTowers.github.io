<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 		require_once 'PHPMailer/src/Exception.php';
        require_once 'PHPMailer/src/PHPMailer.php';
        require_once 'PHPMailer/src/SMTP.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = $_POST['email'];
$phone = $_POST['phone'];
$name  = $_POST['fname'];
$msg   = $_POST['msg'];
$format = "/^[0-9]{10}+$/";

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

	echo '<script>
	alert("Please Enter Correct Email");
	window.location.href = "https://millenniumtower.in/";
	</script>';

}

elseif ( preg_match($format, $phone) === 0) {

		echo '<script>
		alert("Please Enter Correct Phone Number");
		window.location.href = "https://millenniumtower.in/";
		</script>';
	
}else{
    
    include 'connection.php';
    if(isset($_POST['enquiry'])){
            $statement = $conn->prepare('INSERT INTO enquiry (name, phonenumber, email, city, subject, message)
                VALUES (:fname, :phone, :email, :city, :sub, :msg)');
            
            $x = $statement->execute([
                'fname' => $_POST['fname'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'city' => $_POST['city'],
                'sub' => $_POST['sub'],
                'msg' => $_POST['msg']
            ]);
            // print_r($x);
            // die();
            if($x){
                $mail = new PHPMailer;

                //$mail->isSMTP();
                $mail->Host       = 'smtp.googlemail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'bhaktikashalkar.cognilements@gmail.com';
                $mail->Password   = 'bhakti1210**';
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;
                $mail->setFrom($email);
                $mail->addAddress('bhakti.kashalkar@cognilements.com');
                $mail->addCC('shubham@cognilements.com');
                //$mail->Subject = 'Support Mail by user';
                // Set email format to HTML
                $mail->isHTML(true);

                $mail->Subject = $_POST['sub'];
                $mail->Body    = "<h2>Welcome to millenniumtower</h2><p><b>Full Name  : $name </b></p><p><b>Mobile No : $phone </b></p><p><b>Email : $email </b></p><p><b>Message : $msg </b></p>";
                // if(!$mail->send()) {
                //     echo 'Message could not be sent.';
                //     echo 'Mailer Error: ' . $mail->ErrorInfo;
                // } else {
                //   echo "<script>alert ('Thank you for Contacting, Our Sales Representative will contact you shortly.');
                //                     window.location='index.html';</script>";
                // }
                // echo $mail->send();die();
                 if($mail->send()) {
                    echo '<script>
                    alert("Submitted Successfully");
                    window.location.href = "https://millenniumtower.in/";
                    </script>';
                         
                 }else{
                     echo '<script>
                    alert("Submitted Successfully");
                    window.location.href = "https://millenniumtower.in/";
                    </script>';
                 }
            }
            
            else{
            	echo '<script>
            	alert("Something went wrong! Try again.");
            	window.location.href = "https://millenniumtower.in/";
            	</script>';
            }
      } 
} 
}
?>