<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../config/db.php';

$app = new \Slim\App;
$app->get('/customers', function (Request $request, Response $response) {
    $db = new Database();
    $query = "select * from customers";
        $db->query($query);
        $result = $db->resultset();
        $db = null;
        echo json_encode($result);
});


$app->get('/customers/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $db = new Database();
    $query = "select * from customers where id = $id";
    $db->query($query);
    $result = $db->resultset();
    $db = null;
    echo json_encode($result);
});

$app->post('/customers/add', function (Request $request, Response $response) {
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $address = $request->getParam('address');
    $city = $request->getParam('city');
    $state = $request->getParam('state');
   
    $db = new Database();
    $query = "insert into customers (`first_name`,`last_name`,`phone`,`email`,`address`,`city`,`state`) values (:first_name,:last_name,:phone,:email,:address,:city,:state)";
    $db->query($query);

    $db->bind(':first_name', $first_name);
    $db->bind(':last_name', $last_name);
    $db->bind(':phone', $phone);
    $db->bind(':email', $email);
    $db->bind(':address', $address);
    $db->bind(':city', $city);
    $db->bind(':state', $state);
    if($db->execute()){
        echo json_encode('done');
    }
});

$app->delete('/customers/delete/{id}', function (Request $request, Response $response) {
    $db = new Database();
    $id = $request->getAttribute('id');
    $query = "delete from customers where id = $id";
    $db->query($query);
    if($db->execute()){
        echo json_encode('deleted');
    }
});

$app->put('/customers/update', function (Request $request, Response $response) {
    $id = $request->getParam('id');
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $address = $request->getParam('address');
    $city = $request->getParam('city');
    $state = $request->getParam('state');
   
    $db = new Database();
    $query = "UPDATE customers SET
				first_name 	= :first_name,
				last_name 	= :last_name,
                phone		= :phone,
                email		= :email,
                address 	= :address,
                city 		= :city,
                state		= :state
			WHERE id = $id";
    $db->query($query);
    
    $db->bind(':first_name', $first_name);
    $db->bind(':last_name', $last_name);
    $db->bind(':phone', $phone);
    $db->bind(':email', $email);
    $db->bind(':address', $address);
    $db->bind(':city', $city);
    $db->bind(':state', $state);
    if($db->execute()){
        echo json_encode('updated');
    }
});

$app->run();