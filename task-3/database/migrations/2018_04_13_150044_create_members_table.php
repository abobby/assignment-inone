<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 80);
            $table->string('last_name', 80);
            $table->string('email', 100)->unique();
            $table->bigInteger('phone')->nullable();
            $table->timestamps();
            $table->tinyInteger('status');
            
            /*Defined Table Indexes below*/
            $table->index('first_name', 'members_first_name');
            $table->index('last_name', 'members_last_name');
            $table->index(['first_name', 'last_name'], 'members_full_name');
            $table->index('phone', 'members_phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
