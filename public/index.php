<?php
require('../app/Core/Router.php');
$router=new Router();
require('../routes/api.php');
$router->dispatch();


?>