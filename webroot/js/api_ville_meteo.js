var getMeteo;
var non_compris;

$( document ).ready(function() {

	$(window).scroll(function(){
		 var winTop = $(window).scrollTop();
		 if(winTop >= 30){
			 $("body").addClass("sticky-header");
		 }else{
			 $("body").removeClass("sticky-header");
		 }
		});

	var view = "";
	getMeteo = function getMeteo(){
  	var result =  localStorage.getItem('geocityfr');

  	if (result != "") {
    	$.getJSON('http://www.prevision-meteo.ch/services/json/'+result, function(data) {
        $('#result_city').append(data);
        if (data.current_condition != undefined) {

         /* DRINKS ----------------------------------------------------------------------- */
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


					/* SERIES  ----------------------------------------------------------------------- */
                    $.ajax({
                      type: "GET",
                      url: "/search/getSeries",
                      dataType: "json",
                      success: function(data) {
												console.log(data)
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


          $('#name_ville').html(data.city_info.name);
          $('#summary').html(data.current_condition.condition);
          $('#temperature_ville').html(data.current_condition.tmp+"<span>c</span>");

          $('.weather #inner').css('background','linear-gradient(to bottom, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 100%)');
          $('#card .details').css('color','#888');

          switch (data.current_condition.condition_key) {
            case "ensoleille":
            case "eclaircies":
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

                $('.weather #inner').css('background','linear-gradient(to bottom, rgba(0, 0, 0, 0.58) 50%, rgba(185, 185, 185, 0.52) 100%)');
                $('#card .details').css('color','rgb(239, 237, 237)');

                weather = "night";
                break;
            case "ciel-voile":
            case "faiblement-nuageux":
            case "stratus":
            case "brouillard":
            case "fortement-nuageux":
            case "faibles-passages-nuageux":
            case "developpement-nuageux":
            case "nuit-faiblement-orageuse":
            case "nuit-avec-averses-de-neige-faible":
                weather = "wind";
                break;
            case "faiblement-orageux":
            case "orage-modere":
            case "fortement-orageux":
                weather = "thunder";
                break;
            case "averses-de-pluie-faible":
            case "averses-de-pluie-moderee":
            case "averses-de-pluie-forte":
            case "couvert-avec-averses":
            case "pluie-faible":
            case "pluie-forte":
            case "pluie-moderee":
            case "pluie-et-neige-melee-faible":
            case "pluie-et-neige-melee-moderee":
            case "pluie-et-neige-melee-forte":
              weather = "rain";
                break;

            case "averses-de-neige-faible":
            case "neige-faible":
            case "neige-moderee":
            case "neige-forte":
              weather = "snow";
                break;

            default:console.log("Error de condition_key")

          }
					console.log('TEST1');
          changeWeather(weather);
        }else {
            alert("Ville non française");
        }
      });
  }
}
getMeteo();

});
