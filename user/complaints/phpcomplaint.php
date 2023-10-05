<html>
<head>
  <script type="text/javascript" src="swal/jquery.min.js"></script>
  <script type="text/javascript" src="swal/bootstrap.min.js"></script>
  <script type="text/javascript" src="swal/sweetalert2@11.js"></script>
</head>


<body>
<?php
require '../connect.php';
session_start();
$email=$_SESSION['email'];
$title=$_POST['title'];
$type=$_POST['type'];
$description=$_POST['description'];
$date = date("Y-m-d"); 
$sql="INSERT INTO complaint(title,description,type,date,email,reply)values('$title','$description','$type','$date','$email','0')";
insert_data($sql);
?>
<script>
          Swal.fire({
            icon: 'success',
            text: 'Complaint Submitted !!!',
            didClose: () => {
              window.location.replace('../player/profile.php');
            }
          });
        </script>
</body>
</html>