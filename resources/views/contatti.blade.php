@extends('layouts.public')

@section('title', 'Contatti')

@section('content')

<div class="container-contatti">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    
	<div class="contatti">
		<h1>Contatti</h1>
		<div class="contact-info">
			<h2>Coupon</h2>
			<p><i class="fa fa-map-marker"></i>1355 Market St, San Francisco, Stati Uniti</p>
			<p><i class="fa fa-phone"></i>+39 327-8124810</p>
			<p><i class="fa fa-envelope"></i>coupon-fantastici@gmail.com</p>
		</div>	
	</div>	

	<div class="mappa">
		<iframe class="frame-mappa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.5659225124473!2d-122.41920122418429!3d37.77677517198483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808f7fd45c5f5a7b%3A0xc7e1387c31869f08!2sMicrosoft!5e0!3m2!1sit!2sit!4v1683819902333!5m2!1sit!2sit" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
</div>

@endsection