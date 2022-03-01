<?php
include 'connection.php';
$mysqli =new mysqli('localhost','root','','multivendor') or die(mysqli_error($mysqli));
$result=$mysqli->query("SELECT * FROM events") or die($mysqli->error);
?>


<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Date</th>
        <th>Location</th>
        <th>Description</th>
        <th>Event Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
        while ($row=$result->fetch_assoc()):?>
      <tr>
        <td><?php echo $row['Date'];?></td>
        <td><?php echo $row['Location'];?></td>
        <td><?php echo $row['Description'];?></td>
        <td><img src="<?php echo $row['Image_url'];?>"  height=50 width=50></img></td>
        <td>
            <a href="process.php?delete=<?php echo $row['event_ID'];?>" class="btn btn-danger">Delete</a>
        </td>
      </tr>
     
    </tbody>
    <?php endwhile; ?>
  </table>
</div>

<?php
function pre_r ($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>