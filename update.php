<?php
require_once "config.php";
$name = "";
$email = "";
$age = "";


// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    // Check input errors before inserting in database
        // Prepare an update statement
    $sql = "UPDATE users SET name=?, email=?, age=? WHERE id=?";

    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_email, $param_age, $param_id);
        $param_name = $name;
        $param_email = $email;
        $param_age = $age;
        $param_id = $id;

        if(mysqli_stmt_execute($stmt)){
            header("location: index.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);

} else {

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM users WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $name = $row["name"];
                $email = $row["email"];
                $age = $row["age"];
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="layout.css">
</head>

<body>
    <div id=container>
        <div class="seg">
            <h2>Update User</h2>
        </div>

        <div class="seg">
            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                </br>

                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                </br>

                <label>Age</label>
                <input type="text" name="age" class="form-control" value="<?php echo $age; ?>">
                </br>

                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="submit" class="button" value="Go">
                <a href="index.php" class="button">Cancel</a>
            </form>
        </div>

    </div>
</body>
</html>
