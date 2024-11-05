<?php


include("./config.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $getInfo = $conn->prepare("SELECT * FROM info where id='$id'");
    $getInfo->execute();

    $infos = $getInfo->fetchAll();
    $name = $infos[0]['name'];
    $age = $infos[0]['age'];
}


?>
<form action="" method="post">
    <input type="text" value="<?php echo $name; ?>" name="name" />
    <br /><br />
    <input type="text" value="<?php echo $age; ?>" name="age" />
    <br /><br />
    <button type="submit" name="update" value="<?php echo $id; ?>">Update Student Data</button>
</form>

<?php
if(isset($_POST['update'])){
    $id=$_POST['update'];
    $name=$_POST['name'];
    $age=$_POST['age'];
$updateInfo = $conn->prepare("update info set name='$name', age='$age' where id='$id'");

if($updateInfo->execute()){
    header("location:delete_edit.php");
}else{
    echo "update failed";
}

}



?>


