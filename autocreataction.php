<?php 
$projectid = $_GET['id'];
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
$facesql = mysqli_query($sql,"SELECT * FROM face WHERE proid= $projectid");
$facerow = mysqli_fetch_assoc($facesql);
$data = array();
//演算法WAIT