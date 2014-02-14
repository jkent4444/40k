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
						<img id="title" src="style/image/tau2.jpg" width="800" height="300">
						<p>Select a race you wish to build.</p>
						<?php
						//retrieve session data
						echo "Pageviews=". $_SESSION['views'];
						?>
						
					</div>
				</div>


			</div>
	</body>
</html>