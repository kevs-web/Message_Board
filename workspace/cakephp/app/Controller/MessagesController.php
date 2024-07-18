<?php
class MessagesController extends AppController {

public function message(){

    if ($this->request->is('post')) {
        $data = $this->request->data;
        $data['Message']['sender_id'] = $this->Auth->user('id');
        $fieldsToSave = ['receiver_id', 'sender_id', 'message'];
        // debug( $save);
        // exit();
        if ($this->Message->save($data, ['fieldList' => $fieldsToSave])) {
            $this->Flash->success(__('message sent'));
            return $this->redirect(['action' => 'messageDetails']);
        } else {
            $this->Flash->error(__('There was an error in sending message. Please try again.'));
        }
    }
}

        public function messageList(){   
            $messages = $this->Message->find('all', array(
                'fields' => array(
                    'Message.message',
                    'Message.receiver_id'
                ),
                'conditions' => array(  
                    'Message.sender_id' => $this->Auth->user('id'),
                ),
                // Ensure User model is included to fetch associated data
                'contain' => array(
                    'User' => array(
                        'fields' => array('User.id', 'User.name', 'User.photo')
                    )
                )
            ));

            // Array to store receiver IDs for fetching names
            $receiverIds = array();
            foreach ($messages as $message) {
                $receiverIds[] = $message['Message']['receiver_id'];
            }

            $this->loadModel('User');
            $findName = $this->User->find('all', array(
            'fields'=> array(
                'User.id',
                'User.name',
                'User.photo'
            ),
            'conditions' => array(
               'User.id' => $receiverIds,
            )
            ));
            $users = array();
            foreach ($findName as $user) {
                $users[$user['User']['id']] = $user['User']['name'];
            }
            //echo "<pre>"; print_r($findName); "</pre>";
            $this->set('users', $users);
            $this->set('messages', $messages);

        }
}
