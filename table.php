<?php
include("compare.php");
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
 <div class="row">
   <div class="col-sm-8">
    <?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
      <table class="table table-bordered">
       <thead><tr>
         <th>folio_id</th>
         <th>issue_date</th>
         <th>expired_date</th>
         <th>PJ</th>
         <th>Keterangan</th>
    </thead>
    <tbody>
  <?php
      if(is_array($fetchdata)){      
      $sn=1;
      foreach($fetchdata as $data){
    ?>
      <tr>

      <td><?php echo $data['folio_id']??''; ?></td>
      <td><?php echo $data['issue_date']??''; ?></td>
      <td><?php echo $data['expired_date']??''; ?></td>
      <td><?php echo $data['PJ']??''; ?></td>
      <td><?php echo $data['keterangan']??''; ?></td>
     </tr>
     <?php
      $sn++;}}else{ ?>
      <tr>
        <td colspan="8">
    <?php 
      echo $fetchdata; 
      echo $truncate_data;  
    ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
   </div>
</div>
</div>
</div>

<a href="index.php">Kembali ke Menu awal</a>
</body>
</html>