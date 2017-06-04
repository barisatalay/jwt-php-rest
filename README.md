# jwt-php-rest
PHP Rest Api with JWT (Beginner level :))

P.S.: With Slim Framework v2

## JWT
For information about JWT visit here: https://jwt.io/

## Database Config
Database configuration defination in "DatabaseConfig.ini" for mysql.


## Usage
Example usage is in "controller\User.php"

If you want check "Json Web Token" must be add 'authenticate' property and 

send with header "Authorization: Bearer '...token...' "
```php
$app->post('/GetStore','authenticate', function() {});
```

If you do not want check "Json Web Token" use like this
```php
$app->post('/Login',function() {});
```


Sample get to JSON Web Token (JWT)
```php
$app->post('/Login', function() {
	global $app;
    if($app->getResponse()->getStatus() === false) exit;
        
    $user = R::getRow( 'Select * from user where userName=? and password=? and active=1 ',[ $app->getRequest()->userName, $app->getRequest()->password]);
    $data = new stdClass();
    
    if ($user === NULL || sizeof($user) == 0){
        $app->getResponse()->setStatus(false);
        $app->getResponse()->setDescription(Constant::$err_user_not_found);
    }else{
        /*
         * Token Data Example
         */
        $tokenData = array(
            "userId" => $user["recID"],
            "userName" => $user["userName"],
            "crtDate" => date(Constant::$format_datetime, time())
        );
        
        $data->token = $app->getTokenManager()->createToken($tokenData);
        
        $app->getResponse()->setData($data);
    }
    echo $app->toJson(200); 
});
```

##Contact me

 If you have a better idea or way on this project, please let me know, thanks :)

[Email](mailto:b.atalay07@hotmail.com)

[My Blog](http://brsatalay.blogspot.com.tr)

[My Linkedin](http://linkedin.com/in/barisatalay07/)
