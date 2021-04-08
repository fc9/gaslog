<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->unsignedInteger('group_id')->change();
            $table->tinyInteger('code')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('image_file')->nullable();
            $table->longText('text_field_1')->nullable();
            $table->longText('text_field_2')->nullable();
            $table->longText('text_field_3')->nullable();
            $table->longText('video_link')->nullable();
            $table->integer('allows_card')->nullable();
            $table->integer('allows_votes')->nullable();
            $table->integer('email_feedback')->nullable();
            $table->integer('is_public')->nullable();
            $table->integer('is_approved')->nullable()->default(0);
            $table->integer('is_moderated')->default(0);
            $table->bigInteger('curtidas');
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('group_id')->references('id')->on('groups')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
