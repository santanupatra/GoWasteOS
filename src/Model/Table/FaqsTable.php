<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FaqsTable extends Table {

    public function initialize(array $config) {
        $this->table('faqs');
        $this->primaryKey('id');
    }

}
