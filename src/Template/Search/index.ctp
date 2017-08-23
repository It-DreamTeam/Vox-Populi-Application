<?php $this->assign('title', "Recherche"); ?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app');?>

<?= $this->Flash->render() ?>

<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">



<a style="color: black;" href="/connexion/logout"> Déconnexion </a>

<h1 style="text-align: center; font-family: 'Indie Flower', cursive; font-size: 4em;" > Hello <?= $this->request->session()->read('firstName') ?></h1>
<div class="overlay">
	<div id="body_corp">
		<input id="input" type="text" placeholder='Dite "Météo à" + nom de la ville !'>
		<div class="buttonRec">
			<div class="innerRec">
			</div>
		</div>
		<input type="text" name="city" placeholder="Saisissez une ville" id="city" class="hide">
	</div>
</div>

<?=$this->Html->script('recognition');?>
