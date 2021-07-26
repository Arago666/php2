<?php
include realpath("../config/config.php");
include realpath("../engine/Autoload.php");
use app\model\{Product, User};
use app\engine\Render;

spl_autoload_register([new Autoload(), 'loadClass']);
//require_once '/path/to/vendor/autoload.php';

//$product =  Product::getOne(1);
//var_dump($product);
//$product->name = "Пицца876";
////$product->price = 888;
//$product->save();
//var_dump($product);


//http://php2/php2/public/ ?c=product & a=catalog
$url = explode('/',$_SERVER['REQUEST_URI']);

$controllerName = $url[2]?:'product';
$actionName = $url[3];
//$controllerName = $_GET['c'] ?: 'product';
//$actionName = $_GET['a'];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

//var_dump($controllerClass);

if(class_exists($controllerClass)){
    $controller = new $controllerClass(New Render());
    $controller->runAction($actionName);
} else {
    die("Контроллер не существует.");
}



//Запрос к бд
//$db = new Db();
//$id=1;
//$result = $db->getConnection()->prepare("SELECT * FROM `users` WHERE `id`=:id ");
//$result->bindParam(':id', $id, \PDO::PARAM_INT);
//$result->execute(['id'=>$id]);
//var_dump($result->fetchAll());

//
//$id=2;

//var_dump($db->queryOne("SELECT * FROM `users` WHERE `id`=:id", ['id'=> $id]));

//insert
//$product = new Product('Чай','Цейлонский','123');
//$product->save();
//$product = Product::getOne(2);
//$product->description = "Измененное значение апельсинки";
//$product->price = 999;
//$product->update();
////var_dump(get_class_methods($product));
//var_dump($product);
//
///** @var Product $product */
//$product = Product::getOne(1);
//var_dump($product);
//var_dump($product->insert());


//var_dump(get_class_methods($product->getOne($id)));
//var_dump($product);


//$product = new Product(new Db());

//$product = new Product("Чай", "Цейлонский", 123);
//
//$product->insert();
//
//var_dump($product);
//var_dump(get_class_methods($product));