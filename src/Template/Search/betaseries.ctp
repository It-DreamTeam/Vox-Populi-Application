<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app');?>

<script>

$(document).ready(function() {

  var tvSearch =  localStorage.getItem("TVSpeech").toUpperCase()
  console.log(tvSearch)





  if(tvSearch == "FILM"){
    $("#research").text(tvSearch +"S PROPOSÉS")

    var arrayResearch = JSON.parse(localStorage.getItem("TVRSpeech"))
    for(let films= 0;films < arrayResearch.length; films++){
      $.ajax({
        type: "GET",
        url: "https://api.betaseries.com/movies/movie?key=cb1d200d4a43",
        data :{
          "id": arrayResearch[films].id
        },
        dataType: "json",
        success: function(data) {
          console.log(data)

          var say = "";
          say = data.movie.title;
          synth = window.speechSynthesis;
          var utterThis = new SpeechSynthesisUtterance(say);
          synth.speak(utterThis);

            $('#container').append('<div>')
            $('#container').append('<h2>'+ data.movie.title +'</h2>')
            $('#container').append('<img style="height: 200px; width: 200px" src="' + data.movie.poster + '" />')
            $('#container').append('<p>'+ data.movie.synopsis +'</p>')

            $('#container').append('</div>')
        },
        error : function (err){
          console.log("series ERROR : ", err)
        }
      })
    }
  }else if(tvSearch == "UPCOMINGFILMS"){
    $("#research").text("Les prochaines sorties")

    var arrayResearch = JSON.parse(localStorage.getItem("TVRSpeech"))
    for(let films= 0;films < arrayResearch.length; films++){
      $.ajax({
        type: "GET",
        url: "https://api.betaseries.com/movies/movie?key=cb1d200d4a43",
        data :{
          "id": arrayResearch[films].id
        },
        dataType: "json",
        success: function(data) {

          var say = "";
          say = data.movie.title;
          synth = window.speechSynthesis;
          var utterThis = new SpeechSynthesisUtterance(say);
          synth.speak(utterThis);

            $('#container').append('<div>')
            $('#container').append('<h2>'+ data.movie.title +'</h2>')
            $('#container').append('<img style="height: 200px; width: 200px" src="' + data.movie.poster + '" />')
            $('#container').append('<p>'+ data.movie.synopsis +'</p>')

            $('#container').append('</div>')
        },
        error : function (err){
          console.log("series ERROR : ", err)
        }
      })
    }
  }else {
    $("#research").text(tvSearch +"S PROPOSÉS")
    var arrayResearch = JSON.parse(localStorage.getItem("TVRSpeech"))
    for(let series=0;series < arrayResearch.length; series++){
      $.ajax({
        type: "GET",
        url: "https://api.betaseries.com/shows/display?key=cb1d200d4a43",
        data :{
          "id": arrayResearch[series].id
        },
        dataType: "json",
        success: function(data) {
          console.log(data)
          var say = "";
          say = data.show.title;
          synth = window.speechSynthesis;
          var utterThis = new SpeechSynthesisUtterance(say);
          synth.speak(utterThis);

            $('#container').append('<div>')
            $('#container').append('<h2>'+ data.show.title +'</h2>')
            $('#container').append('<img style="height: 200px; width: 200px" src="' + data.show.images.show + '" />')
            $('#container').append('<p>'+ data.show.description +'</p>')

            $('#container').append('</div>')
        },
        error : function (err){
          console.log("series ERROR : ", err)
        }
      })
    }

  }


})
</script>


<h1 style="text-align: center;" id="research"> </h1>

<div id="container"> </div>
