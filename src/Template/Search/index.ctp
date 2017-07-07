<?php $this->assign('title', "Recherche"); ?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app');?>

<?= $this->Flash->render() ?>

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
