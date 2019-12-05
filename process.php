<?php

include("db.php");

/*** Displaying Action Box data *****/

if (isset($_POST['id'])) {

   $id = mysqli_real_escape_string($connection, $_POST['id']);
   

$query = "SELECT * FROM cars WHERE id = {$id}";
$query_car_info = mysqli_query($connection, $query);

if (!$query_car_info) {
   die("Query Failed" . mysqli_error($connection));
}


while($row = mysqli_fetch_array($query_car_info)){

    echo '<p id="feedback" class="bg-success"></p>';
    echo "<input rel='".$row['id']."' type='text' value='".$row['title']."' class='form-control title-input'>";
    echo "<input type='button' class='btn btn-success update' value='Update'>";
    echo "<input type='button' class='btn btn-danger delete' value='Delete'>";
    echo "<input type='button' class='btn btn-close' value='close'>";

   

    }

}

/*** Updating Action Box data *****/

if (isset($_POST['updatethis'])) {

    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
   

   $id = $_POST['id'];
   $title = $_POST['title'];

   $query = "UPDATE cars SET title='$title' WHERE id = $id";
   $result_set = mysqli_query($connection, $query);

   if(!result_set){
       die("query failed". mysqli_error($connection));
   }
}

/*** Delete Action Box data *****/

if (isset($_POST['deletethis'])) {

    $id = mysqli_real_escape_string($connection, $_POST['id']);
   
   

   $id = $_POST['id'];
   

   $query = "DELETE from cars WHERE id = $id";
   $result_set = mysqli_query($connection, $query);

   if(!result_set){
       die("query failed". mysqli_error($connection));
   }
}




?>



<script>
$(document).ready(function(){

var id;
var title;
var updatethis = "update";
var deletethis = "delete";

/****Extract id and Title *******/
 
 $(".title-input").on('input', function () {

    id = $(this).attr('rel');
    title = $(this).val();

});

/********Update Button Functionality */

$(".update").on('click', function () {

    $.post("process.php", {id: id, title: title, updatethis: updatethis}, function(data) {

        $("#feedback").text("Record Updated Successfully"); 
        
    })
    
});

/********Delete Button Functionality */

$(".delete").on('click', function(){

    if (confirm('Are you Sure you want to delete this?')) {
        
   

    id = $(".title-input").attr('rel');

$.post("process.php", {id: id, deletethis: deletethis}, function(data) {

    
    $("#action-container").hide();

  
    
});

}

});

/** Close Button */

$(".btn-close").on('click', function(){

    $("#action-container").hide();

});



});// document ready end






</script>