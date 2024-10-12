<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //roles
        $admin = Role::create(['name' => 'Administrator']);
        $author = Role::create(['name' => 'Author']);
        //permisos
        Permission::create(['name' => 'admin.index',"description" => "Ver el Dashboard"])->syncRoles([$admin,$author]);
        /* categorias */
        Permission::create(['name' => 'categories.index',"description" => "Ver categorias"])->syncRoles([$admin,$author]);
        Permission::create(['name' => 'categories.create',"description" => "Crear categorias"])->assignRole($admin);
        Permission::create(['name' => 'categories.edit',"description" => "Editar categorias"])->assignRole($admin);
        Permission::create(['name' => 'categories.destroy',"description" => "Eliminar categorias"])->assignRole($admin);
        /* articulos */
        Permission::create(['name' => 'articles.index',"description" => "Ver artículos"])->syncRoles([$admin,$author]);
        Permission::create(['name' => 'articles.create',"description" => "Crear artículos"])->syncRoles([$admin,$author]);
        Permission::create(['name' => 'articles.edit',"description" => "Editar artículos"])->syncRoles([$admin,$author]);
        Permission::create(['name' => 'articles.destroy',"description" => "Eliminar artículos"])->syncRoles([$admin,$author]);
        /* comentarios */
        Permission::create(['name' => 'comments.index',"description" => "Ver comentarios"])->syncRoles([$admin,$author]);
        Permission::create(['name' => 'comments.destroy',"description" => "Eliminar comentarios"])->syncRoles([$admin,$author]);
        /* Usuarios */
        Permission::create(['name' => 'users.index',"description" => "Ver usuarios"])->assignRole($admin);
        Permission::create(['name' => 'users.edit',"description" => "Editar usuarios"])->assignRole($admin);
        Permission::create(['name' => 'users.destroy',"description" => "Eliminar usuarios"])->assignRole($admin);
    }
}
