<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class TestimonialsTable extends Table {

    public function initialize(array $config) {
        $this->table('testimonials');
        $this->primaryKey('id');
    }

}
