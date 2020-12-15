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
                $sql = "SELECT * FROM project WHERE groupid = $gid";
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $proid = $row['proid'];
                            $psql = "SELECT * FROM face WHERE proid = $proid";
                            $presult = $conn->query($psql);
                            if ($presult->num_rows > 0) {
                                while ($prow = $presult->fetch_assoc()) {
                                    if ($prow['faceid'] == $_GET['id']) {
                                        $facename = $prow['name'];
                                        $facestate = $prow['state'];
                                        $proid2 = $prow['proid'];
                                        $state = true;
                                    }else{
                                        if ($_SESSION['type'] == "admin") {
                                            $facename = $prow['name'];
                                            $facestate = $prow['state'];
                                            $proid2 = $prow['proid'];
                                            $state = true;
                                        }
                                    }
                        }
                    }
                        }
                    }
            }
        } else {
            if ($_SESSION['type'] == "admin") {
                $id = $_GET['id'];
                $state = true;
                $psql = "SELECT * FROM face WHERE faceid = $id";
                $presult = $conn->query($psql);
                    if ($presult->num_rows > 0) {
                        while ($prow = $presult->fetch_assoc()) {
                            $facename = $prow['name'];
                            $facestate = $prow['state'];
                            $proid2 = $prow['proid'];
                        }
                    }
            }
        }
    $conn->close();
    ?>
    <?php
    $conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
    $id = $_GET['id'];
    if ($facestate == "true") {
        mysqli_query($conn,"UPDATE `face` SET state = 'false' WHERE faceid = $id");
        $_SESSION['msg'] = "已停止發表意見";
        header("Location:face.php?id=$id");
    }else {
        mysqli_query($conn,"UPDATE `face` SET state = 'true' WHERE faceid = $id");
        $_SESSION['msg'] = "已開始發表意見";
        header("Location:face.php?id=$id");
    }
    $conn->close();
    ?>