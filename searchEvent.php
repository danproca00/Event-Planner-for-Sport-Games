<?php
include 'config.php';

error_reporting(0);
session_start();

$idUser = $_SESSION['id'];

if (isset($_POST['submitSearch'])) {
    $_SESSION['evName'] = $_POST['eventName'];
    $_SESSION['evType'] = $_POST['eventType'];
    $_SESSION['evLocation'] = $_POST['eventLocation'];
}

if (isset($_POST["submitAttend"])) {
    $a=$_POST["submitAttend"];
    $sql4 = "INSERT INTO attendanceList (idEvent, idUsers) VALUES ('$a','$idUser');";
    $result4 = mysqli_query($conn, $sql4);
    if ($result4) {
            header("Location:searchEvent.php");

         }else {
            echo "<script>alert('Woops! Something Wrong Went Yoda Said. $idUser')</script>";
         }
}


$eventName = $_SESSION['evName'];
$eventType = $_SESSION['evType'];
$eventLocation = $_SESSION['evLocation'];
?>


<!DOCTYPE html>
<html>

<head>
    <title>Search for events</title>
    <link rel="stylesheet" type="text/css" href="styleAll.css">
    <link rel="shortcut icon" type="image/jpg" href="appstore.png" />

</head>

<body>
    <?php include 'navbar.php' ?>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <div class="card" class="panel panel-primary">
                <div class="panel-body" style="border-color:black">
                    <h1 style="padding:10px 50px 40px 40px">Search for events</h1>
                    <div class="row">
                        <div style="padding: 0 30px 0 30px" class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="eventType" placeholder="Type" value="<?php echo $eventType; ?>" />
                            </div>
                        </div>
                        <div style="padding: 0 30px 0 30px" class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="eventName" placeholder="Name" value="<?php echo $eventName; ?>" />
                            </div>
                        </div>
                        <div style="padding: 0 30px 0 30px" class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="eventLocation" placeholder="Location" value="<?php echo $eventLocation; ?>" />
                            </div>
                        </div>

                    </div>
                    <input type="submit" class="button" value="Search" name="submitSearch" style="width:100%;" class="btn btn-primary" />
                    
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <form action="" method="POST" class="login-email">
            <?php
            $sql = "SELECT * FROM event where name like '%$eventName%' and type like '%$eventType%' and place like '%$eventLocation%' and date>curdate() and id_creator <> $idUser order by date";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_array($result)) {
                    $evntPic = 'https://cdn.knd.ro/media/521/2863/1666/20171846/1/thumbnail-pariati-pe-fotbal-cu-betfair-sports.jpg';
                    $attendance = 1;
                    $idEvent = $row['id'];
                    $sql2 = "SELECT * FROM attendanceList where idEvent = $idEvent and idUsers = $idUser";
                    $result2 = mysqli_query($conn, $sql2);
                    if (!mysqli_num_rows($result2)) {
                        $sql3 = "SELECT count(*) as nr FROM attendanceList where idEvent = $idEvent";
                        $result3 = mysqli_query($conn, $sql3);
                        $attendance += mysqli_fetch_array($result3)['nr'];
                        if($attendance<$row['maxNumber']){

            ?>

                        <div style="display: inline-block; max-width: 345px; width:100%;" class="card" class="panel panel-primary">
                            <div class="panel-body" style="border-color:black;text-align:center">
                                <?php
                                if ($row['imageLink'] != '') {
                                    $evntPic = $row['imageLink'];
                                }
                                ?>
                                <img src="<?php echo $evntPic ?>" style="height: 150px; ">
                                <h3 style="padding:10px 50px 0 40px"><?php echo $row['name'] ?></h3>
                                <p><?php echo  $row['type']?></p>
                                <p><?php echo $row['date'] ?></p>
                                <p><?php echo $row['place'] ?></p>
                                <p><?php echo $row['duration'] ?> hours</p>
                                <p><?php echo $attendance ?>/<?php echo $row['maxNumber'] ?> participants</p>

                                <button type="submit" class="button" value="<?php echo $row['id'] ?>" name="submitAttend" style="width:100%;" class="btn btn-primary" title="<?php echo $row['description'] ?>">Attend</button>
                            </div>
                        </div>
                <?php
                    }}
                }
            } else {
                ?>
                <h1>There are no events available</h1>
            <?php
            }
            ?>
        </form>
    </div>

</body>

</html>