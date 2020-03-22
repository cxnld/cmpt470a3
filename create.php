<?php
require_once "config.php";
$name = "";
$email = "";
$age = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    $sql = "INSERT INTO users (name, email, age) VALUES (?, ?, ?)";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_age);

        $param_name = $name;
        $param_email = $email;
        $param_age = $age;

        if(mysqli_stmt_execute($stmt)){
            header("location: practice2.php");
            exit();
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
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
            <h2>Create User</h2>
        </div>

        <div class='seg'>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
                </br>

                <label>Email</label>
                <input type="text" name="email" value="<?php echo $email; ?>">
                </br>

                <label>Age</label>
                <input type="text" name="age" value="<?php echo $age; ?>">
                </br>
                <input type="submit" class="button" value="Submit">
            </form>

        </div>
    </div>
</body>
</html>
