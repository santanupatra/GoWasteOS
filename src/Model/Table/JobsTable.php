<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class JobsTable extends Table {

    public function initialize(array $config) {
        $this->table('jobs');
        $this->primaryKey('id');

        $this->belongsTo('Customers', [
            'className' => 'Users',
            'foreignKey' => 'customer_id'
        ]);
        $this->belongsTo('Prices', [
            'className' => 'Prices',
            'foreignKey' => 'price_id'
            //'joinTable' => 'articles_tags'
        ]);    
    }
}
