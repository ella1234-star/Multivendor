<?php
include('head.php');
?>

<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admin Page</title>
<style>
    .tbl1{
        padding:50px;
        border-radius:100px;
    }
</style>
</head>
<br><br><br>
<center><h1>Welcome Back Admin</h1></center>
    <?php
    include('connection.php');
    $query = "SELECT *FROM register WHERE Type != 'Admin'";
    $result= mysqli_query($con , $query);
    echo " ";
    echo "<h1>Registration table</h1>";
    echo "<form method='post'>";
    echo "<table border='1' width='70%'>";
    echo " <tr>
                <td></td><td><b>Email</b></td><td><b>IDUQ</b></td><td><b>Name</b></td><td><b>Company Name</b></td><td><b>Status</b></td>
    ";
    $i = 1;
    $idArray = array();
    if($result){
        
        while($row = mysqli_fetch_array($result)){
            $idArray[$i] = $row[1];

            if($row[11] == 'pending'){
            echo "<tr>";
            echo "<td>".$i."</td><td>". $row[4]. "</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[9]."</td><td>".$row[11]."</td>"."<td><center><button name='uploadBtn' value='".$i."'>Update</button></center></td>";
            echo "</tr>";
            }else{
                echo "<tr>";
                echo "<td>".$i."</td><td>". $row[4]. "</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[9]."</td><td>".$row[11]."</td><td></td>";
                echo "</tr>";
            }
            $i++;
        }
    }
    echo " ";
    echo "</table></form><br><br>";
    ?>

<?php
if(isset($_POST['uploadBtn'])){
    $indexID = $_POST['uploadBtn'];
    $num = $idArray[$indexID];
$insert ="UPDATE `register` SET `STATUS`='OK' WHERE IDUQ = $num";
$query = mysqli_query($con , $insert);
if ($query){
    echo "<script>alert('Successfully Update')</script>";
 }
}
?>
<h2</h2>
        <?php
        echo "<h2>Product Table</h2>";

            $query = "SELECT *FROM product"; // WHERE STATUS = 'pending'";
            $result= mysqli_query($con , $query);
            $i = 1;
            $k = 1;
            $idArray2 = array();
            $idArray3 = array();

            echo "<br><br> ";
            echo "<form method='post'>";
            echo "<table border='1' width='70%'>";
            echo " <tr>
                        <td>Auto ID</td>
                        <td><b>ID</b></td>
                        <td><b>VendorID</b></td>
                        <td><b>Image</b></td>
                        <td><b>Description</b></td>
                        <td><b>Category</b></td>
                        <td><b>Priority</b></td>
                        <td><b>Status</b></td>
            ";
            if($result){

                while($row = mysqli_fetch_array($result)){
                    
                    $idArray2[$i] = $row[1];
                    $idArray3[$k]= $row[0];
                    if($row[6] == 'pending'){
                       
                        //  echo "<table border='1'>";
                          echo "<tr>";
                          echo "<td>".$i."</td><td>". $row[0]. "</td><td>".$row[1]."</td><td><img src='images/".$row[2]."' style='width: 100px; height: 100px;'></td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td>"."<td><b>".$row[6]."</b></td><td><center><button name='uploadBtn2' value='".$i."'>Update Status</button><br><button name='cancelBtn' value='". $row[0]."' id ='".$row[0]."'>Cancel Priotity Request</button></center></td>";
                          echo "</tr>";
                  
                        //  echo "</table>";
                          }
                          /*else{
                              echo "<tr>";
                              echo "<td>".$i."</td><td>". $row[0]. "</td><td>".$row[1]."</td><td><img src='images/".$row[2]."' style='width: 100px; height: 100px;'></td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td></td>";
                              echo "</tr>";
                          }*/
                   
                          $i++;
                    $k++;
                }
                $mesage1 = "Johnson";
                $mesage2 = "Oloko";

                $All = $mesage1.$mesage2;
               // $a = $mesage1 + $mesage2;
               // echo "<script>alert('$All')</script>";
                foreach( $idArray3  as $digit){
                //    echo "<script>alert('$digit')</script>";
                }
            }

            if(isset($_POST['uploadBtn2'])){
                $indexID2 = $_POST['uploadBtn2'];
                $num1 = $idArray2[$indexID2];
                $num2 = $idArray3[$indexID2];
               // echo $num;
                $insert ="UPDATE `product` SET `STATUS`='OK' WHERE vID = $num1 AND `ID` = $num2 ";
                
                $query = mysqli_query($con , $insert);
                
                if ($query){
                    echo "<script>alert('Successfully Update  $num2 ')</script>";
                }

               

                $stmt = "INSERT INTO `notification`(`vendorID`, `status`) VALUES ('$num1','<b>post</b> was successful', )";

                $query = mysqli_query($con , $stmt);

            }

            if(isset($_POST['cancelBtn'])){
                $indexID3 = $_POST['cancelBtn'];
              //  $num1 = $idArray2[$indexID3];
               // echo $num;
                $insert ="UPDATE `product` SET `priority` = 'NO' WHERE `product`.`ID` = ".$indexID3 ."";

                if(mysqli_query($con , $insert)){
                    $sql ="SELECT  `vID` FROM `product` WHERE `product`.`ID` = ".$indexID3 ."";
                   if(mysqli_query($con , $sql)){
                       $row = mysqli_fetch_row(mysqli_query($con , $sql));
                      // 
                       $var = $row[0];
                     $stmt = "INSERT INTO `notification`(`vendorID`, `status`) VALUES ('$var','<b>Priority Ad</b> not approved')";
                     if(mysqli_query($con , $stmt)){
                        echo "<script>alert('priority ad changed.');
                        var btn = document.getElementById('". $indexID3 ."');
                        btn.disabled=true; 
                        </script>";
                     }
                   }
                }

                
            }


        ?>

        <?php
        $query = "SELECT *FROM events"; // WHERE STATUS = 'pending'";
        $result= mysqli_query($con , $query);
        $i = 1;
        $k = 1;
        $idArray4 = array();
        $idArray5 = array();

        echo "<br><br> ";
        echo "<form method='post'>";
        echo "<table border='1' width='70%'>";
        echo " <tr>
                    <td>AutoID</td>
                    <td><b>ID</b></td>
                    <td><b>VendorID</b></td>
                    <td><b>Date</b></td>
                    <td><b>Location</b></td>
                    <td><b>Description</b></td>
                    <td><b>Image url</b></td>
                    <td><b>Status</b></td>
        ";
        if($result){
            while($row = mysqli_fetch_array($result)){
                    
                $idArray4[$i] = $row[1];
                $idArray5[$k]= $row[0];
                if($row[6] == 'pending'){
                
                    echo "<tr>";
                    echo "<td>".$i."</td><td>". $row[0]. "</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td> <img src='images/".$row[5]."' style='width: 100px; height: 100px;'></td>"."<td><b>".$row[6]."</b></td><td><center><button name='uploadBtn22' value='".$i."'>Update Status</button><br><button name='cancelBtn1' value='". $row[0]."' id ='".$row[0]."'>Cancel Request</button></center></td>";
                    echo "</tr>";
            
                    }
                   $i++;
             $k++;
            }
    
        }
        echo "<br><br></br>";

    
        if(isset($_POST['uploadBtn22'])){
            $indexID2 = $_POST['uploadBtn22'];
            $num1 = $idArray5[$indexID2];
            $num2 = $idArray4[$indexID2];
   
         
                echo "<script>alert('Successfully Update   $num2  <<<>>>  $num1')</script>";

                $insert ="UPDATE `events` SET `status`='OK' WHERE vendorID = $num2 AND `ID` = $num1 ";
                
                $query = mysqli_query($con , $insert);
                
                if ($query){
                    echo "<script>alert('Successfully Update ')</script>";
                }
               
        
          $stmt = "INSERT INTO `notification`(`vendorID`, `status`) VALUES ('$num1','<b>YOUR EVENT</b> Has been approved successful' )";

           $query1 = mysqli_query($con , $stmt);

        }


//for cancel

if(isset($_POST['cancelBtn1'])){
    $indexID3 = $_POST['cancelBtn1'];
    // $num1 = $idArray4[$indexID3];
   // echo $num;

  // echo "<script>alert(' $indexID3')</script>";



  $query ="SELECT `vendorID` FROM `events` WHERE `ID` = ".$indexID3 ."";
  if(mysqli_query($con , $query)){
      $row = mysqli_fetch_row(mysqli_query($con, $query));

      $var = $row['vendorID'];


      $query2 = "INSERT INTO `notification`(`vendorID`, `status`) VALUES ('$var','<b>Event Not approve</b> not approved')";

     $res = mysqli_query($con, $query2);

     if($res){
        $del ="DELETE FROM `events` WHERE `ID` = ".$indexID3 ."";
        $res1 = mysqli_query($con, $del);

        if($res1){
            echo "<script>alert('Record Delete $indexID3 ,.....,  $num1')</script>";
        }
     }
      

  }



   // 

}


    


        ?>
<h1>Event table</h1>

</body>