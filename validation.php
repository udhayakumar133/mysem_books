<?php
class validation
{
    function email($input)
    {
        if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $input))
            return true;
        else
            return false;
    }
    function phone_no($input)
    {
        if (!preg_match("/^[0-9]{10}$/", $input))
            return true;
        else
            return false;
    }
    function name($input)
    {
        if (!preg_match("/^.*[a-z].*[A-Z]$/i", $input))
            return true;
        else
            return false;
    }
    function description($input)
    {
        if (!preg_match("/^.*[a-zA-z0-9]$/i", $input))
            return true;
        else
            return false;
    }
    function year($input)
    {
        if (!preg_match("/^[0-9]{4}$/", $input))
            return true;
        else
            return false;
    }
    function password($input)
    {
        if (!preg_match(" /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/", $input))
            return true;
        else
            return false;
        return false;
    }

    function user_exists($email, $table_name, $conn)
    {
        $query = "SELECT count(*) FROM $table_name WHERE u_email='$email'";
        $query_result = mysqli_fetch_array(mysqli_query($conn, $query));
        if ($query_result["count(*)"] == 0)
            return true;
        else
            return false;
    }
}
