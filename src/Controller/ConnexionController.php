<?php
namespace App\Controller;
use \Cake\Network\Exception;
use Cake\Event\Event;
use Cake\Utility\Text;
use Google_Client;
use Google_Service_Oauth2;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
define('GOOGLE_OAUTH_CLIENT_ID', '724346200475-sj3iure20vb2mse5m6ogjtsg9kb5qma2.apps.googleusercontent.com');
define('GOOGLE_OAUTH_CLIENT_SECRET', 'Vf5JkHeTmcXUxQHyJFVfNro9');
define('GOOGLE_OAUTH_REDIRECT_URI', 'http://moodify.local/search');
class ConnexionController extends AppController
{
  public function index(){
   if($this->request->session()->read('access-token') != null || $this->request->session()->read('Auth') != null){
      $this->redirect(['controller' => 'search', 'action' => 'index']);
    }
  }
  public function googlelogin()
  {
      $client = new Google_Client();
      $client->setClientId(GOOGLE_OAUTH_CLIENT_ID);
      $client->setClientSecret(GOOGLE_OAUTH_CLIENT_SECRET);
      $client->setRedirectUri(GOOGLE_OAUTH_REDIRECT_URI);
      $client->setScopes(array(
          "https://www.googleapis.com/auth/userinfo.profile",
          'https://www.googleapis.com/auth/userinfo.email'
      ));
      $url = $client->createAuthUrl();
      $this->redirect($url);
  }
  function logout()
   {
       $this->request->session()
                     ->destroy('access_token');
       $this->Flash->success('Vous êtes bien déconnecté');
       return $this->redirect($this->Auth->logout());
   }
   function connect() {
     if($this->request->is('post')){
       $data = $_POST;
       $users_table = TableRegistry::get('users');
       $data['password'] = Security::hash($data['password'], 'sha1', true);
       $result = $users_table->find('all')
                              ->where(['email' => $data['email'], 'password' => $data['password']])
                              ->first();

        if($result){
        if($result['avatar'] != null){
          $this->Flash->set('Vous êtes un utilisateur Google', ['element' => 'error']);
          $this->redirect(['controller' => 'connexion', 'action' => 'index']);
        }else{
          $this->Auth->setUser($result->toArray());
          $this->request->session()->write('firstName', $result["firstname"]);
          $this->redirect(['controller' => 'search', 'action' => 'index']);
        }
      }else{
          $this->Flash->set('Utilisateur inconnu. Inscrivez-vous', ['element' => 'error']);
          //$this->redirect(['controller' => 'signup', 'action' => 'index']);
          $this->redirect(['controller' => 'connexion', 'action' => 'index']);

      }

     }
   }
}
