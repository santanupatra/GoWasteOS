<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class BannersTable extends Table {

    public function initialize(array $config) {
        $this->table('banners');
        $this->primaryKey('id');
    }

}
