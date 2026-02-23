<?php

include 'config.php';
include 'pdo.php';

session_start();

if(isset($_SESSION['uemail'])) {

    $email = $_SESSION['uemail'];
    $uid = $_SESSION['uid'];

    $query = $connPDO->prepare("SELECT * from `user_detail` where `uid` = :uid");
    $query->bindParam(':uid', $uid, PDO::PARAM_INT);
    $query->execute();
    if($query){
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
    if(count($rows) > 0) {
        $role = $rows[0]['role']; // Access the 'role' of the first row
    }
}

}


if(isset($_POST['submit']))
{

$email = $_POST['email'];
$textarea = $_POST['text'];
$sdate = $_POST['sdate'];
$edate = $_POST['edate'];
// $file = $_FILES['fileDoc'];


// if (!empty($file) && !isset($file)) {
//     $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
//     if (!in_array($file['type'], $allowedTypes)) {
//         echo "Only JPEG, PNG, GIF, and PDF files are allowed.";
//         exit();
//     }
//     $stmt = $connPDO->prepare(
//         "SELECT `id` FROM `emp_leave` order by `id` desc");
//     $stmt->execute();

    

//     $row = $stmt->fetch(PDO::FETCH_ASSOC);
//     if($row){
//         $numID =  $row['id'];
//         $numID=$numID+1;
//     }

//     if(isset($numID) && !empty($numID))
//     {
//         $fileName = $numID.'_'.$uid.'_'.$file['name'];
//     }
//     else{
//         $fileName = "1_".$uid.'_'.$file['name']; 
//     }
//     $uploadsDir = 'leave_doc/';
//     if (!move_uploaded_file($file['tmp_name'], $uploadsDir.$fileName)) {
//         echo "There was an error uploading the file.";
//         exit();
//     }
//     $insertData = $conn->query("INSERT into `emp_leave`(`uid`,`reason`,`sdate`,`edate`,`path`) values('$uid','$textarea','$sdate','$edate','$fileName')");
//     header('Location : http://localhost/project/leave_form.php');
// }
// else{
    
//     $insertData = $conn->query("INSERT into `emp_leave`(`uid`,`reason`,`sdate`,`edate`) values('$uid','$textarea','$sdate','$edate')");
//     header('Location : http://localhost/project/leave_form.php');
// }
    $insertData = $conn->query("INSERT into `emp_leave`(`uid`,`reason`,`sdate`,`edate`) values('$uid','$textarea','$sdate','$edate')");



}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    
    <!-- <script type="text/javascript">
         
         function validate(){
        alert("Hii in the function");
        var sDate = new Date(document.form.sdate.value);
        var eDate = new Date(document.form.edate.value);
        <?php
            $sd = $connPDO->prepare("SELECT `sdate`,`edate` from `emp_leave` where `uid` = $uid order by `id`desc limit 1");
            $sd->execute();
            $r = $sd->fetchAll(PDO::FETCH_ASSOC);
        ?>

        var dbSDate = new Date("<?php echo $r[0]['sdate'] ?>");
        var dbEDate = new Date("<?php echo $r[0]['edate'] ?>");

        if((sDate >= dbSDate && sDate <= dbEDate) || (eDate >= dbSDate && eDate <= dbEDate)){  
            alert("Select some other date..");  
            return false;  
        }  
    }

      </script> -->

<style>   
   
  label {    
    padding: 12px 12px 11px 0;    
    display: inline-block;    
  }    
      
  input[type=submit] {    
    background-color: rgb(37, 116, 161);    
    color: white;    
    padding: 12px 20px;    
    border: none;    
    border-radius: 4px;    
    cursor: pointer;    
    float: right;    
  }    
      
  input[type=submit]:hover {    
    background-color: #45a049;    
  }    
       
   .container {    
    border-radius: 10px;    
    background-color: aliceblue;    
    padding: 20px;   
    max-width: 600px; 
  }    
  #bn{
  position: fixed;
  top:24px;
  left:1%;
  
}
 
  </style>
</head>
<body  style="background-color: lightblue ;">
<?php 
        if($role=='1')
        {
            
            echo"<a id=\"bn\" class=\"btn btn-info\" href=\"manager\\leave.php\">Back</a>";
        }
        else{
            
            echo"<a id=\"bn\" class=\"btn btn-info\" href=\"emp\\leave.php\">Back</a>";
          }
        
    ?> 
    <br>
    <center><h1>Leave Form</h1></center>
    <br>
    <div class="container">
        <form method="POST" id="myForm" >
         
        <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
        <input type="text" name="email" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $email ?>">
        </div>
        </div>

     
        <div class="mb-3">
        <label for="text" class="form-label">Reason</label>
        <textarea class="form-control" name="text" id="text" rows="3" required></textarea>
        </div>
     
        <div class="mb-3">
        <label for="text" class="form-label">Start date</label>
        <input type="date" class="form-control" name="sdate" id="sdate" rows="3" required>
        </div>

        <div class="mb-3">
        <label for="text" class="form-label">End date</label>
        <input type="date" class="form-control" name="edate"  id="edate" rows="3" required>
        </div>

        <!-- <div class="mb-3">
        <label for="formFile" class="form-label">Attach Document</label>
        <input type="file" class="form-control" name="fileDoc"  id="formFile">
        </div> -->
       
        <br>
        <div class="mb-5">
        <input type="submit" name="submit" value="submit">
        </div>
        </form>

        
        
        <script>
          
            
            // if(COUNT($r) > 0){
            //   if($r[0]['sdate'] < date('Y-m-d'))
            //   {
            //     $date = new DateTime(date('Y-m-d'));
            //     $date = $date->format('Y-m-d');
            //   }
            // }
            // else{
            //     $date = new DateTime(date('Y-m-d'));
            //     $date = $date->format('Y-m-d');
            // } 
            
              // today = 6-11
              // sdate of leave = 8-11
              // edate of leave = 10-11

              // sdate of new leave = 9-11 
              // edate of new leave = 15-11
            
            

          
            var today = new Date().toISOString().split('T')[0];
            document.getElementById("sdate").setAttribute("min", today);
            document.getElementById("edate").setAttribute("min", today);
            document.getElementById("sdate").addEventListener("change", function() {
                document.getElementById("edate").setAttribute("min", this.value);
            });
        </script>  
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>