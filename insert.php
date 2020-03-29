<?php
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$state = $_POST['state'];
$city = $_POST['city'];
$email = $_POST['email'];

if (!empty($firstname) || !empty($middlename) || !empty($lastname) || !empty($gender) || !empty(address) || !empty($phone) || !empty($state) || !empty($city) || !empty($email)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "form";

    $conn = new mysqli($host ,  $dbusername , $dbpassword , $dbname );

    if(mysqli_connect_error()){
    	die('connect error('. mysqli_connect_errono().')' . mysqli_connect_error());
    }  else{
    	$SELECT = "SELECT email From form Where email = ? Limit 1";
    	$INSERT = "INSERT Into form (firstname, middlename, lastname, gender, address, phone, state, city, email) values(?,?,?,?,?,?,?,?,?)";

    	$stmt = $conn->prepare($SELECT);
    	$stmt->bind_param("s" , $email);
    	$stmt->execute();
    	$stmt->bind_result($email);
    	$stmt->store_result();
    	$rnum = $stmt->num_rows;

    	if($rnum == 0){
    		$stmt->close();
    		$stmt = $conn->prepare($INSERT);
    		$stmt ->bind_param("sssssisss" , $firstname, $middlename, $lastname, $gender, $address, $phone, $state, $city, $email);
    		$stmt->execute();
    		echo "new record inserted successfully";
    	} else{
    		echo "someone alreadyregistered";
    	}
    	$stmt->close();
    	$conn->close();
    }


} else{
	echo "all feilds are required";
	die();
}
?>