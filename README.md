# jwt-php-rest
PHP Rest Api with JWT (Beginner level :))

P.S.: With Slim Framework v2


## Usage
Example usage is in User.php

##Header
If you want check "Json Web Token" must be add 'authenticate' property
```groovy
$app->post('/GetStore','authenticate', function() {});
```

If you do not want check "Json Web Token" use like this
```groovy
$app->post('/Login',function() {});
```
