<?php

return [
    'layout_font' => 'layouts.app', // Permet de définir le layout admin
    'layout_admin' => 'layouts.app', // Permet de définir le layout principal
    'section_admin' => 'content', // Permet de définir la section où injecter le contenu admin
    'section_font' => 'content', // Permet de définir la section où injecter le contenu principal
    'admin_notification_email' => env('ADMIN_NOTIFICATION_EMAIL', 'admin@example.com'),
    'user_model' => App\Models\User::class,
];
