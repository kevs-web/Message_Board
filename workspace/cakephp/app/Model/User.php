<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class User extends AppModel {
    public $validate = array(
        'name' => array(
            'rule' => 'notBlank',
            'message' => 'Name is required'
        ),
        'name' => array(
                'rule' => array('minLength', 5),
                'message' => 'Name must be at least 5 characters long'
        ),
        'name' => array(
            'rule' => array('maxLength', 20),
            'message' => 'Name must not exceed 20 characters'
        ),
        'email' => array(
            'rule' => 'isUnique',
            'message' => 'Email already used'
        ),
        'password' => array(
            'rule' => 'notBlank',
            'message' => 'Password is required'
        ),
        'confirm_password' => array(
            'rule' => 'confirmPasswordMatch',
            'message' => 'Passwords do not match'
        ),
    );
    public $hasMany = array(
        'SentMessages' => array(
            'className' => 'Message',
            'foreignKey' => 'sender_id',
            'dependent' => false
        ),
        'ReceivedMessages' => array(
            'className' => 'Message',
            'foreignKey' => 'receiver_id',
            'dependent' => false
        )
    );
    public function confirmPasswordMatch($check) {
        return $this->data[$this->alias]['password'] === $this->data[$this->alias]['confirm_password'];
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}
