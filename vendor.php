<?php
include('head.php');
include('connection.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<title>Vendor Page</title>
<style>
    .notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

.notification:hover {
  background: red;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
#notify{
    display: none;
}
</style>
</head>
<script>
    document.getElementById('logoutBtn').style.display = 'block';
</script>
<body>
<br><br><br>
<center><h1>Vendor Page</h1></center>
<?php //echo $_SESSION['loginE'];
    $msg ="";
    if(isset($_POST['upload'])){
        //the path to store the uploaded image
        $target = "images/".basename($_FILES['image']['name']);
        include('connection.php');

        //get all submitted data from the form
        $image = $_FILES['image']['name'];

        $text = $_POST['text'];
       $category = $_POST["cat"];
        $SessionID = $_SESSION['loginE'];

        $prio = $_POST['pio'];
        $useDate = $_POST['dateVal'];

        if(!empty($useDate)){
            echo  "<script>alert('Yes we have something  $useDate')</script>";
        }else{
            die();
        }
        $sql = "INSERT INTO `product`(`vID`, `ImgURL`, `DESCRIPTION`, `CAT`, `priority`, `STATUS`,`Date`) 
        VALUES ('$SessionID','$image','$text','$category', '$prio', 'pending','$useDate')";
       
        mysqli_query($con,$sql);
        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            echo  "<script>alert('Image uploaded successfully')</script>";
            echo  "<script>alert('Please Wait for Admin to Approve your post.... We will be with you soon')</script>";
        }else{
           echo  "<script>alert('Image Not uploaded successfully')</script>";
        }

    }
?>
<center>
<form method="POST" enctype="multipart/form-data"> 
        <input type="hidden" name = "size" value="1000000">
        <input type="file" name="image">
        <textarea name="text" cols="40" rows="4" placeholder="Say something about this image..."></textarea>
<br>
        <select name="cat" >
					<option selected>Select Category</option>
                    <option><---Sales and Deals---></option>
					<option>Clothes & Shoes</option>
					<option>Wholesalers</option>
                    <option>Electronic</option>
                    <option>Exclusive</option>
                    <option>Grocers</option>
                    <option>Liquor</option>
                    <option>Sport</option>
                    <option>Baby & Kids</option>
                    <option>Bank</option>
                    <option>Pharmacy</option>
                    <option>House & Home</option>
                    <option>Cars & Spares</option>
                    <option>Garage</option>
                    <option>Books</option>
                    <option>Travel</option>
                    <option><---Ends---></option>
                    <option>Food and Restaurants</option>
                    <option>Fast Foods</option>
                    <option>Dine In</option>
                    <option>etc</option>

		</select required>

        <select name="pio">
					<option selected>Select Priority Aids</option>
					<option>YES</option>
					<option>NO</option>
		</select required><br>
      
<lable>From : Today</lable><br><label>Chosee your end date</label><input id="inDate" name="dateVal" type="date" style="background-color: white;"required/><br>
        <input type="submit" name="upload" value="Upload Image"> 

    
</form>

<form method='post' id="notify" >
    <table border="1" style="padding: 20px;"  >
    <tr>
    <th>ID</th><th>vendorID</th><th>Status</th><th>Seen</th><th>Date</th>
    </tr>

    <?php
    $query = "SELECT *FROM `notification` WHERE `vendorID` = ".$_COOKIE['userID']." ";

    $stmt = mysqli_query($con , $query);

    while($row = mysqli_fetch_array($stmt)){
        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td><button name='UpdateSeen' value='".$row[0]."'>Update</button></td><td>".$row[4]."</td></tr>";
    }
    ?>

    </table>
</form>
<?php
        $sql = "SELECT * FROM `notification` WHERE `vendorID` = ".$_COOKIE['userID']."";
        $result =mysqli_query($con,$sql);
        if($result){
            $i = 0;
            while(mysqli_fetch_array($result)){
                $i++;
            }
        }

        if(isset($_POST['UpdateSeen'])){
               
                $sql = "DELETE FROM `notification` WHERE `id` = ".$_POST['UpdateSeen']."";
                mysqli_query($con,$sql);
                echo "<script>alert('Seen!'); window.location = window.location;</script>";
        }
?>

<a href="#" id="btnNotify" class="notification">
  <span id="btnNotify">Inbox</span>
  <span class="badge" ><?php echo $i; ?></span>
</a>
<script>
    var btn = document.getElementById('btnNotify');
    btn.onclick = function(){
        var buttonN = document.getElementById('notify');
        buttonN.style.display = "block";
    }
</script>
</center>


<br>
<br>
<br>
<br>
<br>
<br>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
                <h2>Post Event</h2>
           
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">

                    <label>Date</label>
                    <input type="date" name="date" class="form-control">  
                </div> 
                <br>                       

                <div class="form-group">
                    <label>Location</label>
                    <select name="location" class="form-control">
					<option selected>Select Location Below</option>
					<option>KwaZulu-Natal</option>
					<option>Eastern Cape</option>
                    <option>Free State</option>
                    <option>Guateng</option>
                    <option>Western Cape</option>
                    <option>Limpopo</option>
                    <option>Mpumalanga</option>
                    <option>Nothern Cape</option>
                    <option>North West</option>
		</select required>

                </div>
                <br>
              

                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
               <br>
                <input type="submit" class="btn btn-primary" name="upload_event" value="UPLOAD_EVENT">
            </form>
        </div>
    </div>        
</div>
<?php


?>


    <?php


    if(isset($_POST['upload_event']))
    {    
        $vendoID =  $_SESSION['loginE'];

        $date_event = $_POST['date'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $image=$_FILES['image']['name'];


        $target = "images/".basename($_FILES['image']['name']);

        $query = "INSERT INTO `events`(`vendorID`, `Date`, `Location`, `Description`, `Image_url`, `status`) VALUES ('$vendoID','$date_event','$location','$description', '$image', 'pending')";
        $results=mysqli_query($con,$query);
        if ($results) {
            move_uploaded_file($_FILES['image']['tmp_name'],$target);
        echo "<script> alert('Event Successfully made inserted successfully..... !')</script>";
        echo "<script> alert('Please Wait for the Admin to Approve your Event ')</script>";

       // echo "<script>window.open('eventDemo.php' , '_self')</script>";
        } 
        else {
            echo "Not inserted";
        }
    
        echo $vendoID;

    }
    ?>
</body>
</html>



</body>