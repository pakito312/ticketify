<?php

namespace Paki\Ticketify\Console\Commands;

use Illuminate\Console\Command;

class InstallTicketify extends Command
{
    protected $signature = 'ticketify:install';
    protected $description = 'Installer et configurer le package Ticketify';

    public function handle()
    {
        $this->info('Installation de Ticketify...');
        
        // Publier les fichiers de configuration
        $this->call('vendor:publish', [
            '--provider' => "Paki\Ticketify\TicketifyServiceProvider"
        ]);

        // Appliquer les migrations
        $this->call('migrate');

        $this->info('Ticketify a été installé avec succès !');
    }
}
