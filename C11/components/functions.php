<?php
function sanitize($var)
{
    $sanitized = trim($var);
    $sanitized = strip_tags($sanitized);
    $sanitized = htmlspecialchars($sanitized);
    return $sanitized;
}


function showPet($img, $name, $description, $age, $address, $city, $zip, $id)
{
    return "<div class=\"col-6 col-md-4 col-lg-3 my-3\">
            <div class=\"card\">
                <div style='background-image: url(" . $img . "); background-repeat: no-repeat; background-size: contain; height: 350px; background-position: center;'>
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Name: " . $name . "</h5>
                    <p class=\"card-text\">Description: " . $description . "</p>
                    <p class=\"card-text\">Age: " . $age . "</p>
                    <p class=\"card-text\">Location:<br>" . $address . "<br>" . $city . "<br>ZIP: " . $zip . "</p>
                </div>
                <div class=\"card-body\">
                    <a href='adopt.php?id=" . $id . "' class='btn btn-outline-dark btn-sm'>Take me home</a>
                    <a href='details.php?id=" . $id . "' class='btn btn-outline-success mt-2 btn-sm'>Read More</a>
                </div>
            </div>
        </div>";
}

function showPetAdmin($img, $name, $description, $age, $address, $city, $zip, $id)
{
    return "<div class=\"col-6 col-md-4 col-lg-3 my-3\">
            <div class=\"card\">
                <div style='background-image: url(" . $img . "); background-repeat: no-repeat; background-size: contain; height: 350px; background-position: center;'>
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Name: " . $name . "</h5>
                    <p class=\"card-text\">Description: " . $description . "</p>
                    <p class=\"card-text\">Age: " . $age . "</p>
                    <p class=\"card-text\">Location:<br>" . $address . "<br>" . $city . "<br>ZIP: " . $zip . "</p>
                </div>
                <div class=\"card-body\">
                    <a href='adopt.php?id=" . $id . "' class='btn btn-outline-dark btn-sm'>Take me home</a>
                </div>
                <div class=\"card-body\">
                    <a href='update.php?id=" . $id . "' class='btn btn-outline-dark btn-sm'>Edit</a>
                    <a href='delete.php?id=" . $id . "' class='btn btn-outline-danger btn-sm'>Delete</a>
                </div>
            </div>
        </div>";
}

function showRows($picture, $name, $date_collected, $user_id, $status, $id)
{
    if (isset($_SESSION['user'])) {
        $row = "<tr>
            <td><img class='img-thumbnail' style='height: 150px;' src='" . $picture . "'</td>
            <td>" . $name . "</td>
            <td>" . $date_collected . "</td>
            <td>" . $user_id . "</td>
            <td>" . $status . "</td>
        </tr>";
    }

    if (isset($_SESSION['adm'])) {
        $row = "<tr>
            <td><img class='img-thumbnail' style='height: 150px;' src='" . $picture . "'</td>
            <td>" . $name . "</td>
            <td>" . $date_collected . "</td>
            <td>" . $user_id . "</td>
            <td>" . $status . "</td>
            <td><a href='takeback.php?id=" . $id . "' class='btn btn-outline-danger btn-sm'>Cancel Adoption</a></td>
        </tr>";
    }

    return $row;
}


function showUser($picture, $first_name, $last_name, $email, $status, $id)
{
    return "<div class=\"col-6 col-md-4 col-lg-3 my-3\">
            <div class=\"card\">
                <div style='background-image: url(" . $picture . "); background-repeat: no-repeat; background-size: contain; height: 350px; background-position: center;'>
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">First Name: " . $first_name . "</h5>
                    <h5 class=\"card-title\">Last Name: " . $last_name . "</h5>
                    <p class=\"card-text\">Email: " . $email . "</p>
                    <p class=\"card-text\">Status: " . $status . "</p>
                </div>
                <div class=\"card-body\">
                    <a href='users.php?id=" . $id . "' class='btn btn-outline-dark btn-sm'></a>
                </div>
            </div>
        </div>";
}
