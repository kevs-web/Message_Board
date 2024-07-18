<?php
class UsersController extends AppController {
    public $uses = ['User'];

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Auth');
    }

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'register');
        $this->set('currentUser', $this->Auth->user());
        // always restrict your whitelists to a per-controller basis
        // $this->Auth->allow("ajaxLogin");
    }
    public function login() {
        if ($this->request->is('post')) {
            $email = isset($this->request->data['User']['email']) ? $this->request->data['User']['email'] : null;
            $password = isset($this->request->data['User']['password']) ? $this->request->data['User']['password'] : null;
    
            if ($email && $password) {
                $user = $this->User->find('first', [
                    'conditions' => [
                        'User.email' => $email,
                    ]
                ]);
    
                if (!empty($user)) {
                    if (password_verify($password, $user['User']['password'])) {
                        // Clear existing user session and write new Auth.User session
                        $this->Auth->logout();
                        if ($this->Auth->login($user['User'])) {
                            $this->Flash->success("Success: You are logged in!");
                            return $this->redirect(['controller' => 'Users', 'action' => 'landing']);
                        } else {
                            $this->Flash->error("Error: Unable to log you in. Please try again.");
                        }
                    } else {
                        $this->Flash->error("Error: Invalid password!");
                    }
                } else {
                    $this->Flash->error("Error: User not found!");
                }
            } else {
                $this->Flash->error("Error: Please enter both email and password.");
            }
        }
    }
    
    public function search() {
        $this->autoRender = false;
        
        if ($this->request->is('ajax')) {
            $query = $this->request->query('query');
            
            $users = $this->User->find('all', array(
                'conditions' => array(
                    'User.email LIKE' => '%' . $query . '%',
                     'User.name LIKE' => '%' . $query . '%'
                ),
                'fields' => array('id','name','email', 'photo')
            ));
            
            $this->response->type('application/json');
            $this->response->body(json_encode($users));
        }
    }
       

    // public function ajaxLogin () {

    //     $user = $this->User->find('first', array(
    //         'conditions' => array(
    //             'username' => $this->request->data['username'],
    //             'password' => $this->request->data['password']
    //         )
    //     ));

    //     $didLogin = $this->Auth->login($user['User']);
        
    //     echo json_encode(array(
    //         "status" => "success",
    //         "user" => $this->Auth->user()
    //     ));
    //     die();
    // }

    public function logout() {
        $this->Auth->logout(); // Logs out the currently logged in user
        $this->Flash->success('You have been logged out.'); // Optional flash message
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
    // public function index() {
    //     $this->User->recursive = 0;
    //     $this->set('users', $this->paginate());
    // }
    public function landing() {
    
    $user = $this->User->findById($this->Auth->user('id'));
    $this->set('user', $user);
}

       
    public function profile() {
        $user = $this->User->findById($this->Auth->user('id'));
        $this->set('user', $user);
    }

    // public function view($id = null) {
    //     $this->User->id = $id;
    //     if (!$this->User->exists()) {
    //         throw new NotFoundException(__('Invalid user'));
    //     }
    //     $this->set('user', $this->User->findById($id));
    // }

    public function register() {
        $userAdded = false;
    
        if ($this->request->is('post')) {
            $this->User->create();
    
            // Check if an image was uploaded
            if (empty($this->request->data['User']['photo'])) {
                $this->request->data['User']['photo'] = '/img/profile_pictures/sample.png'; // Default image path
            }
            
            if ($this->User->save($this->request->data)) {
                debug($this->request->data);
            exit();
                $this->Flash->success(__('Thank you for registering!'));
                $userAdded = true;
            } else {
                $validationErrors = $this->User->validationErrors;
                $this->set('validationErrors', $validationErrors);
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
    
        $this->set(compact('userAdded'));
    }
    
    
     // public function edit($id = null) {
    //     $this->User->id = $id;
    //     if (!$this->User->exists()) {
    //         throw new NotFoundException(__('Invalid user'));
    //     }
    //     if ($this->request->is('post') || $this->request->is('put')) {
    //         if ($this->User->save($this->request->data)) {
    //             $this->Flash->success(__('The user has been saved'));
    //             return $this->redirect(array('action' => 'index'));
    //         }
    //         $this->Flash->error(
    //             __('The user could not be saved. Please, try again.')
    //         );
    //     } else {
    //         $this->request->data = $this->User->findById($id);
    //         unset($this->request->data['User']['password']);
    //    
    // }
    // }

 
public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid user'));
    }

    $user = $this->User->findById($id);
    if (!$user) {
        throw new NotFoundException(__('Invalid user'));
    }

    if ($this->request->is(['post', 'put'])) {
        $this->User->id = $id;

        // Check if 'User' key is set in request data
        if (isset($this->request->data['User'])) {
            // Check if 'photo' key is set in 'User' data
            if (isset($this->request->data['User']['photo'])) {
                $file = $this->request->data['User']['photo'];
                if (!empty($file['name'])) {
                    $fileName = uniqid() . '_' . $file['name'];
                    $uploadPath = WWW_ROOT . 'img' . DS . 'profile_pictures' . DS . $fileName;
                    
                    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                        $this->request->data['User']['photo'] = '/img/profile_pictures/' . $fileName;
                    } else {
                        $this->Flash->error(__('Error uploading the file.'));
                        return;
                    }
                } else {
                    unset($this->request->data['User']['photo']);
                }
            }
        }

        // Convert the birthdate to the correct format
        if (isset($this->request->data['User']['birthdate']) && !empty($this->request->data['User']['birthdate'])) {
            $this->request->data['User']['birthdate'] = date('Y-m-d', strtotime($this->request->data['User']['birthdate']));
        }

        // Save the user data
        $fieldsToSave = ['name', 'birthdate', 'gender', 'hobby', 'photo'];
        if ($this->User->save($this->request->data, ['fieldList' => $fieldsToSave])) {
            $this->Flash->success(__('Your profile has been updated.'));
            return $this->redirect(['action' => 'profile']);
        } else {
            $this->Flash->error(__('There was an error updating your profile. Please try again.'));
        }
    } else {
        $this->request->data = $this->User->findById($id);
    }

    $this->set('user', $user);
}




        


 
    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}