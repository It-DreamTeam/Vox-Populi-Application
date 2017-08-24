<?php $this->assign('title', "Recherche"); ?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app');?>

<?= $this->Flash->render() ?>

<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

<script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>


<a style="color: black;" href="/connexion/logout"> Déconnexion </a>

<h1 style="text-align: center; font-family: 'Indie Flower', cursive; font-size: 4em;" > Hello <?= $this->request->session()->read('firstName') ?></h1>
<div class="overlay">
	<div id="body_corp">
		<input id="input" type="text" placeholder='Dite "Météo à" + nom de la ville !'>
		<div class="buttonRec">
			<div class="innerRec">
			</div>
		</div>
		<input type="text" name="city" placeholder="Saisissez une ville" id="city" class="hide">
	</div>
</div>

<?=$this->Html->script('recognition');?>

<script>
// GET CURRENT POSITION
$(document).ready(function() {
if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      alert("Geolocation is not supported by this browser.");
    }
})

function showPosition(position) {
		$.ajax({ url:'http://maps.googleapis.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&sensor=true',
         success: function(data){
					 console.log(data.results[0])
	         for (var i = 0; i < data.results[4].address_components.length; i++) {
    			 	for (var j = 0; j < data.results[4].address_components[i].types.length; j++) {
        			if(data.results[4].address_components[i].types[j] == 'locality') {
            		var city_name = data.results[4].address_components[i].long_name;
            		alert(city_name);
        		}
    			}
				}
		   }
		})
}
</script>
