<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique(null,email);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        DB::table('users')->insert(
            array(
                array('id' => 1, 'name' => 'Douglas',  'email'=>'doug.d.costa@gmail.com', 'email_verified_at'=> NULL, 'password'=> '$2y$10$uhcdUVopeRI9a.jordHWGuLskgsXcST1WrmirbwrUHF5gFvqbVCTC')
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
