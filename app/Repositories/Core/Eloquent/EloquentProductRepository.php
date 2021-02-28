<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

class EloquentProductRepository extends BaseEloquentRepository implements ProductRepositoryInterface
{

    public function entity()
    {
        return Product::class;
    }

}