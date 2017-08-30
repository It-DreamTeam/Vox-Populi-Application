<?php $this->assign('title', "Connexion"); ?>
<?=$this->Html->css('login');?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->script('login');?>

<div class="container">
    <div class="row center-xs logo">
        <div class="col-xs-6">
            <div>
                <?=$this->Html->image('sun.png');?>
                <div class="">
                    <h1>Moodify app</h1>
                </div>
            </div>
        </div>
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




         <?= $this->Form->create(null, array('url' => ['controller' => 'Signup', 'action' => 'index'], 'class'=>'form-signup', 'id'=>'form_signup')); ?>
           <label for="lastname">Nom</label>
           <input class="form-styling" type="text" name="lastname" placeholder=""/>
           <label for="firstname">Prénom</label>
           <input class="form-styling" type="text" name="firstname" placeholder=""/>
           <label for="email">Email</label>
           <input class="form-styling" type="text" name="email" placeholder=""/>
           <label for="password">Mot de passe</label>
           <input class="form-styling" type="text" name="password" placeholder=""/>
           <?= $this->Form->button(__('S\'inscrire'), ['class' => 'btn-signup']) ?>
   			<?= $this->Form->end(); ?>


  </div>
</div>
