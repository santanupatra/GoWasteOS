<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ProductImagesTable extends Table {

    public function initialize(array $config) {
        $this->table('product_images');
        $this->primaryKey('id');
    }

}
