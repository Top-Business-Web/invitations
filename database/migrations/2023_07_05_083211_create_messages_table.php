<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * رسائل الاشخاص تم مشاركه الدعوه معهم

         */
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invitation_id')->nullable();
            $table->unsignedBigInteger('invitee_id')->nullable();
            $table->string('title')->nullable();
            $table->text('message');
            $table->foreign('invitation_id')->references('id')->on('invitations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('invitee_id')->references('id')->on('invitees')->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
