<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
	<style type="text/css">
		.container {
			margin-top: 40px;
		}
		.btn-primary {
			width: 100%;
		}
        .card2 {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        
        }
        
	</style>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script> 
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

	<script type='text/javascript'>
		$( document ).ready(function() {
			$('#datetimepicker1').datetimepicker();
		});
	</script>
  <link rel="stylesheet" type="text/css" href="styleNavbar.css">
</head>
<body>
<nav class="card2">
  <div class="container-fluid">
    <ul class="nav navbar-nav" style="text-align:center;">
    <li><a  href="welcome.php" style="padding-left:30px;padding-right:30px;color:black"><b>Home</b></a></li>
      <li><a href="searchEvent.php" style="color:black">Search for sports events</a></li>
      <li><a href="createEvent.php" style="color:black">Create event</a></li>
      <li><a href="nextEvents.php" style="color:black">Your next events</a></li>
      <li><a href="logout.php" style="color:black">Logout</a></li>
    </ul>
      <div style="float:right; margin: 5px 0px 0 0;padding-right:30px"> <?php echo "<h4>Welcome " . $_SESSION['username'] . "</h4>"; ?></div>
  </div>

</nav>
</body>
</html>