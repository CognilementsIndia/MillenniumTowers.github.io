<?php
//  echo "<pre>";
//      print_r($_POST);
//     //  die();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$email = $_POST['email'];
$phone = $_POST['phone'];
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
	
}

else{
    
$servername = "localhost";
$username = "millenn2";
$password = "Kishanbishnoi@123";

try {
  $conn = new PDO("mysql:host=$servername;dbname=millenn2_userdetails", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        print_r($x);
        die();
        if($x){
            // echo '<script>
            // alert("Submitted Successfully");
            // window.location.href = "https://millenniumtower.in/";
            // </script>';
            header(location:"https://thankyou.html");
        }
        else{
        	echo '<script>
        	alert("Something went wrong! Try again.");
        	window.location.href = "https://millenniumtower.in/";
        	</script>';
        }
  }    
 if(isset($_POST['brochure'])){
    //  echo "<pre>";
    //  print_r($_POST);
    //  die();
     $statement = $conn->prepare('INSERT INTO brochure (firstname, lastname, email, city, phonenumber)
    VALUES (:firstname, :lastname, :email, :city, :phone)');

    $result = $statement->execute([
        'firstname' => $_POST['fname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'city' => $_POST['city'],
        'phone' => $_POST['phone']
    ]);

    if($result){
            $url = 'https://millenniumtower.in/images/Brochure.pdf';
	       // $file_name = basename($url);
            header('Content-type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($url) . '"');
            header('Content-Transfer-Encoding: binary');
            readfile($url);
	       
    }else{
        echo '<script>
	            alert("Something went wrong! Try again.");
	            window.location.href = "https://millenniumtower.in/";
	        </script>';
    }
 }
} catch(PDOException $e) {

  echo "Connection failed: " . $e->getMessage();
}
}
}

?> 