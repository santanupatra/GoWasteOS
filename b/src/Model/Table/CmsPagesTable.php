<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class CmsPagesTable extends Table {

    public function initialize(array $config) {
        $this->table('cms_pages');
        $this->primaryKey('id');
    }

}
