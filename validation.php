<?php
    class validation
    {
        function email($input)
        {
            if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$input))
            return true;
            else 
            return false;
        }
        function phone_no($input)
        {
            if(!preg_match("/^[0-9]{10}$/",$input))
            return true;
            else
            return false;
        }
        function name($input)
        {
            if(!preg_match("/^[a-z' -]$/i",$input))
            return true;
            else
            return false;
        }
        function year($input)
        {
            if(!preg_match("/^[0-9]{4}$/",$input))
            return true;
            else 
            return false;          
        }
        function password($input)
        {
            if(!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()])(?=\\S+$).{8, 20}$/",$input))
            return true;
            else 
            return false;          
        }
    }
?>