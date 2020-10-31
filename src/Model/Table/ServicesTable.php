<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ServicesTable extends Table {

    public function initialize(array $config) {
        $this->table('services');
        $this->primaryKey('id');

        // In a table's initialize() method.
        $this->addBehavior('Services', [
            'implementedMethods' => [
                'superSlug' => 'slug',
            ]
        ]);
        // $this->belongsTo('Cities', [
        //     'className' => 'Cities',
        //     'foreignKey' => 'city_id'
        // ]);
    }

}
