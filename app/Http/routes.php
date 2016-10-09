<?php
Route::get('/',function(){
	echo "WELCOME TO MYBACKEND";
});

include __DIR__.'/admin_routes.php';

