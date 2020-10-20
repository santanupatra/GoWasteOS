<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ReviewsTable extends Table {

    public function initialize(array $config) {
        $this->table('reviews');
        $this->primaryKey('id');

        $this->belongsTo('Reviewds', [
            'className' => 'Users',
            'foreignKey' => 'to_id'
        ]);
        $this->belongsTo('Reviewers', [
            'className' => 'Users',
            'foreignKey' => 'from_id'
        ]);

    
    }




}
