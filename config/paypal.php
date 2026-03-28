<?php 
return [ 
    'client_id' => env('PAYPAL_CLIENT_ID','AdWgOBu3rM9lu7R8bopg49B_TkW6hUKLNPi-j7t4CzyWG5gHith2MznCm7QVzgbCjcdDw6dj-vskxYep'),
    'secret' => env('PAYPAL_SECRET','EBr_jir51XIcj2pgsiF8cGs0DAKW6IPuV1P81Gh_T1_QfeiNj1yL8T8gU98_nt-Q0UdZsOEYfoevjkij'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];