<?php

namespace App\Controller;

use \Cake\Network\Exception;
use Cake\Event\Event;
use Cake\Utility\Text;
use Google_Client;
use Google_Service_Oauth2;

define('GOOGLE_OAUTH_CLIENT_ID', '724346200475-sj3iure20vb2mse5m6ogjtsg9kb5qma2.apps.googleusercontent.com');
define('GOOGLE_OAUTH_CLIENT_SECRET', 'Vf5JkHeTmcXUxQHyJFVfNro9');
define('GOOGLE_OAUTH_REDIRECT_URI', 'http://www.moodify.com/search');

use Cake\Datasource\ConnectionManager;

/*$dsn = 'mysql://root:0000@192.168.1.151/cooking';
ConnectionManager::config('default', ['url' => $dsn]);
$connection = ConnectionManager::get('default');*/

class ConnexionController extends AppController
{

  public function index(){
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


  public function google_login()
{
$client = new Google_Client();
/* Création de notre client Google */
            $client->setClientId(GOOGLE_OAUTH_CLIENT_ID);
            $client->setClientSecret(GOOGLE_OAUTH_CLIENT_SECRET);
            $client->setRedirectUri(GOOGLE_OAUTH_REDIRECT_URI);

            $client->setScopes(array(
                "https://www.googleapis.com/auth/userinfo.profile",
                'https://www.googleapis.com/auth/userinfo.email'
            ));
            $client->setApprovalPrompt('auto');

/* si dans l'url le paramètre de retour Google contient 'code' */
            if (isset($this->request->query['code'])) {
// Alors nous authentifions le client Google avec le code reçu
                $client->authenticate($this->request->query['code']);
// et nous plaçons le jeton généré en session
                $this->request->Session()->write('access_token', $client->getAccessToken());
            }

/* si un jeton est en session, alors nous le plaçons dans notre client Google */
            if ($this->request->Session()->check('access_token') && ($this->request->Session()->read('access_token'))) {
                $client->setAccessToken($this->request->Session()->read('access_token'));
            }
/* Si le client Google a bien un jeton d'accès valide */
            if ($client->getAccessToken()) {
// alors nous écrivons le jeton d'accès valide en session
                $this->request->Session()->write('access_token', $client->getAccessToken());
// nous créons une requête OAuth2 avec le client Google paramétré
                $oauth2 = new Google_Service_Oauth2($client);
// et nous récupérons les informations de l'utilisateur connecté
                $user = $oauth2->userinfo->get();
                try {
                    if (!empty($user)) {
// si l'utilisateur est bien déclaré, nous vérifions si dans notre table Users il existe l'email de l'utilisateur déclaré ou pas
                        $result = $this->Users->find('all')
                                              ->where(['email' => $user['email']])
                                              ->first();
                        if ($result) {
// si l'email existe alors nous déclarons l'utilisateur comme authentifié sur CakePHP
                            $this->Auth->setUser($result->toArray());
// et nous redirigeons vers la page de succès de connexion
                            $this->redirect($this->Auth->redirectUrl());
                        } else {
// si l'utilisateur n'est pas dans notre utilisateur, alors nous le créons avec les informations récupérées par Google+
                            $data = array();
                            $data['email'] = $user['email'];
                            $data['first_name'] = $user['givenName'];
                            $data['last_name'] = $user['familyName'];
                            $data['social_id'] = $user['id'];
                            $data['avatar'] = $user['picture'];
                            $data['link'] = $user['link'];
                            $data['uuid'] = Text::uuid();
                            $entity = $this->Users->newEntity($data);
                            if ($this->Users->save($entity)) {
// et ensuite nous déclarons l'utilisateur comme authentifié sur CakePHP
                                $data['id'] = $entity->id;
                                $this->Auth->setUser($data);
                                $this->redirect($this->Auth->redirectUrl());
                            } else {
                                $this->Flash->set('Erreur de connection');
// et nous redirigeons vers la page de succès de connexion
                                $this->redirect(['action' => 'login']);
                            }
                        }
                    } else {
// si l'utilisateur n'est pas valide alors nous affichons une erreur
                        $this->Flash->set('Erreur les informations Google n\'ont pas été trouvée');
                        $this->redirect(['action' => 'login']);
                    }
                } catch (\Exception $e) {
                    $this->Flash->set('Grosse erreur Google, ca craint');
                    return $this->redirect(['action' => 'login']);
                }
            }
        }


}
