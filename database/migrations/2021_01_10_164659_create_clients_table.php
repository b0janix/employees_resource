<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\ClientSeeder;
use Illuminate\Support\Facades\Artisan;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('client_id')->unique();
            $table->string('client_secret')->unique();
            $table->string('client_name');
            $table->string('redirect_uri');
            $table->string('auth_code')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->timestamps();
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Artisan::call('db:seed', [
            '--class' => ClientSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
