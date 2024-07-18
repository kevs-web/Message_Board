<?php

App::uses('Model', 'Model');


class Message extends AppModel {
    public $useTable = 'messages';

    public $belongsTo = array(
        'Sender' => array(
            'className' => 'User',
            'foreignKey' => 'sender_id'
        ),
        'Receiver' => array(
            'className' => 'User',
            'foreignKey' => 'receiver_id'
        )
    );



}