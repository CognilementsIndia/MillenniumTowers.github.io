<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 		require_once 'PHPMailer/src/Exception.php';
        require_once 'PHPMailer/src/PHPMailer.php';
        require_once 'PHPMailer/src/SMTP.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$contactMail = $_POST['contactMail'];
$contactPhone = $_POST['contactPhone'];
$contactName  = $_POST['contactName'];
$contactMsg   = $_POST['contactMsg'];
$format = "/^[0-9]{10}+$/";

if (!filter_var($contactMail, FILTER_VALIDATE_EMAIL)) {

	echo '<script>
	alert("Please Enter Correct Email");
	window.location.href = "https://millenniumtower.in/";
	</script>';

}

elseif ( preg_match($format, $contactPhone) === 0) {

		echo '<script>
		alert("Please Enter Correct Phone Number");
		window.location.href = "https://millenniumtower.in/";
		</script>';
	
}else{
    
    include 'connection.php';
    if(isset($_POST['contact'])){
            $statement = $conn->prepare('INSERT INTO contact (contactName, contactPhone, contactMail, contactMsg)
                VALUES (:contactName, :contactPhone, :contactMail, :contactMsg)');
            
            $x = $statement->execute([
                'contactName' => $_POST['contactName'],
                'contactPhone' => $_POST['contactPhone'],
                'contactMail' => $_POST['contactMail'],
                'contactMsg' => $_POST['contactMsg']
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

                // $mail->Subject = $_POST['sub'];
                $mail->Body    = "<h2>Welcome to millenniumtower</h2><p><b>Full Name  : $contactName </b></p><p><b>Mobile No : $contactPhone </b></p><p><b>Email : $contactMail </b></p><p><b>Message : $contactMsg </b></p>";
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
                    window.location.href = "https://millenniumtower.in/thankyou.html";
                    </script>';
                         
                 }else{
                     echo '<script>
                    window.location.href = "https://millenniumtower.in/thankyou.html";
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