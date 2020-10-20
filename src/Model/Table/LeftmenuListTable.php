<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class LeftmenuListTable extends Table {

    public function initialize(array $config) {
        $this->table('leftmenu_list');
        $this->primaryKey('id');
    }

}
