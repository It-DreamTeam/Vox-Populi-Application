<?php $this->assign('title', "Résultats"); ?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app');?>

<header>
    <div class="weather row center-lg center-xs">
        <div class="col-lg-6 col-xs-6">
            <div id="summaryy" class="w-icons"><img src="" id="imgS"> </img></div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="review">
                <?=$this->Html->image('weather/raindrop.png');?>
                <span id="humidity">Humidity</span>
                <?=$this->Html->image('weather/wind.png');?>
                <span id="wind">Wind</span>
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
<div class="">
    <div class="tab-wrap">
        <input type="radio" name="tabs" id="food" checked>
        <div class="tab-label-content" id="tab1-content">
            <label for="food">
                <?=$this->Html->image('food/chicken.png');?><br>
                <span>Nourriture</span>
            </label>
            <div class="tab-content food" style="width: 100%; display: flex;">

            </div>
        </div>
        <input type="radio" name="tabs" id="drinks">
        <div class="tab-label-content" id="tab2-content">
            <label for="drinks">
                <?=$this->Html->image('drinks/glass.png');?>
                <span>Boissons</span>
            </label>
            <div class="tab-content drinks" style="<width: 100%; display: flex;">
                <div id='real' class="col-lg-8 col-xs-6">
                    <h2>Boisson alcoolisée <div id="drinksA"></div> </h2>
                    <iframe width="450" height="300" id="videoA" src="" frameborder="0" allowfullscreen></iframe>
                </div>
                <div id='big' class="col-lg-8 col-xs-6">
                    <h2>Boisson non alcoolisée <div id="drinksNA"> </div> </h2>
                    <iframe width="450" height="300" id="videoNA"frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <input type="radio" name="tabs" id="activities">
        <div class="tab-label-content" id="tab3-content">
            <label for="activities">
                <?=$this->Html->image('activities/activities.png');?> <br>
                <span>Activités</span>
            </label>
            <div class="tab-content activites">
            </div>
        </div>
        <input type="radio" name="tabs" id="movies">
        <div class="tab-label-content" id="tab4-content">
            <label for="movies">
                <?=$this->Html->image('movies/old-television.png');?> <br>
                <span>Films &amp; s"ries</span>
            </label>
            <div class="tab-content">
                <section id='steezy'>
                  <div id="serie" style="font-weight: bold; font-size: 40px;"> </div><br>
                  <div id="img" ></div> <br>
                  <div id="SDescription" style="text-align: justify;"> </div>
                </section>
            </div>
        </div>
        <div class="slide"></div>
    </div>



    <div style="width: 100%; position: fixed; bottom: 0; z-index: 2; text-align: center;" id="openResearch"> <img  style="width: 40px;" src="/img/1.svg"> </img> </div>

    <div class="sticky-input">
        <div class="effectwrap">
            <input class="tot effect-9" id="input" type="text" placeholder='Dite "Météo à" + nom de la ville !'></input>
            <span class="focus-border">
        <i></i>
        </span>
        </div>
        <div class="buttonRec">
            <div class="innerRec">
            </div>
        </div>
    </div>



</div>

<?=$this->Html->script('app');?>
<?=$this->Html->script('api_ville_meteo');?>
<?=$this->Html->script('recognition');?>


<script>
$(".sticky-input").hide()

$('#openResearch').on('click', function(){
  if($(".sticky-input").is(":visible")){
    $(".sticky-input").hide()
    $("#openResearch img").css({'transform': 'rotate(0deg)'});
  }else{
    $(".sticky-input").show()
    $("#openResearch img").css({'transform': 'rotate(-180deg)'});
  }
})

$('.tab-content.drinks').hide()
$("#tab1-content").on('click', function(){
  $('.tab-content.food').show()
  $('.tab-content.drinks').hide()
})
$("#tab2-content").on('click', function(){
  $('.tab-content.food').hide()
  $('.tab-content.drinks').show()
})
$("#tab3-content").on('click', function(){
  $('.tab-content.food').hide()
  $('.tab-content.drinks').hide()
})
$("#tab4-content").on('click', function(){
  $('.tab-content.food').hide()
  $('.tab-content.drinks').hide()
})
</script>
