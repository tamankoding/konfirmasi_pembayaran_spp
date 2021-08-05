<?php
include "../koneksi.php";

if (isset($_POST["id"])) {
  $output = '';
  $query = "SELECT * FROM spp_santri WHERE id = '" . $_POST["id"] . "'";
  $result = mysqli_query($mysqli, $query);
  $output .= '  
      ';
  while ($row = mysqli_fetch_array($result)) {
    $output .= '  
                     <img class="img-fluid thumbnail" src="img/' . $row["image"] . '"> 
                ';
  }
  $output .= "";
  echo $output;
}
