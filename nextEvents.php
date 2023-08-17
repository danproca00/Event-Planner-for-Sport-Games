<?php
include 'config.php';

error_reporting(0);
session_start();

$idUser = $_SESSION['id'];
if (isset($_POST["submitNoParticipation"])) {
    $a=$_POST["submitNoParticipation"];
    $sql4 = "delete from attendanceList where idUsers=$idUser and idEvent=$a";
    $result4 = mysqli_query($conn, $sql4);
    if ($result4) {
            header("Location:nextEvents.php");
         }else {
            echo "<script>alert('Woops! Something Wrong Went Yoda Said.')</script>";
         }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Your next events</title>
    <link rel="stylesheet" type="text/css" href="styleAll.css">
    <link rel="shortcut icon" type="image/jpg" href="appstore.png" />

</head>

<body>
    <?php include 'navbar.php' ?>
    <center>
        <div class="container" style="text-align: left;">
            <form action="" method="POST" class="login-email">
                <div class="card" class="panel panel-primary">
                    <div class="panel-body" style="border-color:black">
                        <h1 style="padding:10px 50px 40px 40px">Next events you created</h1>
                        <?php
                        $sql = "SELECT * FROM event where date>curdate() and id_creator = $idUser order by date";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result)) {
                            while ($row = mysqli_fetch_array($result)) {
                                $idEvent = $row['id'];
                                $attendance = 1;
                                $sql3 = "SELECT count(*) as nr FROM attendanceList where idEvent = $idEvent";
                                $result3 = mysqli_query($conn, $sql3);
                                $attendance += mysqli_fetch_array($result3)['nr'];
                                $participanti='';
                                $sql2 = "SELECT * FROM users where  id in (select idUsers from attendanceList where idEvent=$idEvent)";
                                $result2 = mysqli_query($conn, $sql2);
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    $participanti .= $row2['username'];
                                    $participanti .=', ';
                                    $participanti .= $row2['email'] ;
                                    $participanti .= PHP_EOL;
                                }
                        ?>
                                <div class="row">
                                    <center>
                                        <div style="width: 98%; padding-left:25px; padding-top:5px;margin:0px;border-bottom: groove; text-align: left;" class="row">
                                            <p style="width:20%; float: left; padding-right: 15px"><b><?php echo  $row['name'] ?></b></p>
                                            <p style="width:30%; float: left; padding-right: 15px"><?php echo  $row['place'] ?></p>
                                            <p style="width:20%; float: left; padding-right: 15px"><?php echo  $row['date'] ?></p>
                                            <p style="width:30%; float: left; padding-right: 15px" title="<?php echo  $participanti?>"><?php echo $attendance ?>/<?php echo $row['maxNumber'] ?> participants</p>
                                            <p>Description: <?php echo  $row['description'] ?></p>
                                        </div>
                                    </center>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="row">
                                <center>
                                    <div style="width: 98%; padding-left:25px; padding-top:5px;margin:0px;border-bottom: groove; text-align: left;" class="row">
                                        <p style="width:20%; float: left; padding-right: 15px"><b>No events created</b></p>
                                    </div>
                                </center>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
        </div>
        </form>
        </div>
    </center>

    <center>
        <div class="container" style="text-align: left;">
            <form action="" method="POST" class="login-email">
                <div class="card" class="panel panel-primary">
                    <div class="panel-body" style="border-color:black">
                        <h1 style="padding:10px 50px 40px 40px">Next events you joined</h1>
                        <?php
                        $sql = "SELECT * FROM event where date>curdate() and id in (select idEvent from attendanceList where idUsers=$idUser)";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result)) {
                            while ($row = mysqli_fetch_array($result)) {
                                $idEvent = $row['id'];
                                $attendance = 1;
                                $sql3 = "SELECT count(*) as nr FROM attendanceList where idEvent = $idEvent";
                                $result3 = mysqli_query($conn, $sql3);
                                $attendance += mysqli_fetch_array($result3)['nr'];
                                $participanti='';
                                $sql2 = "SELECT * FROM users where id in (select idUsers from attendanceList where idEvent=$idEvent) or id in (select id_creator from event where id=$idEvent)";
                                $result2 = mysqli_query($conn, $sql2);
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    $participanti .= $row2['username'];
                                    $participanti .=', ';
                                    $participanti .= $row2['email'] ;
                                    $participanti .= PHP_EOL;
                                }

                        ?>
                                <div class="row">
                                    <center>
                                        <div style="width: 98%; padding-left:25px; padding-top:5px;margin:0px;border-bottom: groove; text-align: left;" class="row">
                                            <p style="width:20%; float: left; padding-right: 15px"><b><?php echo  $row['name'] ?></b></p>
                                            <p style="width:30%; float: left; padding-right: 15px"><?php echo  $row['place'] ?></p>
                                            <p style="width:20%; float: left; padding-right: 15px"><?php echo  $row['date'] ?></p>
                                            <p style="width:15%; float: left; padding-right: 15px" title="<?php echo  $participanti?>"><?php echo $attendance ?>/<?php echo $row['maxNumber'] ?> participants</p>
                                            <button type="submit" style="width:15%; float: right; padding-right: 15px; text-align:center" class="button" value="<?php echo $idEvent ?>" name="submitNoParticipation" style="width:100%;" class="btn btn-primary" >Retreat</button>
                                            <p>Description: <?php echo  $row['description'] ?></p>
                                        </div>
                                    </center>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="row">
                                <center>
                                    <div style="width: 98%; padding-left:25px; padding-top:5px;margin:0px;border-bottom: groove; text-align: left;" class="row">
                                        <p style="width:20%; float: left; padding-right: 15px"><b>No events</b></p>
                                    </div>
                                </center>
                            </div>
                        <?php
                        }
                        ?>
                        
                    </div>
                </div>
            </form>
        </div>
    </center>

</body>

</html>