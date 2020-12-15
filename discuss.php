<?php
    session_start();
    $conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
    $state = false;
    $userid = $_SESSION['userid'];
    $gsql = "SELECT * FROM user_group WHERE userid = $userid";
    $gresult = $conn->query($gsql);
        if ($gresult->num_rows > 0) {
            while ($grow = $gresult->fetch_assoc()) {
                $gid =$grow['groupid'];
                $sql = "SELECT * FROM project WHERE $gid";
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row['proid'] == $_GET['id']) {
                                $state = true;
                            }else{
                                if ($_SESSION['type'] == "admin") {
                                    $state = true;
                                }
                            }
                        }
                    } else {
                        if ($_SESSION['type'] == "admin") {
                            $state = true;
                        }
                    }
            }
        } else {
            if ($_SESSION['type'] == "admin") {
                $state = true;
            }
        }
    $conn->close();
        if (!$state) {
            $_SESSION['msg'] = "你沒有權限進入此專案";
            header("Location:user.php");
        }
?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>專案討論</title>
    <?php include('head.php');?>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php
$id = $_GET['id'];
$_SESSION['proid'] = $id;
$conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
$sql = mysqli_query($conn, "SELECT * FROM project WHERE proid = $id");
    $row = mysqli_fetch_assoc($sql);
    $proname = $row['name'];
 $conn->close();
?>
<?php include('navbar.php');?>
<body class="b txt-center">
    <br>
        <h1>專案討論</h1>
        <h3>專案名稱:<?php echo $proname;?></h3>
    <div class="container c ">
        <table class="table">
                    <thead>
                        <tr>
                            <th>面向</th>
                            <th>面向說明</th>
                            <th>功能</th>
                        </tr>
                    </thead>
                    <?php
                    $conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
                    $sql = "SELECT * FROM face WHERE proid = $id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["name"] . "</td><td>" . $row["des"] . "</td><td>" . '<a href=face.php?id=' . $row["faceid"] .' class="btn btn-primary">進入討論</a>' . "</td></tr>";
                            
                        }
                    } else {
                         return;
                    }
                    $conn->close();
                    ?>
                    </table>
    </div>
</body>
</html>