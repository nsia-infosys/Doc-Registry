<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('permission_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type', ]);

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('role_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type', ]);

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));

            DB::table('permissions')->insert(array(
                array('id' => 1, 'name' => 'View Book', 'guard_name' => 'web', 'created_at' => '2019-03-26 06:43:25', 'updated_at' => '2019-03-26 06:43:25'),
                array('id' => 2, 'name' => 'Edit Book', 'guard_name' => 'web', 'created_at' => '2019-03-26 06:43:25', 'updated_at' => '2019-03-26 06:43:25'),
                array('id' => 3, 'name' => 'Delete Book', 'guard_name' => 'web', 'created_at' => '2019-03-26 06:43:25', 'updated_at' => '2019-03-26 06:43:25')
            ));

            DB::table('roles')->insert(array(
                array('id' => 1, 'name' => 'Admin', 'guard_name' => 'web', 'created_at' => '2019-03-26 06:43:25', 'updated_at' => '2019-03-26 06:43:25'),
                array('id' => 2, 'name' => 'Manager', 'guard_name' => 'web', 'created_at' => '2019-03-26 06:43:25', 'updated_at' => '2019-03-26 06:43:25'),
                array('id' => 3, 'name' => 'Supervisor', 'guard_name' => 'web', 'created_at' => '2019-03-26 06:43:25', 'updated_at' => '2019-03-26 06:43:25'),
                array('id' => 4, 'name' => 'Scanner', 'guard_name' => 'web', 'created_at' => '2019-03-26 06:43:25', 'updated_at' => '2019-03-26 06:43:25'),
                array('id' => 5, 'name' => 'Data Entry', 'guard_name' => 'web', 'created_at' => '2019-03-26 06:43:25', 'updated_at' => '2019-03-26 06:43:25')
            ));

            DB::table('role_has_permissions')->insert(array(
                array('permission_id' => 1, 'role_id' => 1),
                array('permission_id' => 2, 'role_id' => 1),
                array('permission_id' => 3, 'role_id' => 1)
            ));

            DB::table('model_has_roles')->insert(array(
                array('role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 1),
                array('role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 1),
                array('role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => 1),
                array('role_id' => 4, 'model_type' => 'App\Models\User', 'model_id' => 1),
                array('role_id' => 5, 'model_type' => 'App\Models\User', 'model_id' => 1)
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
