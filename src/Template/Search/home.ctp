<?php $this->assign('title', "Résultats"); ?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app1');?>

<header>
	<div class="background">
    <div class="">
    	<div class="weather row center-lg center-xs">
            <div class="col-lg-6 col-xs-6">
                <div id="summaryy" class="w-icons"><?=$this->Html->image('weather/sun.svg');?></div>
            </div>
            <div class="col-lg-6 col-xs-6">
                <div class="review">
                    <?=$this->Html->image('weather/raindrop.png');?>
                    <span>Humidity</span>
                    <?=$this->Html->image('weather/wind.png');?>
                    <span>Wind</span>
                </div>
            </div>
            <div class="col-lg-6 col-xs-6 temp-wrap">
                <div class="temp-city" id="temperature_ville">Temp</div>
            </div>
            <div class="col-lg-6 col-xs-6">
                <div class="locate-review">
                    <div class="city" id="name_ville">Ville</div>
                    <div id="date">
                        <span class="time">4:00</span>
                    </div>
                    <span id="summary" class="status">Sunny</span>
                </div>
            </div>
    	</div>
    </div>
	</div>
</header>
<div class="wrapper">
	<div id="header_wrapper">
		<a class="btn btn-block google btn-danger" href="<?= $this->Url->build(['action' => 'index']); ?>">Changer de ville</a>
	</div>
	<div id="proposition">
		<h1>&#9135; Here, your propositions of the day &#9135;</h1>
	</div>
  <section id='steezy'>
    <h2>Shows</h2>
		<div id="serie"> </div>
	</section>

  <section id='real'>
    <h2>Alcoholic drink <div id="drinksA"></div> </h2>
		<iframe width="450" height="300" id="videoA"src="" frameborder="0" allowfullscreen></iframe>
  </section>

  <section id='big'>
    <h2>Soft drink <div id="drinksNA"> </div> </h2>

		<iframe width="450" height="300" id="videoNA"frameborder="0" allowfullscreen></iframe>
  </section>
</div>

<?=$this->Html->script('app');?>
<?=$this->Html->script('api_ville_meteo');?>
