<?php $this->assign('title', "Connexion"); ?>
<?=$this->Html->css('login');?>
<?=$this->Html->css('https://fonts.googleapis.com/css?family=Open+Sans:400,300,700');?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->script('login');?>

<div class="container">
  <div class="frame">
    <div class="nav">
      <ul class"links">
        <li class="signin-active"><a class="btn">Se connecter</a></li>
        <li class="signup-inactive"><a class="btn">S'inscrire</a></li>
      </ul>
    </div>
    <div>



      <?= $this->Form->create(null, array('url' => ['controller' => 'Connexion', 'action' => 'connect'], 'class'=>'form-signin', 'id'=>'form_connexion')); ?>
        <?= $this->Flash->render() ?>
        <label for="username">Email</label>
        <?= $this->Form->input('email', ['label'=>false, 'div'=>false, 'class'=>'form-styling']); ?>
        <label for="password">Mot de passe</label>
        <?= $this->Form->input('password', ['label'=>false, 'div'=>false, 'class'=>'form-styling']); ?>
        <div class="btn-animate">
          <a class="btn-signin">Se connecter</a>
        </div>
        <div class="btn-animate-google">
          <a class="btn-signin-google" href="<?= $this->Url->build(['action' => 'googlelogin']); ?>">Se connecter via Google</a>
        </div>
      <?= $this->Form->end(); ?>




      <?= $this->Form->create(null, array('url' => ['controller' => 'Signup', 'action' => 'index'], 'class'=>'form-signup', 'id'=>'form_connexion')); ?>
        <label for="firstname">First name</label>
        <input class="form-styling" type="text" name="firstname" placeholder=""/>
        <label for="lastname">Last name</label>
        <input class="form-styling" type="text" name="lastname" placeholder=""/>
        <label for="email">Email</label>
        <input class="form-styling" type="text" name="email" placeholder=""/>
        <label for="password">Password</label>
        <input class="form-styling" type="text" name="password" placeholder=""/>
        <?= $this->Form->button(__('Sign Up'), ['class' => 'btn-signup']) ?>
			<?= $this->Form->end(); ?>




  <<!--    <div class="success">
        <svg width="270" height="270" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
 viewBox="0 0 60 60" id="check" ng-class="checked ? 'checked' : ''">
           <path fill="#ffffff" d="M40.61,23.03L26.67,36.97L13.495,23.788c-1.146-1.147-1.359-2.936-0.504-4.314
            c3.894-6.28,11.169-10.243,19.283-9.348c9.258,1.021,16.694,8.542,17.622,17.81c1.232,12.295-8.683,22.607-20.849,22.042
            c-9.9-0.46-18.128-8.344-18.972-18.218c-0.292-3.416,0.276-6.673,1.51-9.578" />
          <div class="successtext">
             <p> Thanks for signing up! Check your email for confirmation.</p>
          </div>
       </div>
     </div>

     <div>
       <div class="cover-photo"></div>
       <div class="profile-photo"></div>
       <h1 class="welcome">Bienvenue toi</h1>
       <a class="btn-goback" value="Refresh" onClick="history.go()">Go back</a>
     </div>


   -->

      <div class="forgot">
        <a href="#">Mot de passe oublié?</a>
      </div>


  </div>
</div>
