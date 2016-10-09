@php

$notifs = ['success','info','danger'];

foreach($notifs as $notif)
{
	if(Session::has($notif))
	{
		echo '<div class="alert alert-'.$notif.'">
		  		'.Session::get($notif).'
			  </div>';			
	}
}

@endphp


@if(@$errors->any())
		<div class = 'alert alert-danger'>
		    <ul>
		    	@foreach(@$errors->all() as $error)
		    		<li>{{ $error }}</li>
		    	@endforeach
		    </ul>
		</div>
@endif