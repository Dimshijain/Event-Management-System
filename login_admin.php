<?php
 session_start();
  require_once "connect.php";
 if(isset($_POST['LOGIN']))
 {
   $email=$_POST['email'];
   $password=$_POST['password'];


   $sql="SELECT * FROM admin_details WHERE username='$email' && pass='$password'";
   $data=mysqli_query($con,$sql);
   $row=mysqli_fetch_array($data,MYSQLI_ASSOC);
   $count=mysqli_num_rows($data);
   if($count==1)
    {
      $_SESSION['username']=$email;
      header('location:index.php');
    }
   else
    {
        ?>
        <script>
           window.location.href="admin_login.php";
           alert("plz right username:failed");
   
        </script>
        <?php  
    }
 }
?>