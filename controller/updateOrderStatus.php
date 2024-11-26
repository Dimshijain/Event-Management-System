<?php

    include_once "../config/dbconnect.php";
   
    $order_id=$_POST['record'];
 
    $sql = "SELECT order_status from order_details where detail_id='$order_id'"; 
    $result=$conn-> query($sql);
  

    $row=$result-> fetch_assoc();
    

    
    if($row["order_status"]==0){
         $update = mysqli_query($conn,"UPDATE order_details SET order_status=1 where detail_id='$order_id'");
    }
    
        
 
   
    
?>