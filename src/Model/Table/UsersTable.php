<?php

namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Table;
use Cake\Event\Event;
use ArrayObject;

class UsersTable extends Table {

    public function initialize(array $config) {
        $this->table('users');
        $this->primaryKey('id');  
        $this->belongsTo('Cities', [
            'foreignKey'=>'city_id'
        ]);
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options) {
    }

    public function beforeSave(Event $event) {
        $entity = $event->data['entity'];
        
        if ($entity->isNew()) {
            $hasher = new DefaultPasswordHasher();
        }
        return true;


    }

}
