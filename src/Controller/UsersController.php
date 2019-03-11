<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['signUp', 'forgotPassword']);
//        $this->Auth->deny(['index','']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function login()
    {
        if ($this->Auth->user('id')) { //Check if user is logged in already
            $this->Flash->success(__('Ya estás logueado'));
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }

        if ($this->request->is('post')) {
            //Si el usuario no está autenticado
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success(__('Autenticación aceptada'));
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }

            $this->Flash->error(__('Autenticación erronea'));

        }
    /*
        $this->set(['user' => $user]);
        $this->set('_serialize', ['user']);*/

}

function logout()
{
    $this->Flash->success(__('Has cerrado sesión'));
    $this->redirect($this->Auth->logout());
}

/**
 * Add method
 *
 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
 */
public
function signUp()
{

    $user = $this->Users->newEntity();

//        print_r($this->request->getData());exit;
//        print_r($user);exit;
    if ($this->request->is('post')) {
        $user = $this->Users->patchEntity($user, $this->request->getData());

        if ($this->Users->save($user)) {
            $this->Flash->success(__('El usuario ha sido guardado correctamente :D'));

            return $this->redirect(['action' => 'index']);
        }

        /*$query = $this->Users->query();
        $query->insert(['email', 'password','phone'])
            ->values([
                'email' => $user['email'],
                'password' => $user['password'],
                'phone' => $user['phone ']
            ]);

        if ($query->execute()) {
            $this->Flash->success(__('El usuario ha sido guardado correctamente :D'));

            return $this->redirect(['action' => 'index']);
        }*/

        $this->Flash->error(__('Imposible guardar. Intente de nuevo.'));
    }
    $this->set(compact('user'));

}

public
function forgotPassword()
{
    // empty for now
}

/**
 * Edit method
 *
 * @param string|null $id User id.
 * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
 */
public
function edit($id = null)
{
    $user = $this->Users->get($id, [
        'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been saved.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    $this->set(compact('user'));
}

/**
 * Delete method
 *
 * @param string|null $id User id.
 * @return \Cake\Http\Response|null Redirects to index.
 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
 */
public
function delete($id = null)
{
    $this->request->allowMethod(['post', 'delete']);
    $user = $this->Users->get($id);
    if ($this->Users->delete($user)) {
        $this->Flash->success(__('The user has been deleted.'));
    } else {
        $this->Flash->error(__('The user could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
}
}
