<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</head>

<style>
html {
    height:100%;
}
body {
  background-image: url('background.png');
  height: 100%;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
}
.vertical-center {
    background-image: url('background.png');
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center center;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    vertical-align:middle;
}

.form {}
</style>

<body class="text-center">
    <div class="jumbotron vertical-center">
    <div class="container text-center">

		
				

			<form class="form-signin" action="login.php" method="post">
								  
				<div class="control-group">
					<div class="controls">
						<input name="email" type="text"  placeholder="email" required> 
					</div>	
				</div> 

				
				<div class="control-group">
					<div class="controls">
						<input name="password" type="password" placeholder="password"> 
					</div>	
				</div> 

				<br />

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Sign in</button> 
					&nbsp; &nbsp;
					<a class="btn btn-primary" href="register.php">Join Today!</a>
				</div>

				<p>Bay City Rooms is a platfrom to view rooms for rent, and provide rooms for rent in the city of Bay City. </p>

				
			</form>
            
				
    </div> <!-- end div: class="container" -->
    </div>

  </body>
  
</html>