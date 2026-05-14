<?php

$conn = null;

try {
    $conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "radiohead_archive",
        3305
    );
} catch (mysqli_sql_exception) {
    echo "Connection to database failed";
}

?>