<?php
session_start();
include("logincheck.php");
require 'connect.php';

$id  = $_GET['id']; //ID of exhibit to delete

//QUERIES TO MAKE
//1 DELETE ALL ENTRIES IN ARTISTS_EXHIBITS THAT HAVE EXHIBIT ID OF $ID
//2 DELETE ALL ENTRIES IN CATEGORY_EXHIBITS THAT HAVE EXHIBIT ID OF $ID
//3 DELETE ALL EXHIBITS IN EXHIBITS THAT HAVE EXHIBIT ID OF $ID
//4 DELETE ALL FILES IN FILES THAT HAVE EXHIBIT_ID OF $ID (AND UNSET FROM SERVER)
//5 DELETE ALL IMAGES FROM IMAGES THAT HAVE EXHIBIT ID OF $ID

$CHECKBRIDGETABLE = "SELECT COUNT(ID) FROM ARTISTS_EXHIBITS WHERE ARTIST_ID = $id";
$REMOVEQUERY_ARTISTS = "DELETE FROM ARTISTS WHERE ID = $id";






   $query_tvp = "SELECT COUNT(ID) as total FROM ARTISTS_EXHIBITS WHERE ARTIST_ID = $id";
   if ($result_tvp = $mysqli->query("$query_tvp")) {

        $total_tvp = $result_tvp->fetch_row();
        $total_tvp = $total_tvp['0'];
        /* close result set */
        $result_tvp->close();
    }




if($total_tvp >= 1) {
$_SESSION['FAILED'] = true;
header("Location: ../../pages/artisttables.php");
} else {


$GETFILES = "SELECT * FROM ARTISTS WHERE ID = $id";
$DELETERESULT = mysqli_query($mysqli, $GETFILES);

while ($row = mysqli_fetch_array($DELETERESULT)) {
  unlink($row['IMGPATH']);
}

$result1 = mysqli_query($mysqli, $REMOVEQUERY_ARTISTS);
$_SESSION['DELETE'] = true;
header("Location: ../../pages/artisttables.php");
}


 ?>
