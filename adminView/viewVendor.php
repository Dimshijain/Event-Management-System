<div >
  <h2>All vendor</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">User_id</th>
        <th class="text-center">Username </th>
        <th class="text-center">Email</th>
        <th class="text-center">Mobile</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from vendor ";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["v_name"]?></td>
      <td><?=$row["v_mail"]?></td>
      <td><?=$row["v_mob"]?></td>
    </tr>
    <?php
            $count=$count+1;
           
        }
    }
    ?>
  </table>