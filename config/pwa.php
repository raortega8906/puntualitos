<?php

return [
    'name' => 'Puntualitos',            // Nombre de la PWA
    'short_name' => 'LaravelApp',                 // Nombre corto que aparece en la pantalla de inicio
    'theme_color' => '#17630e',                   // Color del tema para la barra de estado
    'background_color' => '#ffffff',              // Color de fondo de la pantalla de inicio
    'start_url' => '/',                           // URL de inicio de la PWA
    'display' => 'standalone',                    // Modo de visualización, puede ser 'fullscreen', 'standalone', 'minimal-ui'
    'icons' => [                                  // Iconos para la PWA
        [
            "src" => "/favicon-not.png",
            "sizes" => "75x75",
            "type" => "image/png"
        ],
    ],
    'service_worker' => true,
];