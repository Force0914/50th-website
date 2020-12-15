<?php
                    $gadmin = false;
                    $conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
                    $userid = $_SESSION['userid'];
                    $gsql = "SELECT * FROM user_group WHERE userid = $userid";
                    $gresult = $conn->query($gsql);
                    if ($gresult->num_rows > 0) {
                         while ($grow = $gresult->fetch_assoc()) {
                             if ($grow['pre'] == 'admin') {
                                    $gadmin = true;
                             }
                            }
                          }
                          if ($_SESSION['type'] == "admin") {
                                 $gadmin = true;
                          }
                             ?>
<div class="navbar">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" <?php if($_SESSION['type'] == "admin"){echo 'href = "admin.php"';}else {echo 'href = "user.php"';}?>>
				<?php echo $_SESSION['username'];?><?php if($_SESSION['type'] == "admin"){echo "/管理者";$admin = true;}else{if ($gadmin) {echo "/組長";$admin = false;}else{echo "/組員";$admin = false;}};?>
			</a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
					<?php if($admin){echo '<li><a href="project.php">專案管理</a></li>';}; ?>
					<?php if($admin){echo '<li><a href="admin.php">使用者管理</a></li>';}; ?>
					<li><a href="user.php">專案討論</a></li>
					<?php if($gadmin){echo '<li><a href="teamleader.php">組長功能管理</a></li>';}; ?>
					<li><a href="#">統計管理</a></li>
					<li><a href="logout.php">登出</a></li>
                    </ul>
                    </div>
                </div>
              </div>
            </div>
<br>
<br>
<br>