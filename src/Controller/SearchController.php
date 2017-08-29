<?php

namespace App\Controller;

use \Cake\Network\Exception;
use Cake\Event\Event;
use Cake\Utility\Text;
use Google_Client;
use Google_Service_Oauth2;
use Cake\Http\Client;
use Cake\ORM\TableRegistry;
use App\Model\Entity\User;
use \Cake\ORM\Entity;
define('GOOGLE_OAUTH_CLIENT_ID', '724346200475-sj3iure20vb2mse5m6ogjtsg9kb5qma2.apps.googleusercontent.com');
define('GOOGLE_OAUTH_CLIENT_SECRET', 'Vf5JkHeTmcXUxQHyJFVfNro9');
define('GOOGLE_OAUTH_REDIRECT_URI', 'http://www.moodify.com/search');

use Cake\Datasource\ConnectionManager;

class SearchController extends AppController
{

  public function index(){

    if(null !== $this->request->session()->read('firstName')){
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
                          $users_table = TableRegistry::get('users');
                          $result = $users_table->find('all')
                                                 ->where(['email' => $user['email']])
                                                 ->first();
                              if ($result) {
      // si l'email existe alors nous déclarons l'utilisateur comme authentifié sur CakePHP
                                  $this->Auth->setUser($result->toArray());
      // et nous redirigeons vers la page de succès de connexion
                                  //$this->redirect(GOOGLE_OAUTH_REDIRECT_URI);
                              } else {
      // si l'utilisateur n'est pas dans notre utilisateur, alors nous le créons avec les informations récupérées par Google+
                                  $data = array();
                                  $data['email'] = $user['email'];
                                  $data['firstname'] = $user['givenName'];
                                  $data['lastname'] = $user['familyName'];
                                  $data['avatar'] = $user['picture'];
                                  $data['link'] = $user['link'];
                                  $data['uuid'] = Text::uuid();
                                  $entity = $users_table->newEntity($data);
                                  if ($users_table->save($entity)) {
      // et ensuite nous déclarons l'utilisateur comme authentifié sur CakePHP
                                      $data['id'] = $entity->id;
                                      $this->Auth->setUser($data);
                                      $this->redirect($this->Auth->redirectUrl());
                                  } else {
                                      $this->Flash->set('Erreur de connection');
      // et nous redirigeons vers la page de succès de connexion
                                      $this->redirect(['controller' => 'connexion', 'action' => 'index']);
                                  }
                              }
                          } else {
      // si l'utilisateur n'est pas valide alors nous affichons une erreur
                              $this->Flash->set('Erreur les informations Google n\'ont pas été trouvée');
                          }
                      } catch (\Exception $e) {
                          $this->Flash->set('Grosse erreur Google, ça craint');
                          return $this->redirect(['controller' => 'Connexion', "action" => "index"]);
                      }
                  }
    }else{
      debug("nulll");
      $this->redirect(['controller' => 'connexion', 'action' => 'index']);
    }
    

  }

  public function getDrinks() {
    $http = new Client();
    switch ($_POST['temp']) {
      case "nuit-nuageuse":
      case "brouillard":
      case "nuit-avec-developpement-nuageux":
      case "fortement-nuageux":
        $taste = "bitter";
        break;
      case "stratus":
      case "ciel-voile":
      case "nuit-avec-averses-de-neige-faible":
      case "developpement-nuageux":
        $taste = "sour";
        break;
      case "nuit-faiblement-orageuse":
      case "eclaircies":
      case "ensoleille":
        $taste = "fresh";
        break;
      case "orage-modere":
      case "fortement-orageux":
      case "nuit-faiblement-orageuse":
        $taste = "spicy";
        break;
      case "nuit-avec-averses-de-neige-faible":
      case "averses-de-pluie-faible":
      case "nuit-claire-et-stratus":
      case "nuit-legerement-voilee":
      case "nuit-claire":
        $taste = "berry";
        break;
      case "faiblement-orageux":
      case "couvert-avec-averses":
      case "stratus-se-dissipant":
        $taste = "herb";
        break;
      case "neige-forte":
      case "pluie-forte":
      case "nuit-avec-averses":
      case "pluie-moderee":
        $taste = "spicy";
        break;
      case "averses-de-pluie-forte":
      case "pluie-et-neige-melee-moderee":
      case "pluie-et-neige-melee-faible":
      case "pluie-et-neige-melee-forte":
      case "averses-de-pluie-moderee":
        $taste = "fruity";
        break;
      case "averses-de-neige-faible":
      case "neige-moderee":
      case "neige-faible":
      case "pluie-faible":
      case "nuit-bien-degagee":
      case "faibles-passages-nuageux":
      case "faiblement-nuageux":
        $taste = "sweet";
        break;
    }
  if($_POST['temperature'] >= "28"){
    if($_POST['date'] >= "05" && $_POST['date'] <= "17"){
      $date = "afternoon";
    }else if($_POST['date'] >= "17" && $_POST['date'] <= "19"){
      $date = "pre-dinner";
    }else if($_POST['date'] >= "19" && $_POST['date'] <= "21"){
      $date = "after-dinner";
    }else if($_POST['date'] >= "21" && $_POST['date'] <= "05"){
      $date = "evening";
    }
    $urlNotAlcohol = "http://addb.absolutdrinks.com/drinks/not/alcoholic/tasting/" . $taste . "/for/". $date. "/with/ice-cubes?apiKey=328da11a6e5144929f6bf83e1dc9e5da";
    $urlAlcohol = "http://addb.absolutdrinks.com/drinks/alcoholic/tasting/" . $taste . "/for/". $date. "/with/ice-cubes?apiKey=328da11a6e5144929f6bf83e1dc9e5da";
  }else{
    if($_POST['date'] >= "05" && $_POST['date'] <= "17"){
      $date = "afternoon";
    }else if($_POST['date'] >= "17" && $_POST['date'] <= "19"){
      $date = "pre-dinner";
    }else if($_POST['date'] >= "19" && $_POST['date'] <= "21"){
      $date = "after-dinner";
    }else if($_POST['date'] >= "21" && $_POST['date'] <= "05"){
      $date = "evening";
    }
    $urlNotAlcohol = "http://addb.absolutdrinks.com/drinks/not/alcoholic/tasting/" . $taste . "/for/". $date. "?apiKey=328da11a6e5144929f6bf83e1dc9e5da";
    $urlAlcohol = "http://addb.absolutdrinks.com/drinks/alcoholic/tasting/" . $taste . "/for/". $date. "?apiKey=328da11a6e5144929f6bf83e1dc9e5da";
  }
  $responseAlcohol = $http->get($urlAlcohol);
  $responseNotAlcohol = $http->get($urlNotAlcohol);
  $nbAlcohol = count($responseAlcohol->json['result']) - 1 ;
  $nbNotAlcohol = count($responseNotAlcohol->json['result']) - 1;
  $nAlcohol = rand(0,$nbAlcohol );
  $nNotAlcohol = rand(0,$nbNotAlcohol);
  $alcohol = $responseAlcohol->json['result'][$nAlcohol];
  $notalcohol = $responseNotAlcohol->json['result'][$nNotAlcohol];
  $res = array();
  array_push($res, $alcohol, $notalcohol);
  die(json_encode($res));
  }

  public function getSeries(){
    $http = new Client();
    $url ="http://api.betaseries.com/shows/random?nb=100&key=cb1d200d4a43";
    $responseSerie = $http->get($url);
    $nbSeries = count($responseSerie->json['shows']);
    $nSeries= rand(0, $nbSeries );
    die(json_encode($responseSerie->json['shows'][$nSeries]));
  }

  public function getWeather() {
  }

  public function home() {
  }

  public function food(){
  }

  public function drinks(){
  }

  public function getActivities(){
    $temp = $_POST["temp"];
    $activity_table = TableRegistry::get('Activity');
    $result = $activity_table->find('all')
                           ->where(['weather' => $temp])
                           ->toArray();
    die(json_encode($result));
  }
}
