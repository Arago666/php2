<?php

namespace app\model\repositories;

use app\model\entities\Product;
use app\model\Repository;

class ProductRepository extends Repository
{
    public function getEntityClass()
    {
        return Product::class;
    }

    public function getTableName()
    {
        return "products";
    }

}