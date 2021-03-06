<?php

include("db.php");


/*** displaying action box data ***/

if (isset($_POST['id'])) {

    $carid = $_POST['id'];
    $carid = mysqli_real_escape_string(connectToDB(), $carid);

    $query = "SELECT * FROM cars WHERE id = {$carid} ";
    $show_all_cars = queryToDB($query);

    if (!$show_all_cars) {
        die("no cars found " . mysqli_error($show_all_cars));
    }

    while ($row = mysqli_fetch_array($show_all_cars)) {

        $carName = $row['car'];
        $carId = $row['id'];

    ?>
        <p id="feedback" class="bg-success"></p>
        <div><strong>Edit "<?php echo $carName?>"</strong></div>
            <br>
            <input type="text" rel="<?php echo $carId?>" class="form-control car-title-input" value="<?php echo $carName?>">
            <br>
        <div>
            <input type="button" value="Update" class="btn btn-success update">
            <input type="button" value="Delete" class="btn btn-danger delete">
            <button type="button" value="Close" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php

    }

}

/*** updating action box data ***/

if (isset($_POST['updatethis'])) {

    $carID    = $_POST['id'];
    $carTitle = $_POST['title'];

    $carID    = mysqli_real_escape_string(connectToDB(), $carID);
    $carTitle = mysqli_real_escape_string(connectToDB(), $carTitle);

    $query = "UPDATE cars SET car = '{$carTitle}' WHERE id = {$carID} ";

    $updateCar = queryToDB($query);

}

/*** updating action box data ***/

if (isset($_POST['deletethis'])) {

    $carID = $_POST['id'];

    $carID = mysqli_real_escape_string(connectToDB(), $carID);

    $query = "DELETE FROM cars WHERE id = {$carID} ";

    $deleteCar = queryToDB($query);

}

?>

<script>

    $(document).ready(function() {

        var id;
        var title;
        var updatethis = "update";
        var deletethis = "delete";

        /***Extract ID and  car title on title editing***/

        $(".car-title-input").on('input', function(){

            id = $(this).attr('rel');
            title = $(this).val();

        });

        /*** Update button function ***/

        $(".update").on('click', function(){

            $.post("process.php", {id: id, title: title, updatethis: updatethis}, function(data){

                $("#feedback").text("Record updated successfully");
                //$("#action-container").hide();

            });

        });

        /*** delete button function ***/

        $(".delete").on('click', function(){

            if(confirm('Really delete this?')) {

                id = $(".car-title-input").attr('rel');

                $.post("process.php", {id: id, title: title, deletethis: deletethis}, function(data){

                    $("#feedback").text("Record deleted successfully");
                    $("#action-container").hide();

                });
            }

        });

        /*** Close button functon ***/

        $(".close").on('click', function(){

            $("#action-container").hide();

        });




    });

</script>
