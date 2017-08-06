<?php

include("db.php");

$query = "SELECT * FROM cars";
$show_all_cars = queryToDB($query);

if (!$show_all_cars) {
    die("no cars found " . mysqli_error($show_all_cars));
}

while ($row = mysqli_fetch_array($show_all_cars)) {

    ?>

<tr>

    <td><?php echo $row['id']?></td>
    <td><a rel="<?php echo $row['id']?>" class="title-link" href="javascript:void(0)"><?php echo $row['car']?></a></td>

</tr>

    <?php

}
?>

<script>

    $(document).ready(function() {

        $(".title-link").on('click', function(){

            $("#action-container").show();

            var id = $(this).attr("rel");

            $.post("process.php", {id:id}, function(data){

                $("#action-container").html(data);

            });

        });

    });

</script>
