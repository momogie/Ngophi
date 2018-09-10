<?php

return [
	[
		'Url'		=> '',
		'Options'	=> [
			'Controller' => 'Home', 'Action' => 'Index'
		]
	],
	[
		'Url'		=> 'Index',
		'Options'	=> [
			'Controller' => 'Home', 'Action' => 'Index'
		]
	],
	[
		'Url'		=> 'SignIn',
		'Options'	=> [
			'Controller' => 'Home', 'Action' => 'SignIn'
		]
	],
	[
		'Url'		=> 'SignOut',
		'Options'	=> [
			'Controller' => 'Home', 'Action' => 'SignOut'
		]
	],
	[
		'Url'		=> 'App/{Action}',
		'Options'	=> [
			'Controller' => 'Home', 'Action' => '{Action}'
		]
	],
	[
		'Url'		=> 'App/{Controller}/{Action}',
		'Options'	=> [
			'Controller' => '{Controller}', 'Action' => '{Action}'
		]
	],
	[
		'Url'		=> 'App/{Controller}/{Action}/{*Id}',
		'Options'	=> [
			'Controller' => '{Controller}', 'Action' => '{Action}' , 'id' => '{*Id}'
		]
	],
	[
		'Url'		=> '{Controller}',
		'Options'	=> [
			'Controller' => '{Controller}', 'Action' => 'Index'
		]
	],
	[
		'Url'		=> '{Controller}/{Action}',
		'Options'	=> [
			'Controller' => '{Controller}', 'Action' => '{Action}'
		]
	],
	[
		'Url'		=> '{Controller}/{Action}/{Id}',
		'Options'	=> [
			'Controller' => '{Controller}', 'Action' => '{Action}', 'id' => '{Id}'
		]
	],
	[
		'Url'		=> '{Directory}/{Controller}',
		'Options'	=> [
			'Directory'		=> '{Directory}',
			'Controller' 	=> '{Controller}', 
			'Action' 		=> 'Index'
		]
	],
	[
		'Url'		=> '{Directory}/{Controller}/{Action}',
		'Options'	=> [
			'Directory'		=> '{Directory}',
			'Controller' 	=> '{Controller}', 
			'Action' 		=> '{Action}'
		]
	],
	[
		'Url'		=> '{Directory}/{Controller}/{Action}/{id}',
		'Options'	=> [
			'Directory'		=> '{Directory}',
			'Controller' 	=> '{Controller}', 
			'Action' 		=> '{Action}',
			'id'			=> '{id}'
		]
	]
];
