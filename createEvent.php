<?php 
include 'config.php';

session_start();

error_reporting(0);


if (isset($_POST['submit'])) {
   $idUser = $_SESSION['id'];
   $eventName = $_POST['eventName'];
   $eventType = $_POST['eventType'];
   $eventLocation = $_POST['eventLocation'];
   $eventDate = strtotime($_POST['eventDate']);
   $eventMaxPeople = $_POST['eventMaxPeople'];
   $eventDuration = $_POST['eventDuration'];
   $eventImageURL = $_POST['eventImageURL'];
   $eventDescription = $_POST['eventDescription'];
   $newDate = date('Y-m-d H:i:s', $eventDate);

   $sql = "INSERT INTO event (id_Creator, name, type, date, place, maxNumber, description, duration,imageLink) VALUES ('$idUser', '$eventName', '$eventType', '$newDate', '$eventLocation', '$eventMaxPeople', '$eventDescription', '$eventDuration', '$eventImageURL')";
   $result = mysqli_query($conn, $sql);
   if ($result) {
            echo "<script>alert('Wow! An event was created.')</script>";
            $eventName = "";
            $eventType = "";
            $eventLocation = "";
            $eventDate = "";
            $eventMaxPeople = "";
            $eventDuration = "";
            $eventImageURL = "";
            $eventDescription = "";
            header("Location:createEvent.php");

         }else {
            echo "<script>alert('Woops! Something Wrong Went Yoda Said.')</script>";
         }

	
}?>


<!DOCTYPE html>
<html>
<head>
<title>Create an event</title>
<link rel="stylesheet" type="text/css" href="styleAll.css">
<link rel="shortcut icon" type="image/jpg" href="appstore.png"/>
    
</head>
<body>
<?php include 'navbar.php' ?>
<div class="container">
<form action="" method="POST" class="login-email">
   <div class="card" class="panel panel-primary" >
      <div class="panel-body" style="border-color:black">
        <h1 style="padding:10px 50px 0 40px">Create an event</h1>
         <div class="row">
            <div style="padding: 40px 40px 0 40px">
               <div class="form-group">
                  <label class="control-label">Event name</label>
                  <input type="text" class="form-control" name="eventName" value="<?php echo $eventName; ?>" required>
               </div>
            </div>
            <div style="padding: 0 40px 0 40px">
               <div class="form-group">
                  <label class="control-label">Event type</label>
                  <input type="text" class="form-control" name="eventType" value="<?php echo $eventType; ?>" required>
               </div>
            </div>
         </div>
         <div class="row">
            <div style="padding: 0 40px 0 40px">
               <div class="form-group">
                  <label class="control-label">Location</label>
                  <input type="text" class="form-control" name="eventLocation" value="<?php echo $eventLocation; ?>" required>
               </div>
            </div>
            <div style="padding: 0 40px 0 40px" class="col-md-6">
               <div class="form-group">
                  <label class="control-label">Event date</label>
                  <div class='input-group date' id='datetimepicker1'>
                     <input type="text" class="form-control" name="eventDate" value="<?php echo $eventDate; ?>" required/>
                     <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                  </div>
               </div>
            </div>
            <div style="padding: 0 40px 0 40px" class="col-md-6">
               <div class="form-group">
                  <label class="control-label">Maximun number of people</label>
                  <input type="text" class="form-control" name="eventMaxPeople" value="<?php echo $eventMaxPeople; ?>" required>
               
               </div>
            </div>
         </div>
         <div class="row">
           
            <div style="padding: 0 40px 0 40px" class="col-md-6">
               <div class="form-group">
                  <label class="control-label">Duration (in hours)</label>
                  <input type="text" class="form-control" name="eventDuration" value="<?php echo $eventDuration; ?>" required>
               </div>
            </div>
            <div style="padding: 0 40px 0 40px" class="col-md-6">
               <div class="form-group">
                  <label class="control-label">Image URL</label>
                  <input type="text" class="form-control" name="eventImageURL" value="<?php echo $eventImageURL; ?>">
               </div>
            </div>
         </div>
         <div class="row">
            <div style="padding: 0 40px 0 40px">
               <div class="form-group">
                  <label class="control-label">Description</label>
                  <input type="text" class="form-control" name="eventDescription" value="<?php echo $eventDescription; ?>">
               </div>
            </div>
         </div>
         <input type="submit" class="button" value="submit" name="submit" style="width:100%;" class="btn btn-primary" />
      </div>
   </div>
</form>
</div>
		
</body>
</html>