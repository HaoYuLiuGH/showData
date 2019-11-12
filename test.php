<?php
  require("db_config.php");
  $conn = new mysqli($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
   // Check connection
   if ($conn->connect_error)
   {
       die("连接失败: " . $conn->connect_error);
   }

  mysqli_query($conn,"set names 'utf8'"); //数据库输出编码

  $result = $conn->query("SELECT * FROM `date`");
  $data="";
  $array= array();
  class User
  {
    public $time;
    public $sum;
  }
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
  {
    $user=new User();
    $user->time = $row['time'];
    $user->sum = $row['sum'];
    $array[]=$user;
  }

  $data=json_encode($array);
  //echo "{".'"user"'.":".$data."}";
  echo $data;
?>