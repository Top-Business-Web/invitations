<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *  الاشعارات

         */
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->unsignedBigInteger('invitation_id')->nullable();
            $table->unsignedBigInteger('invitee_id')->nullable();
            $table->json('user_id');
            $table->longText('image')->nullable();
            $table->enum('type',['note','message'])->default('note')->comment('note =>notification , message=> message');
            $table->foreign('invitation_id')->references('id')->on('invitations')->cascadeOnUpdate()->cascadeOnDelete();            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
