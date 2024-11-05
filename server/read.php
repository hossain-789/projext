<?php

include("./config.php");
$getInfo = $conn->prepare("SELECT * FROM info");
$getInfo->execute();
$infos = $getInfo->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"
    />
    <title>Registration</title>
  </head>
  <body>
<?php
echo "<br .>";

echo "<table border= '1'>";
foreach($infos as $info){
    echo "<tr>
    <td>".$info['name']."</td>
    <td>".$info['age']."</td>
    <td><button onClick='deleteItem(".$info['id'].")'>delete</button></td>
    <tr>";
}
echo "</table>";


?>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/toastify-js"
    ></script>
<script>
    
    function deleteItem(id) {
        console.log(id);  
        axios
          .post(
            "http://localhost/projext/server/delete.php",
            {
                itemid: id
            },
            {
              headers: {
                "Content-Type": "application/json",
              },
            }
          )
          .then(function (response) {
            console.log(response);
            //validation
            if (response.data.status === "success") {
              Toastify({
                text: response.data.message,
                duration: 1000,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                  background: "green",
                },
              }).showToast();

              location.reload();
            } else {
              Toastify({
                text: "Something went wrong!!",
                duration: 1000,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                style: {
                  background: "red",
                },
              }).showToast();
            }
          })
          .catch(function (error) {
            console.log(error);
          }); 
    }
</script>
</body>
</html>
