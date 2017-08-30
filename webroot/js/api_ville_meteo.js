var getMeteo;
var non_compris;

$( document ).ready(function() {

	getMeteo = function getMeteo(){
  	var result =  localStorage.getItem('geocityfr');

  	if (result != "") {
    	$.getJSON('http://www.prevision-meteo.ch/services/json/'+result, function(data) {
        $('#result_city').append(data);
        if (data.current_condition != undefined) {

				 /* DRINKS -------------------------------------------------------------------------- */
											var date1 = new Date()
									 $.ajax({
										 type: "POST",
										 url: "/search/getDrinks",
										 dataType: "json",
										 data: {
												 "temp" : data.current_condition.condition_key,
												 "temperature": data.current_condition.tmp,
												 "date": date1.getHours(),
										 },
										 success: function(data) {
											 $('#drinksA').html(data[0].name)
											 $('#videoA').attr('src',"https://www.youtube.com/embed/"+ data[0].videos[0].video)
											 $('#drinksNA').html(data[1].name)
											 $('#videoNA').attr('src',"https://www.youtube.com/embed/"+ data[1].videos[0].video)
										 },
										 error : function (err){
											 console.log("DRINKS ERROR : ", err)
										 }
									 })
				 /* ------------------------------------------------------------------------------- */


				 /* FOOD -------------------------------------------------------------------------- */

				 var proxy = 'https://cors-anywhere.herokuapp.com/';
				 $.ajax({
					 type: "POST",
					 url: proxy +  "http://food2fork.com/api/search ",
					 headers: {
						 "Authorization": "Token 0efc9be2a4e068ccf5dac603d0467bad2776e72d",
					 },
					 data: {
						 "key" : "1db14a055d0691b833f56085dfd7eb57",
						 "Accept": "application/json",
					 },
					 dataType: "json",
					 success: function(data) {
						 var recipes = data.recipes
						 var arrayRecipes = []
						 for(var i = 0; i < 3 ; i++){
							 var item = recipes[Math.floor(Math.random()*recipes.length)];
							 arrayRecipes.push(item)
						 }

						   for(var i=0; i < arrayRecipes.length; i++){
						     var recipeId = arrayRecipes[i].recipe_id
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

						           var str = "<img src='"+ data.recipe.image_url + "' /> ";
						           var ingredients = ""
						           for(var ing=0; ing<data.recipe.ingredients.length; ing++){
						              ingredients += "<br> " + data.recipe.ingredients[ing]
						           }
											 $(".tab-content.food").append('<div class="col-lg-4 col-xs-6" id=\'recipe_'+data.recipe.recipe_id+'\'>  <h3> ' + data.recipe.title +'</h3> <a href="'+data.recipe.source_url + '" >Voir la recette complète </a>  <br> <img style="height: 250px; width: 250px" id="'+ i +'"src="' + data.recipe.image_url + '" /> <p> ' + ingredients +'</p>  </div>')
						         },
						         error: function() {
						           console.log("Internal Server Error");
						         }
						       })
						   }

					 },
					 error : function (err){
						 console.log("FOOD ERROR : ", err)
					 }
				 })
				 /* ------------------------------------------------------------------------------- */


				 /* SERIES  ----------------------------------------------------------------------- */
									 $.ajax({
										 type: "GET",
										 url: "/search/getSeries",
										 dataType: "json",
										 success: function(data) {
											 $('#serie').html( data.title)
											 $('#SDescription').html(data.description)
											 var img = new Image()
											 img.src = data.images.poster
											 img.height = 250
											 img.width = 250
											 $("#img").html(img)
										 },
										 error : function (err){
											 console.log("series ERROR : ", err)
										 }
									 })
				 /* ------------------------------------------------------------------------------- */


				 /* ACTIVITIES  ----------------------------------------------------------------------- */
				 var tempe = data.current_condition.condition
									 $.ajax({
										 type: "POST",
										 url: "/search/getActivities",
										 dataType: "json",
										 data: {
											 "temp" : data.current_condition.condition_key
										 },
										 success: function(data) {
 										 		$(".tab-content.activites").append('<h2 style="text-align: center;"> Nous vous proposons ses activités qui sont en accord avec cette journée '+ tempe +'</h2>')
											 for(var act=0; act<data.length; act++){
												 $(".tab-content.activites").append('<p> ' + data[act].name +'</p>')
						           }

										 },
										 error : function (err){
											 console.log("ACTIVITIES ERROR : ", err)
										 }
									 })
				 /* ------------------------------------------------------------------------------- */

          $('#name_ville').html(data.city_info.name);
          $('#temperature_ville').html(data.current_condition.tmp+"<span> °c</span>");
					$('#summary').html(data.current_condition.condition)
					var dt = new Date();
					var time = dt.getHours() + ":" + dt.getMinutes();

					$('.time').html(time)
					$('#humidity').html(data.current_condition.humidity+"%")
					switch (data.current_condition.wnd_dir) {
						case "N":
							$('#wind').html(data.current_condition.wnd_spd+"km/h ↑")
							break;
						case "S":
							$('#wind').html(data.current_condition.wnd_spd+"km/h ↓")
							break;
						case "E":
							$('#wind').html(data.current_condition.wnd_spd+"km/h →")
							break;
						case "O":
							$('#wind').html(data.current_condition.wnd_spd+"km/h ←")
							break;
						case "NE":
							$('#wind').html(data.current_condition.wnd_spd+"km/h ↗")
							break;
						case "NO":
							$('#wind').html(data.current_condition.wnd_spd+"km/h ↖")
							break;
						case "SE":
							$('#wind').html(data.current_condition.wnd_spd+"km/h ↘")
							break;
						case "SO":
							$('#wind').html(data.current_condition.wnd_spd+"km/h ↙")
							break;
					}


          switch (data.current_condition.condition_key) {
            case "ensoleille":
							weather = "sun-1"
							break;
            case "eclaircies":
						case "ciel-voile":
            case "stratus-se-dissipant":
              weather = "sun";
              break;
            case "nuit-claire":
            case "nuit-legerement-voilee":
            case "nuit-claire-et-stratus":
            case "nuit-nuageuse":
            case "nuit-bien-degagee":
            case "nuit-avec-averses":
            case "nuit-avec-developpement-nuageux":
            case "nuit-faiblement-orageuse":
            case "nuit-avec-averses-de-neige-faible":
                weather = "moon";
                break;
						case "brouillard":
						case "fortement-nuageux":
						case "faibles-passages-nuageux":
						case "developpement-nuageux":
					  case "faiblement-nuageux":
						case "stratus":
							weather = "clouds";
							break;
            case "nuit-faiblement-orageuse":
            case "nuit-avec-averses-de-neige-faible":
                weather = "wind";
                break;
            case "faiblement-orageux":
            case "orage-modere":
            case "fortement-orageux":
                weather = "lightning-1";
                break;
            case "averses-de-pluie-faible":
            case "averses-de-pluie-moderee":
            case "averses-de-pluie-forte":
            case "couvert-avec-averses":
            case "pluie-faible":
            case "pluie-forte":
            case "pluie-moderee":
              weather = "rain";
              break;
						case "pluie-et-neige-melee-faible":
						case "pluie-et-neige-melee-moderee":
						case "pluie-et-neige-melee-forte":
							weather = "hail";
							break;
            case "averses-de-neige-faible":
            case "neige-faible":
            case "neige-moderee":
            case "neige-forte":
              weather = "snow";
              break;
            default:console.log("Error de condition_key")

          }

					$('#imgS').attr('src', '/img/weather/' + weather + '.svg');
        }else {
            alert("Ville non française");
        }
      });
  }
}
getMeteo();

});
