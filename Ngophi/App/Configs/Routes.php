<?php

return [
    ' ',
    [
        'Controller' => 'Home',
        'Action'    => 'Index'
    ],
    '{Controller}' => 
    [
        'Controller' => '{Controller}',
        'Action'    => 'Index'
    ],
    '{Controller}/{Action}' =>
    [
        'Controller' => '{Controller}',
        'Action'    => '{Action}'
    ],
    '{Controller}/{Action}/{id}' => 
    [
        'Controller' => '{Controller}',
        'Action'    => '{Action}',
        'id'    => '{id}',
    ],
];