<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
$proid = $_GET['id'];
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
$projectsql = mysqli_query($sql,"SELECT * FROM project WHERE proid = $proid");
$projectrow = mysqli_fetch_assoc($projectsql);
$projectname = $projectrow['name'];
?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>執行方案</title>
    <?php include('head.php');?>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php include('navbar.php');?>
<body class="b txt-center">
    <br>
        <h2>執行方案</h2>
        <h3>專案名稱:<?=$projectname?></h3>
    <div class="container c ">
        <table class="table">
                    <thead>
                        <tr>
                            <th>編號</th>
                            <th>執行方案名稱</th>
                            <th>執行方案說明</th>
                            <th>功能</th>
                        </tr>
                    </thead>
                    <?php
                        $result = mysqli_query($sql,"SELECT * FROM action_plan WHERE proid =$proid");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>".$row['num']."</td><td>".$row['name']."</td><td>".$row['des']."</td><td><a href='action.php?id=".$row['actionid']."' class='btn btn-primary'>查看</a> <a href='actionscore.php?id=".$row['actionid']."' class='btn btn-primary'>評分</a></td></tr>";
                            }
                    ?>
                    </table>
    </div>
</body>
</html>