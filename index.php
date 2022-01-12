<?php
require "db.php";
$sql ="SELECT *  FROM `blogs`";
$objDate=mysqli_query($con,$sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog CRUD SYSTEM</title>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
 <div class="container">
 <?php 
          
          

          if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          }

         ?>
  
<table class="table table-striped">
  <tr>
    <th>title</th>
    <th>content</th>
    <th>date</th>
    <th>image</th>
  </tr>

<?php
while($data=mysqli_fetch_assoc($objDate)){
  ?>

  <tr>
    <td><?php echo $data['title'];?></td>;
    <td><?php echo $data['content'];?></td>;
    
    <td><?php echo $data['image'];?></td>;
    <td><?php echo $data['id'];?></td>;
    <td>
      <a href='delete.php?id=<?php echo $data['id'];?>' class="btn btn-primary">Delete </a>
      <a href='edit.php?id=<?php echo $data['id'];?>' class="btn btn-danger">edit </a>

    </td>



  </tr>
  <?php }?>


</table>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</body>
</html>