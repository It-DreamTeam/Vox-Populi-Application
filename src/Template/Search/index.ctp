<?php $this->assign('title', "Recherche"); ?>
<?=$this->Html->script('jquery-3.2.1');?>
<?=$this->Html->css('https://fonts.googleapis.com/css?family=Open+Sans:400,300,700');?>
<?=$this->Html->css('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i" rel="stylesheet');?>
<?=$this->Html->css('style');?>
<?=$this->Html->css('app');?>
<?=$this->Html->css('login');?>
<?= $this->Flash->render() ?>
<script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>

<div class="row center-lg center-xs">
    <div class="col-lg-6">
        <a href="/connexion/logout" class="btn-signout"> Sign out <span><?=$this->Html->image('sign-out.png');?></span></a>
    </div>
    <div class="col-lg-6 user-info">
        <span class="user-name">Barack OBAMA</span>
        <div class="user-img">
            <?=$this->Html->image('user-img.jpg');?>
        </div>
    </div>
</div>
<div class="row center-xs logo">
    <div class="col-xs-6">
        <div class="box">
            <?=$this->Html->image('sun.png');?>
            <div class="">
                <h1>Moodify app</h1>
                <h2>Bonjour, <?= $this->request->session()->read('firstName') ?></h2>
            </div>
        </div>
    </div>
</div>
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
