<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file autoload.php
require_once('vendor/autoload.php');
require_once('model/validation-functions.php');

//Create an instance of the Base class/ instantiate Fat-Free
$f3 = Base::instance();
$f3->set('colors', ['pink', 'green', 'blue']);
session_start();

//Turn on Fat-free error reporting/Debugging
$f3->set('DEBUG', 3);

//Define a default route (use backlash / )
$f3->route('GET /', function()
{
    //Display a view-set view as new template and echo out the view
    $view = new Template();
    echo $view->render('views/home.html');
});

////Define a route with a parameter
//$f3->route('GET /@animal', function($f3, $params) {
//    $animal = $params['animal'];
//
//        switch ($animal) {
//            case 'dog':
//                echo "<h3>Woof!</h3>";
//                break;
//            case 'cat':
//                echo "<h3>Meow</h3>";
//                break;
//            case 'pig':
//                echo "<h3>Oink</h3>";
//                break;
//            case 'bear':
//                echo "<h3>Grrr</h3>";
//                break;
//            case 'bird':
//                echo "<h3>Hello</h3>";
//                break;
//            default:
//                $f3->error(404);
//        }
//});

$f3->route('GET|POST /order',function($f3) {
    $_SESSION = array();

    if (isset($_POST['animal'])) {
        if (validString($_POST['animal'])) {
            $_SESSION['animal'] = $_POST['animal'];
            $f3->reroute('/order2');
        } else {
            $f3->set("errors['animal']", "Please enter an animal.");
        }
    }

    $template = new Template();
    echo $template->render('views/form1.html');
});

$f3->route('GET|POST /order2', function($f3) {

    if (isset($_POST['color'])) {
        if (validColor($_POST['color'])) {
            $_SESSION['color'] = $_POST['color'];
            $f3->reroute('/results');
        } else {
            $f3->set("errors['color']", "Please choose a color.");
        }
    }

    $template = new Template();
    echo $template->render('views/form2.html');
});

$f3->route('GET|POST /results', function() {
    $_SESSION['color'] = $_POST['color'];
    $template = new Template();
    echo $template->render('views/results.html');
});

//Run fat free F3
$f3->run();
