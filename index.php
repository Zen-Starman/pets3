<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file autoload.php
require_once('vendor/autoload.php');

//Create an instance of the Base class/ instantiate Fat-Free
$f3 = Base::instance();
$f3->set('colors', ['pink', 'green', 'blue']);


//Turn on Fat-free error reporting/Debugging
$f3->set('DEBUG',3);

//Define a default route (use backlash / )
$f3->route('GET /', function()
{
    //Display a view-set view as new template and echo out the view
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a route with a parameter
$f3->route('GET /@animal', function($f3, $params) {
    $animal = $params['animal'];

        switch ($animal) {
            case 'dog':
                echo "<h3>Woof!</h3>";
                break;
            case 'cat':
                echo "<h3>Meow</h3>";
                break;
            case 'pig':
                echo "<h3>Oink</h3>";
                break;
            case 'bear':
                echo "<h3>Grrr</h3>";
                break;
            case 'bird':
                echo "<h3>Hello</h3>";
                break;
            default:
                $f3->error(404);
        }
});

$f3->route('GET /order', function() {
    $view = new Template();
    echo $view->render('views/form1.html');
});

$f3->route('GET /order2', function() {
    $template = new Template();
    echo $template->render('views/form2.html');
});

//Run fat free F3
$f3->run();
