<?php
session_start();

include_once 'actions/db_connect.php';
include_once 'actions/a_select.php';
include_once 'components/boot.php';
include_once 'components/navigation.php';


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}


if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

$query2 = "SELECT * FROM location";
$loc = mysqli_query($connect, $query2);

while ($row = mysqli_fetch_array($loc, MYSQLI_ASSOC)) {
    $options .=
        "<option value='{$row['location_id']}'>{$row['address']} - {$row['city']} - {$row['zip']}</option>";
}

$connect->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Request</title>
</head>

<body>
    <div class="container" style="width: 70%;">
        <div class="row justify-content-evenly py-5">
            <div class="mt-3 mb-3">
                <h1>Update content</h1>
                <?php echo '<div class="col-6 col-md-4 col-lg-3 my-3">
                    <div class="card">
                        <div style="background-image: url(' . $data['picture'] . '); background-repeat: no-repeat; background-size: contain; height: 350px; background-position: center;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Name: ' . $data['name'] . '</h5>
                            <p class="card-text">Description: ' . $data['description'] . '</p>
                            <p class="card-text">Age: ' . $data['age'] . '</p>
                            <p class="card-text">Location:<br>' . $data['address'] . '<br>' . $data['city'] . '<br>ZIP: ' . $data['zip'] . '</p>
                        </div>
                        <div class="card-body">
                            <a href="adopt.php?id=' . $data['animal_id'] . '" class="btn btn-outline-dark btn-sm">Take me home</a>
                            <a href="details.php?id=' . $data['animal_id'] . '" class="btn btn-outline-success mt-2 btn-sm">Read More</a>
                        </div>
                    </div>
                    </div>
                '; ?>


                <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
                    <table class='table table-dark'>
                        <tr>
                            <th>Name</th>
                            <td><input class='form-control' type="text" name="name" placeholder="Pet Name" value="<?php echo $name ?>" /></td>
                        </tr>
                        <tr>
                            <th>Picture</th>
                            <td><input class='form-control' type="url" name="picture" placeholder="Picture URL" value="<?php echo $picture ?>" /></td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td><select id="locations" name="location">
                                    <?php echo $options; ?>
                                    <option selected value="<?php echo $location_id ?>"><?php echo $address . " - " . $city . " - " . $zip ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><textarea class='form-control' type="text" name="description" placeholder="Short descrpition" rows="5"><?php echo $description ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Hobbies</th>
                            <td><textarea class='form-control' type="text" name="hobbies" placeholder="Hobbies" rows="2"><?php echo $hobbies ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td><input class='form-control' type="number" name="age" value="<?php echo $age ?>" /></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <select id="status" name="status">
                                    <option selected value="<?php echo $status ?>">Current: <?php echo $status; ?></option>
                                    <option value="available">available</option>
                                    <option value="adopted">adopted</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td><select id="type" name="type">
                                    <option selected value="<?php echo $type ?>">Current: <?php echo $type; ?></option>
                                    <option value="small">small</option>
                                    <option value="large">large</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <input type="hidden" name="id" value="<?php echo $id ?>" />
                            <td><button class="btn btn-outline-light" type="submit">Save Changes</button>

                                <a href="home.php" class="btn btn-outline-danger">Back</a>
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </div>

</body>

</html>