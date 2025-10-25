<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RebuildSearchIndexes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rebuild-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creando indices para meilisearch';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Eliminando todos los índices...');
        Artisan::call('scout:delete-all-indexes');
        $this->info('Índices eliminados.');

        $this->info('Sincronizando configuraciones de índice...');
        Artisan::call('scout:sync-index-settings');
        $this->info('Configuraciones sincronizadas.');

        $this->info('Importando registros a los índices...');
        Artisan::call('scout:import', ['model' => 'App\Models\Product']);
        Artisan::call('scout:import', ['model' => 'App\Models\User']);
        // Agrega todos tus modelos que sean "searchable"
        $this->info('Importación completada.');

        $this->info('Todos los índices se han reconstruido correctamente ✅');
    }
}
