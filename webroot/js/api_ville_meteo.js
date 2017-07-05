$( document ).ready(function() {
var view = "";


$('#city').keydown(function (event) {
    var keypressed = event.keyCode || event.which;
    if (keypressed == 13) {
      var result = $('#city').val();

        $.getJSON('http://www.prevision-meteo.ch/services/json/'+result, function(data) {
            console.log(data);
            $('#result_city').append(data);

        });
    }
});

$('#city_btn').click(function (event) {
      var result = $('#city').val();

      if (result != "") {
        $.getJSON('http://www.prevision-meteo.ch/services/json/'+result, function(data) {
            console.log(data);
            $('#result_city').append(data);
            $('#temperature_ville').html(data.current_condition.tmp+'<span>c</span>');
            $('#name_ville').html(data.city_info.name);
            $('#summary').html(data.current_condition.condition);


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

              default:console.log("Ta mere !")

            }
            changeWeather(weather)
        });
      }
});

})
