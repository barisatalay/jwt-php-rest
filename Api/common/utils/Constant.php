<?php
/*
    Creator: Barış ATALAY 27.05.2017
    Github: https://github.com/barisatalay/jwt-php-rest
*/
class Constant{
    public static $token_key = 'secret';
    public static $err_token_authorization = 'Authorization is not found';
    public static $err_token_no_found = 'Token not found';
    public static $err_token_not_valid = 'Token is not valid';
    public static $err_user_not_found = 'User not found. Please check.';
    public static $err_user_password_invalid = 'Invalid password.';
    public static $format_datetime = 'm/d/Y h:i:s a';
}
?>