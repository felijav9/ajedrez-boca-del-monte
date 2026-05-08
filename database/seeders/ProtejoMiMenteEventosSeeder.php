<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Permission;
use Spatie\Permission\Models\Role;

class ProtejoMiMenteEventosSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | PAGINA PADRE
        |--------------------------------------------------------------------------
        */

        $paginaAjedrez = Page::where(
            'permission_name',
            'page.view.protejo-mi-mente'
        )->first();

        if (!$paginaAjedrez) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | PERMISOS
        |--------------------------------------------------------------------------
        */

        $permisos = [
            'page.view.protejo-mi-mente.registro-eventos-torneo',
            'page.view.protejo-mi-mente.registro-rondas',
            'page.view.protejo-mi-mente.registro-partidas',
            'page.view.protejo-mi-mente.registro-clasificaciones-evento',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso
            ], [
                'guard_name' => 'web',
                'module' => 'menu'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ASIGNAR PERMISOS A SYSADMIN
        |--------------------------------------------------------------------------
        */

        $sysadmin = Role::where('name', 'Sysadmin')->first();

        if ($sysadmin) {
            $sysadmin->givePermissionTo($permisos);
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINAS
        |--------------------------------------------------------------------------
        */

        Page::firstOrCreate([
            'route' => 'protejo-mi-mente.registro-eventos-torneo'
        ], [
            'label' => 'Registro eventos torneo',
            'icon' => 'document-text',
            'order' => 7,
            'type' => 'page',
            'permission_name' => 'page.view.protejo-mi-mente.registro-eventos-torneo',
            'page_id' => $paginaAjedrez->id
        ]);

        Page::firstOrCreate([
            'route' => 'protejo-mi-mente.registro-rondas'
        ], [
            'label' => 'Registro rondas',
            'icon' => 'document-text',
            'order' => 8,
            'type' => 'page',
            'permission_name' => 'page.view.protejo-mi-mente.registro-rondas',
            'page_id' => $paginaAjedrez->id
        ]);

        Page::firstOrCreate([
            'route' => 'protejo-mi-mente.registro-partidas'
        ], [
            'label' => 'Registro partidas',
            'icon' => 'document-text',
            'order' => 9,
            'type' => 'page',
            'permission_name' => 'page.view.protejo-mi-mente.registro-partidas',
            'page_id' => $paginaAjedrez->id
        ]);

        Page::firstOrCreate([
            'route' => 'protejo-mi-mente.registro-clasificaciones-evento'
        ], [
            'label' => 'Clasificaciones evento',
            'icon' => 'document-text',
            'order' => 10,
            'type' => 'page',
            'permission_name' => 'page.view.protejo-mi-mente.registro-clasificaciones-evento',
            'page_id' => $paginaAjedrez->id
        ]);


        Page::where(
            'route',
            'protejo-mi-mente.registro-resultados-individuales'
        )->update([
            'order' => 6
        ]);

    }
}