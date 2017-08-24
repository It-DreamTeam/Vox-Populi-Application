<?php $this->assign('title', "Résultats"); ?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app1');?>

<header>
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
</header>
<div class="wrapper">
    <div class="tab-wrap">
        <input type="radio" name="tabs" id="food" checked>
        <div class="tab-label-content" id="tab1-content">
            <label for="food">
                <?=$this->Html->image('food/chicken.png');?> <br>
                <span>Food</span>
            </label>
            <div class="tab-content">
                AQUI LA COMIDA!!
            </div>
        </div>
        <input type="radio" name="tabs" id="drinks">
        <div class="tab-label-content" id="tab2-content">
            <label for="drinks">
                <?=$this->Html->image('food/chicken.png');?> <br>
                <span>Food</span>
            </label>
            <div class="tab-content">
                <div id='real'>
                    <h2>Alcoholic drink <div id="drinksA"></div> </h2>
                    <iframe width="450" height="300" id="videoA"src="" frameborder="0" allowfullscreen></iframe>
                </div>
                <div id='big'>
                    <h2>Soft drink <div id="drinksNA"> </div> </h2>
                    <iframe width="450" height="300" id="videoNA"frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <input type="radio" name="tabs" id="activities">
        <div class="tab-label-content" id="tab3-content">
            <label for="activities">Activities</label>
            <div class="tab-content">Here on propose une activité selon la météo, if --> fait beau alors on les envoie dors, else --> on propose de lire un livre regarder des films, bref</div>
        </div>
        <input type="radio" name="tabs" id="movies">
        <div class="tab-label-content" id="tab4-content">
            <label for="movies">Movies</label>
            <div class="tab-content">
                <section id='steezy'>
                    <h2>Movies and series</h2>
                    <div id="serie"></div>
                </section>
            </div>
        </div>
        <div class="slide"></div>
    </div>
</div>

<?=$this->Html->script('app');?>
<?=$this->Html->script('api_ville_meteo');?>
