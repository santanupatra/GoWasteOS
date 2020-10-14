<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ContactUsTable extends Table {

    public function initialize(array $config) {
        $this->table('contact_us');
        $this->primaryKey('id');
    }

}
