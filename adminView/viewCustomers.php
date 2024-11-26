<div >
  <h2>All Customers</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">User_id</th>
        <th class="text-center">Username </th>
        <th class="text-center">Email</th>
        <th class="text-center">Mobile</th>
        <th class="text-center">user_Address</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from users ";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["user_name"]?></td>
      <td><?=$row["user_mail"]?></td>
      <td><?=$row["user_mob"]?></td>
      <td><?=$row["user_add"]?></td>
    </tr>
    <?php
            $count=$count+1;
           
        }
    }
    ?>
  </table>