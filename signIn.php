<?php
	$User_Name  =$_POST['User_Name'];
	$Password   =$_POST['Password'];
	//Prevent Back button after signed out 
	session_start();
	
	//Database connection
	$conn = new mysqli('localhost','root','','servingsoul_reg');
	if($conn->connect_error){
		die('Connection Failed :'.$conn->connect_error);
	}else{
			$stmt=$conn->prepare("SELECT * from registration where User_Name = ?");
			$stmt->bind_param("s",$User_Name);
            $stmt->execute();
			$stmt_result= $stmt->get_result();
			if($stmt_result->num_rows>0){
				$data = $stmt_result->fetch_assoc();
				if(password_verify($Password,$data['Password'])){
					echo'<head>
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<title>ServingSouls | PB&Js for the Hungry</title>
						<link rel="shortcut icon" type="image/png" href="images/pb&jz.png">
						<link rel="stylesheet" href="stylez.css">
						<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
						<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 	 
						</head>
						 <body>
						 <a href="log_Out.php"><button postion="right" class="buttonHolder" style="float: right;">Logout</button></a>
						 <h1><center position="fixed">Welcome, '. $User_Name.' </h1>
						 <center><iframe src="Sandwiches_Selection.html" width="700" height=600></iframe></center>
						 <center><iframe src="Logged_Home.html" width="1560" height=1315></iframe></center>
						 </body>
						 ' 			 
					;
				}else{
					echo "Invaild Username/Password";
				}
			}else {
				echo "Both Username/Password not found";
			}
	}
?>