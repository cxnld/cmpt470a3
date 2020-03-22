<!doctype html>
<html lang="en">

    <head>
        <link rel="stylesheet" href="layout.css">
        <meta charset="utf-8" />
    </head>

    <body>
        <div id=container>

            <div class="seg">
                <h3>cmpt470 - Users</h3>
            </div>

            <div class="seg">
                <a href="create.php" class="button">New User</a>
            </div>

            <?php
            require_once "config.php";

            $sql = "SELECT * FROM users";
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    echo "<div class='seg'>";
                    echo "<table border=1>";
                        // create the first row of table headers
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>ID</th>";
                                echo "<th>Name</th>";
                                echo "<th>Email</th>";
                                echo "<th>Age</th>";
                                echo "<th>Edit</th>";
                                echo "<th>Delete</th>";
                                echo "<th>Send Mail</th>";
                            echo "</tr>";
                        echo "</thead>";

                        echo "<tbody>";

                        // populate the table created above with the table from the database
                        // $row is a row in the table
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['age'] . "</td>";

                                echo "<td>";
                                    echo "<a href='update.php?id=". $row['id'] .  " ' >EDIT</a>";
                                echo "</td>";

                                echo "<td>";
                                    echo "<a href='delete.php?id=". $row['id'] .  " ' >DELETE</a>";
                                echo "</td>";

                                echo "<td>";
                                    echo "<a href=mailto:". $row['email'] .  ">SEND EMAIL</a>";
                                echo "</td>";

                            echo "</tr>";
                        }
                        echo "</tbody>";
                    echo "</table>";
                    echo "</div>";

                    mysqli_free_result($result);
                }
            }

            mysqli_close($link);
            ?>

        </div>
    </body>
</html>
