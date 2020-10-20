<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class BookingsTable extends Table {

    public function initialize(array $config) {
        $this->table('bookings');
        $this->primaryKey('id');


        // $this->hasMany('ProductImages', [
        // 	'foreignKey'=>'productId'
        // ]);

        // In a table's initialize() method.
        // $this->addBehavior('Products', [
        //     'implementedMethods' => [
        //         'superSlug' => 'slug',
        //     ]
        // ]);
    }


    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Users',
            'foreignKey' => 'customer_id'
        ),
        'Provider' => array(
            'className' => 'Users',
            'foreignKey' => 'service_provider_id'
        ),
        'City' => array(
            'className' => 'Cities',
            'foreignKey' => 'service_provided_city_id'
        ),
        'Service' => array(
            'className' => 'Services',
            'foreignKey' => 'service_id'
        )
    );


    public $hasOne = array(
        'Payment' => array(
            'className' => 'Payments',
            //'conditions' => array('Profile.published' => '1'),
            'dependent' => true
        )
    );

}
