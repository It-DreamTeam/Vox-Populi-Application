<?php

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use App\Model\Entity\User;
use \Cake\ORM\Entity;
use Cake\Utility\Security;

class SignupController extends AppController
{

  public function index(){

    if($this->request->is('post')){
      $data = $_POST;

      $users_table = TableRegistry::get('users');

      // Utilise la valeur du salt de l'application
      $data['password'] = Security::hash($data['password'], 'sha1', true);
    //  $data['password'] = Security::encrypt($data['password'], $sha1);

      $entity = $users_table->newEntity($data);

      if ($users_table->save($entity)) {
// et ensuite nous déclarons l'utilisateur comme authentifié sur CakePHP
          $data['id'] = $entity->id;
          $this->Auth->setUser($data);
          echo $data["firstname"];
          $this->request->session()->write('firstName', $data["firstname"]);
          $this->redirect(['controller' => 'Search', 'action' => 'index']);
      } else {
          $this->Flash->set('Erreur d\'inscription - Adresse mail déjà utilisée.. ');
          $this->redirect(['controller' => 'Search', 'action' => 'index']);
      }

    }
//    die();

  }



}
