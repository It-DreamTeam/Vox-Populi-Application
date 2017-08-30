<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app');?>

<script>

$(document).ready(function() {
  var tasteResearch = localStorage.getItem("taste")
  $("#tasteD").text(tasteResearch)

  var drinkA = JSON.parse(localStorage.getItem("drinkA"))
  var drinkNA = JSON.parse(localStorage.getItem("drinkNA"))

  var say = "";
  say = drinkNA.name
  synth = window.speechSynthesis;
  var utterThis = new SpeechSynthesisUtterance(say);
  synth.speak(utterThis);
  var say2 = drinkA.name
  var utterThis2 = new SpeechSynthesisUtterance(say2);
  synth.speak(utterThis2);

  $("#drinks").append('<h2>'+  drinkNA.name +'</h2>');
  $("#drinks").append('<iframe width="450" height="300" id="videoA"src="https://www.youtube.com/embed/'+drinkNA.videos[0].video +'" frameborder="0" allowfullscreen></iframe>');
  $("#drinks").append('<h2>'+  drinkA.name +'</h2>');
  $("#drinks").append('<iframe width="450" height="300" id="videoA"src="https://www.youtube.com/embed/'+drinkA.videos[0].video +'" frameborder="0" allowfullscreen></iframe>');

})
</script>




<h1 style="text-align: center;"> Nous vous proposons deux boissons </h1>
<h2 style="text-align: center;" id="tasteD"> </h2>

<div id="drinks"> </div>
