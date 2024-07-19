<?php

App::uses('AppModel', 'Model');

class UserDetail extends AppModel {
    public $actsAs = array('Containable');
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        ),
    );
    
    public $name = 'UserDetail';

    public $validate = array(
        'name' => array(
            'between' => array(
                'rule' => array('between', 5, 20),
                'message' => 'Name must be between 5 and 20 characters long'
            ),
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Name is required',
            ),
        ),
        'profile' => array(
            'rule' => array('extension', array('gif','jpeg','jpg','png')),
            'message' => 'Please upload a valid image file234',
        )
    );

    //Check if the profile column in empty (null) and replace it to avatar.jpg
    public function afterFind($results, $primary = false) {
        foreach ($results as &$result) {
            if (empty($result[$this->alias]['profile'])) {
                // Set default profile data
                $result[$this->alias]['profile'] = 'avatar.jpg';
            }
        }
        return $results;
    }
}


?>