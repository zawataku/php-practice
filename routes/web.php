<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// $html = <<<'EOF'
// <html>
//     <head>
//         <title>Laravel Test</title>
//         <style>
//             body {
//                 font-size: 16pt;
//                 color: #999;
//             }
//             h1 {
//                 font-size: 100pt;
//                 text-align: right;
//                 color: #eee;
//                 margin: -40px 0px -50px 0px;
//             }
//         </style>
//     </head>
//     <body>
//         <h1>Hello Laravel</h1>
//         <p>This is Laravel Sample Page</p>
//     </body>
// </html>
// EOF;

// Route::get('/hello', function () use ($html) {
//     return $html;
// });

Route::get('/hello/{msg?}', function ($msg = 'no message...') {
    // $html = <<<'EOF' これだとダメ
    $html = <<<EOF
    <html>
        <head>
            <title>Laravel Test</title>
            <style>
                body {
                    font-size: 16pt;
                    color: #999;
                }
                h1 {
                    font-size: 100pt;
                    text-align: right;
                    color: #eee;
                    margin: -40px 0px -50px 0px;
                }
            </style>
        </head>
        <body>
            <h1>Hello Laravel</h1>
            <p>This is Laravel Sample Page</p>
            <p>{$msg}</p>
        </body>
    </html>
    EOF;

    return $html;
});
