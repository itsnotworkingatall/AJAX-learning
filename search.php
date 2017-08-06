<?php

include("db.php");

$search = $_POST['search'];

//echo $search;

if (!empty($search)) {

    $query = "SELECT * FROM cars WHERE car LIKE '%$search%' ";
    $searchResult = queryToDB($query);

    if (mysqli_num_rows($searchResult) <= 0) {
        echo "No results found :(";
    } else {

        while ($row = mysqli_fetch_array($searchResult)) {

            $car = $row['car'];
            ?>

            <ul class='list-unstyled'>
                <li><?php echo $car ?></li>
            </ul>

            <?php

        }
    }

}

?>
