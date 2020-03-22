<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){

    require_once "config.php";

    $sql = "DELETE FROM users WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $_POST["id"];

        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
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
        <h3>Delete user?</h3>
    </div>

    <div class="seg">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
                    <input type="submit" value="Yes" class="button">
                    <a href="index.php" class="button">No</a>
        </form>
    </div>

</div>
</body>
</html>
