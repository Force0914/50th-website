<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
$proid = $_GET['id'];
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
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
        <h1>執行方案</h1>
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
                                echo "<tr><td>".$row['num']."</td><td>".$row['name']."</td><td>".$row['des']."</td><td><a href='actionscore.php?id=".$row['actionid']."' class='btn btn-primary'>評分</a></td></tr>";
                            }
                    ?>
                    </table>
    </div>
</body>
</html>