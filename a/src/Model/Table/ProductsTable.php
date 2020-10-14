<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ProductsTable extends Table {

    public function initialize(array $config) {
        $this->table('products');
        $this->primaryKey('id');

        $this->hasMany('ProductImages', [
        	'foreignKey'=>'productId'
        ]);

        // In a table's initialize() method.
        $this->addBehavior('Products', [
            'implementedMethods' => [
                'superSlug' => 'slug',
            ]
        ]);
    }

}
