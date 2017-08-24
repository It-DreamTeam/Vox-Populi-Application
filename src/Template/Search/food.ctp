<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app');?>


<script>
$(document).ready(function() {
  var storedNames = JSON.parse(localStorage.getItem("foodData"));
  var foodText = localStorage.getItem("foodSpeech");
  foodText = foodText.replace(/\"/g, "")
  $("#foodSp").text(foodText)

console.log(storedNames)

  for(var i=0; i < storedNames.length; i++){
    var recipeId = storedNames[i].recipe_id
    var proxy = 'https://cors-anywhere.herokuapp.com/';
    $.ajax({
        type: "POST",
        url: proxy + "http://food2fork.com/api/get",
        dataType: "json",
        headers: {
          "Authorization": "Token 0efc9be2a4e068ccf5dac603d0467bad2776e72d",
        },
        data: {
          "key" : "1db14a055d0691b833f56085dfd7eb57",
          "rId": recipeId,
          "Accept": "application/json",
        },
        success: function(data) {

          var say = "";
          say = data.recipe.title;
          synth = window.speechSynthesis;
          var utterThis = new SpeechSynthesisUtterance(say);
          synth.speak(utterThis);

          var str = "<img src='"+ data.recipe.image_url + "' /> ";
          $("#container").append('<div id=\'recipe_'+data.recipe.recipe_id+'\'>');
          $("#container").append(' <h3> ' + data.recipe.title +'</h3>')
          $('#container').append(' <img style="height: 250px; width: 250px" id="'+ i +'"src="' + data.recipe.image_url + '" />')
          var ingredients = ""
          for(var ing=0; ing<data.recipe.ingredients.length; ing++){
             ingredients += "<br> " + data.recipe.ingredients[ing]
          }
          $("#container").append('<p> ' + ingredients +'</p>')
          $("#container").append('<a href="'+data.recipe.source_url + '" >Voir la recette complète </a>')
          $("#container").append("</div>")
        },
        error: function() {
          console.log("Internal Server Error");
        }
      })
  }
})
</script>



<h1 style="text-align: center;"> Recettes que nous vous proposons à base de </h1>
<h2 style="text-align: center;" id="foodSp"> </h2>


<div id="container"> </div>
