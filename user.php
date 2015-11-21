<?php
function getUsers() {
    //fetch table rows from mysql db
    $result = mysql_query("SELECT * from user");

    //create an array
    $user_array = array();
    while($row =mysql_fetch_assoc($result))
    {
        $user_array["rows"][] = $row;
    }
    $fp = fopen('users.json', 'w');
    fwrite($fp, json_encode($user_array));
    fclose($fp);
}
?>