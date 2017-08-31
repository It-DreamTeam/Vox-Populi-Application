var geocityfr = "";
var proxy = 'https://cors-anywhere.herokuapp.com/';

$(".buttonRec").on('click', function () {
    $(this).toggleClass("active");
    switchRecognition();
});

var accessToken = "4b8289d60d15475f8380de1d4086aff6";
var baseUrl = "https://api.api.ai/v1/";
$(document).ready(function () {
    $("#input").keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            send();
        }
    });
    $("#rec").click(function (event) {
        switchRecognition();
    });
});
var recognition;

function startRecognition() {
    recognition = new webkitSpeechRecognition();
    recognition.onstart = function (event) {
        updateRec();
        $('#city').val('');
        $('#input').val('');
    };
    recognition.onresult = function (event) {
        var text = "";
        for (var i = event.resultIndex; i < event.results.length; ++i) {
            text += event.results[i][0].transcript;
        }
        setInput(text);
        stopRecognition();
    };
    recognition.onend = function () {
        stopRecognition();
    };
    recognition.lang = "fr-FR";
    recognition.start();
}

function stopRecognition() {
    if (recognition) {
        recognition.stop();
        recognition = null;
    }
    updateRec();
}

function switchRecognition() {
    if (recognition) {
        stopRecognition();
    } else {
        startRecognition();
    }
}

function setInput(text) {
    $("#input").val(text);
    send();
}

function setInput2(text) {
    $('#city').val(text);
}

function updateRec() {
    //$("#rec").text(recognition ? "Stop" : "Speak");
}

function send() {
  var text = $("#input").val();

if (text.toLowerCase().indexOf("météo") >= 0 || text.toLowerCase().indexOf("Météo") >= 0 ||text.toLowerCase().indexOf("meteo") >= 0 || text.toLowerCase().indexOf("Meteo") >= 0){
// --------------------------- METEO API -----------------------------
  $.ajax({
      type: "POST",
      url: baseUrl + "query?v=20150910",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      headers: {
        "Authorization": "Bearer " + accessToken
      },
      data: JSON.stringify({ query: text, lang: "en", sessionId: "somerandomthing" }),
      success: function(data) {
        non_compris = data.result.fulfillment.speech;

        var say = "";
        say = data.result.fulfillment.speech;
        synth = window.speechSynthesis;
        var utterThis = new SpeechSynthesisUtterance(say);
        synth.speak(utterThis);

          if(data.result) {
  					setInput2(data.result.parameters.parameter);
            geocityfr = data.result.parameters.parameter;
            localStorage.setItem('geocityfr', data.result.parameters.parameter);
            window.location = '/search/home';
          }
          else {
            alert(non_compris);
          }
      },
      error: function() {
        console.log("Internal Server Error");
      }
    });

}else if(text.toLowerCase().indexOf("je veux une boisson") >= 0){
  // -------------------------------------- DRINKS ----------------------------------------------

  //Get the taste of the drinks that the user had research
  $.ajax({
      type: "POST",
      url: baseUrl + "query?v=20150910",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      headers: {
        "Authorization": "Bearer " + accessToken
      },
      data: JSON.stringify({ query: text, lang: "en", sessionId: "somerandomthing" }),
      success: function(data) {
        text = data.result.parameters.parameter

        var say = "";
        say = data.result.fulfillment.speech;
        synth = window.speechSynthesis;
        var utterThis = new SpeechSynthesisUtterance(say);
        synth.speak(utterThis);
        localStorage.setItem('taste', data.result.parameters.parameter);

        //NOT ALCOHOLIC
        $.ajax({
            type: "GET",
            url: proxy + "http://addb.absolutdrinks.com/drinks/not/alcoholic/tasting/" + text +"?apiKey=328da11a6e5144929f6bf83e1dc9e5da",
            success: function(data) {
              var datasNA = data

              //ALCOHOL
              $.ajax({
                  type: "GET",
                  url: proxy + "http://addb.absolutdrinks.com/drinks/alcoholic/tasting/" + text +"?apiKey=328da11a6e5144929f6bf83e1dc9e5da",
                  success: function(data) {
                    let drinkA = data.result[Math.floor(Math.random()*data.result.length)]
                    localStorage.setItem('drinkA', JSON.stringify(drinkA));
                    let drinkNA = datasNA.result[Math.floor(Math.random()*datasNA.result.length)]
                    localStorage.setItem('drinkNA', JSON.stringify(drinkNA));
                    window.location = '/search/drinks';
                  },
                  error: function() {
                    console.log("Internal Server Error");
                  }
                });

            },
            error: function() {
              console.log("Internal Server Error");
            }
          });
      },
      error: function() {
        console.log("Internal Server Error");
      }
    })

}else if(text.toLowerCase().indexOf("donne-moi la sortie des prochains films") >= 0 || text.toLowerCase().indexOf("quelles sont les prochaines sorties au cinéma") >= 0 || text.toLowerCase().indexOf("quelles sont les prochaines sorties au cinéma ?") >= 0 || text.toLowerCase().indexOf("quelles sont les prochaines sorties au cinéma ") >= 0 || text.toLowerCase().indexOf("quels sont les prochaines sorties au cinéma ") >= 0 || text.toLowerCase().indexOf("quels sont les prochaines sorties au cinéma") >= 0 ){

// ------------------------ UPCOMING MOVIES -----------------------------
  $.ajax({
      type: "POST",
      url: baseUrl + "query?v=20150910",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      headers: {
        "Authorization": "Bearer " + accessToken
      },
      data: JSON.stringify({ query: text, lang: "en", sessionId: "somerandomthing" }),
      success: function(data) {

        text = data.result.parameters.parameter
        var say = "";
        say = data.result.fulfillment.speech;
        synth = window.speechSynthesis;
        var utterThis = new SpeechSynthesisUtterance(say);
        synth.speak(utterThis);

          $.ajax({
              type: "GET",
              url: "http://api.betaseries.com/movies/discover?key=cb1d200d4a43",
              data: {
                "type": "upcoming"
              },
              success: function(data) {
                var moviesUpcomingSelected = []
                for(let mov=0; mov < 4; mov++){
                    var item = data.movies[Math.floor(Math.random()*data.movies.length)];
                    moviesUpcomingSelected.push(item)
                }
                localStorage.setItem("TVSpeech", "upcomingFilms");
                localStorage.setItem("TVRSpeech", JSON.stringify(moviesUpcomingSelected));
                window.location = '/search/betaseries';
              },
              error: function() {
                console.log("Internal Server Error");
              }
            })

      },
      error: function() {
        console.log("Internal Server Error");
      }
    })

}else if(text.toLowerCase().indexOf("je veux regarder") >= 0 || text.toLowerCase().indexOf("Je veux regarder") >= 0 ){

// ---------------------------------- BETASERIES -----------------------------------
$.ajax({
    type: "POST",
    url: baseUrl + "query?v=20150910",
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    headers: {
      "Authorization": "Bearer " + accessToken
    },
    data: JSON.stringify({ query: text, lang: "en", sessionId: "somerandomthing" }),
    success: function(data) {
      text = data.result.parameters.parameter
      var say = "";
      say = data.result.fulfillment.speech;
      synth = window.speechSynthesis;
      var utterThis = new SpeechSynthesisUtterance(say);
      synth.speak(utterThis)
      localStorage.setItem("TVSpeech",text)

      if(text == "film"){
        // ----------- MOVIES ---------------------
        $.ajax({
            type: "GET",
            url: "http://api.betaseries.com/movies/discover?key=cb1d200d4a43",
            data: {
              "type": "popular"
            },
            success: function(data) {
              var moviesSelected = []
              for(let mov=0; mov < 4; mov++){
                  var item = data.movies[Math.floor(Math.random()*data.movies.length)];
                  moviesSelected.push(item)
              }
              localStorage.setItem("TVRSpeech", JSON.stringify(moviesSelected));
              window.location = '/search/betaseries';
            },
            error: function() {
              console.log("Internal Server Error");
            }
          })
      }else if(text == "serie" || text == "série"){
        // ------------------------- SERIES -----------------------
        $.ajax({
            type: "GET",
            url: "http://api.betaseries.com/shows/discover?key=cb1d200d4a43",
            success: function(data) {
              var seriesSelected = []
              for(let mov=0; mov < 4; mov++){
                  var item = data.shows[Math.floor(Math.random()*data.shows.length)];
                  seriesSelected.push(item)
              }
              localStorage.setItem("TVRSpeech", JSON.stringify(seriesSelected));
              window.location = '/search/betaseries';
            },
            error: function() {
              console.log("Internal Server Error");
            }
          })
      }

    },
    error: function() {
      console.log("Internal Server Error");
    }
  })

}else{

if(text.toLowerCase().indexOf("je veux manger") >= 0 || text.toLowerCase().indexOf("Je veux mangé") >= 0 ){
// ------------------------------------ FOOD -------------------------------------

  $.ajax({
      type: "POST",
      url: baseUrl + "query?v=20150910",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      headers: {
        "Authorization": "Bearer " + accessToken
      },
      data: JSON.stringify({ query: text, lang: "en", sessionId: "somerandomthing" }),
      success: function(data) {
        text = data.result.parameters.parameter

        var say = "";
        say = data.result.fulfillment.speech;
        synth = window.speechSynthesis;
        var utterThis = new SpeechSynthesisUtterance(say);
        synth.speak(utterThis);

        console.log(text)

        // ---------------------------- FOOD API ---------------------------------------------------------
          $.ajax({
              type: "GET",
              url: proxy + "http://food2fork.com/api/search",
            /*  headers: {
                "Authorization": "Token 0efc9be2a4e068ccf5dac603d0467bad2776e72d",
              },*/
              data: {
                "key" : "3b43a2756e396e825d5a2bb283e727df",
                "q": text,
                "Accept": "application/json",
              },
              success: function(data) {
                var data = JSON.parse(data)
console.log(data)
                if(data.error){
                    alert("Nous n'avons pas compris votre requête..")
                }else{
                  var recipes = data.recipes
                  var array = []
                  var newItem = []
                  if(recipes.length == 0){
                    alert("Nous n'avons pas compris votre requête..")
                  }else{
                    if(recipes.length < 4){
                      for(var i = 0; i < recipes.length; i++){
                        var item = recipes[Math.floor(Math.random()*recipes.length)];
                        array.push(item)
                      }
                    }else{
                      for(var i = 0; i < 4; i++){
                        var item = recipes[Math.floor(Math.random()*recipes.length)];
                        newItem.push(item)
                        if(jQuery.inArray(item, newItem )){
                          item = recipes[Math.floor(Math.random()*recipes.length)];
                          array.push(item)
                        }else{
                          array.push(item)
                        }
                      }
                    }
                    localStorage.setItem("foodData", JSON.stringify(array));
                    localStorage.setItem("foodSpeech", JSON.stringify(text));
                    window.location = '/search/food';
                  }
                }

              },
              error: function() {
                console.log("Internal Server Error");
              }
            });
      },
      error: function() {
        console.log("Internal Server Error");
      }
    })
}else{
  // --------------------------- FOOD API ---------------------------------------
    $.ajax({
        type: "GET",
        url: proxy + "http://food2fork.com/api/search",
      /*  headers: {
          "Authorization": "Token 0efc9be2a4e068ccf5dac603d0467bad2776e72d",
        },*/
        data: {
          "key" : "3b43a2756e396e825d5a2bb283e727df",
          "q": text,
          "Accept": "application/json",
        },
        success: function(data) {
          var data = JSON.parse(data)
          if(data.error){
              alert("Nous n'avons pas compris votre requête..")
          }else{
            var recipes = data.recipes
            var array = []
            var newItem = []

            if(recipes.length == 0){
              alert("Nous n'avons pas compris votre requête..")
            }else{
              if(recipes.length < 4){
                for(var i = 0; i < recipes.length; i++){
                  var item = recipes[Math.floor(Math.random()*recipes.length)];
                  array.push(item)
                }
              }else{
                for(var i = 0; i < 4; i++){
                  var item = recipes[Math.floor(Math.random()*recipes.length)];
                  newItem.push(item)
                  if(jQuery.inArray(item, newItem )){
                    item = recipes[Math.floor(Math.random()*recipes.length)];
                    array.push(item)
                  }else{
                    array.push(item)
                  }
                }
              }
console.log(array)
              localStorage.setItem("foodData", JSON.stringify(array));
              localStorage.setItem("foodSpeech", JSON.stringify(text));
              //window.location = '/search/food';
            }
          }
        },
        error: function() {
          console.log("Internal Server Error");
        }
      })
    }


  }

}
