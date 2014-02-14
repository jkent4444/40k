
<?php
	include_once('config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style/Main.css" />
	</head>
	<body>
			<div id="wrapper">

				<div id="container">
					<div id="opacity">
					</div>
					<div id="icontainer">
						
						<img id="title" src="style/image/title2.png" width="883.2" height="200">
						<a href="builder.php"><img class="Dimage" src="style/image/chaos2.jpg" width="800" height="300"></a>
						<a href="builder.php"><img class="Dimage" src="style/image/tau2.jpg" width="800" height="300"></a>
						<a href="builder.php"><img class="Dimage" src="style/image/gknight1.jpg" width="800" height="300"></a>
						<p>Select a race you wish to build.</p>
						<div id="ldisplay">
							<ul>
								 <li><a href= <?php if($isUserLoggedIn) { echo '"profile.php?' . $_SESSION['users']['email'] . '"> Profile </a></li>';
								}else {
								echo '"login.php"> Register/Login  </a></li>';} ?>
								<?php if ($isUserLoggedIn) { echo '<li><a href="logout.php">Logout</a></li>'; }  ?>
							</ul>
						</div>
						
					</div>
				</div>


			</div>
	</body>
</html>