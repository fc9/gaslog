<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->string('name')->nullable();
            $table->string('group_address_state')->nullable();
            $table->string('group_address_city')->nullable();
            $table->string('group_type')->nullable();
            $table->string('group_organization')->nullable();
//            $table->tinyInteger('previous_participant', 1)->nullable();
//            $table->tinyInteger('recurring_participant', 1)->nullable();
            $table->json('disabilities')->nullable();
            $table->string('others_disabilities')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
