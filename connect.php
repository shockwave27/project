<?php

$dbname = "nimbus_island";
$conn = mysqli_connect("localhost", "root", "", $dbname);

// Check connection
if (!$conn) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

function select_data($sql)
{
    global $conn;
    $res = mysqli_query($conn, $sql);
    if ($res)
        return $res;
    else
        return false;
}

function insert_data($sql)
{
    global $conn;
    $res = mysqli_query($conn, $sql);
    if ($res) {
        return true;
    } else {
        return false;
    }
}

function update_data($sql)
{
    global $conn;
    $res = mysqli_query($conn, $sql);
    if ($res)
        return true;
    else
        return false;
}

function count_data($sql)
{
    global $conn;
    $res = mysqli_query($conn, $sql);
    if ($res)
        return mysqli_num_rows($res);
    else
        return false;
}

// Function to get the last inserted ID (user_id)
function get_last_inserted_id()
{
    global $conn;
    return mysqli_insert_id($conn);
}

?>


