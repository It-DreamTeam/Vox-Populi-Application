<?php $this->assign('title', "Recherche"); ?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('https://fonts.googleapis.com/css?family=Open+Sans:400,300,700');?>
<?=$this->Html->css('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i" rel="stylesheet');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app');?>
<?=$this->Html->css('login');?>

<?= $this->Flash->render() ?>
<div class="row center-xs logo">
    <div class="col-xs-6">
        <div class="box">
            <?=$this->Html->image('sun.png');?>
            <div class="">
                <h1>Moodify app</h1>
            </div>
        </div>
    </div>
</div>
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
