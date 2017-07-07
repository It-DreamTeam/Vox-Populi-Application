var geocityfr = "";

  $(".buttonRec").on('click', function() {
    $(this).toggleClass("active");
    switchRecognition();
  });

var accessToken = "4b8289d60d15475f8380de1d4086aff6";
var baseUrl = "https://api.api.ai/v1/";
$(document).ready(function() {
  $("#input").keypress(function(event) {
    if (event.which == 13) {
      event.preventDefault();
      send();
    }
  });
  $("#rec").click(function(event) {
    switchRecognition();
  });
});
var recognition;
function startRecognition() {
  recognition = new webkitSpeechRecognition();
  recognition.onstart = function(event) {
    updateRec();
    $('#city').val('');
    $('#input').val('');
  };
  recognition.onresult = function(event) {
    var text = "";
      for (var i = event.resultIndex; i < event.results.length; ++i) {
        text += event.results[i][0].transcript;
      }
      setInput(text);
    stopRecognition();
  };
  recognition.onend = function() {
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
        if(data.result.parameters.geocityfr != undefined && data.result.fulfillment.speech == "") {
					setInput2(data.result.parameters.geocityfr);
          geocityfr = data.result.parameters.geocityfr;
          localStorage.setItem('geocityfr', data.result.parameters.geocityfr);
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
  console.log("Loading...");
}
