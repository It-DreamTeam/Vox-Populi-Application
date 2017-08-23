<?php $this->assign('title', "Connexion"); ?>
<?=$this->Html->css('login');?>
<?=$this->Html->css('https://fonts.googleapis.com/css?family=Open+Sans:400,300,700');?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->script('login');?>

<div class="container">
  <div class="logo">
      <h1>Moodify</h1>
  </div>
  <div class="frame">
    <div class="nav-login">
      <ul class="links">
        <li class="signin-active"><a class="btn">Se connecter</a></li>
        <li class="signup-inactive"><a class="btn">S'inscrire</a></li>
      </ul>
    </div>
    <div class="form-wrap">
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
        <form class="form-signup" action="" method="post" name="form">
            <label for="fullname">Full name</label>
            <input class="form-styling" type="text" name="fullname" placeholder=""/>
            <label for="email">Email</label>
            <input class="form-styling" type="text" name="email" placeholder=""/>
            <label for="password">Password</label>
            <input class="form-styling" type="text" name="password" placeholder=""/>
            <label for="confirmpassword">Confirm password</label>
            <input class="form-styling" type="text" name="confirmpassword" placeholder=""/>
            <a ng-click="checked = !checked" class="btn-signup">Sign Up</a>
        </form>
  </div>
</div>
