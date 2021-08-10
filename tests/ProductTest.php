<?php


namespace app\tests;


use app\model\entities\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProduct(){
        $name = "Чай";
        $product = new Product($name, "Китайский", 22);

        $this->assertEquals($name, $product->name);
    }

    public function testProductNamespace(){
        //if(strpos(Product::class),"app\\")===0)
//        if(array_slice(explode('\\', get_class(new Models),1,1)) === ["model"]);
//        if(substr_count(Product::class, '\\') === 3)

    }

}