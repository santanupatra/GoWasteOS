<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class BookingsTable extends Table {

    public function initialize(array $config) {
        $this->table('bookings');
        $this->primaryKey('id');

        $this->belongsTo('Customers', [
            'className' => 'Users',
            'foreignKey' => 'customer_id'
        ]);
        $this->belongsTo('Providers', [
            'className' => 'Users',
            'foreignKey' => 'service_provider_id'
        ]);

        $this->belongsTo('Cities', [
            'foreignKey'=>'service_provided_city_id'
        ]);

        $this->belongsTo('Services', [
            'foreignKey'=>'service_id'
        ]);

        $this->hasOne('Payments', [
            'className' => 'Payments',
        ]);
    
    }




}
