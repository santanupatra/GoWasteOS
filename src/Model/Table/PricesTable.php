<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PricesTable extends Table {

    public function initialize(array $config) {
        $this->table('prices');
        $this->primaryKey('id');

        $this->belongsTo('Services', [
            'className' => 'Services',
            'foreignKey' => 'service_id'
        ]);
        $this->belongsTo('Cities', [
            'className' => 'Cities',
            'foreignKey' => 'city_id'
        ]);
    
    }




}
