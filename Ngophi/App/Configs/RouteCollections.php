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
		'Url'		=> '{Action}',
		'Options'	=> [
			'Controller' => 'Home', 'Action' => '{Action}'
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
