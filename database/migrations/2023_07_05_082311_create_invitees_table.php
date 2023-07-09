<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInviteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *  الاشخاص المدعوين

         */
        Schema::create('invitees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invitation_id')->nullable();
            $table->unsignedBigInteger('invitee_id')->nullable();
            $table->string('name');
            $table->text('phone');
            $table->integer('invitees_number')->default(1);

            $table->foreign('invitation_id')->references('id')->on('invitations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('invitee_id')->references('id')->on('invitees')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('status')->default(1)->comment('1 -> الانتظار , 2-> مأكد, 3-> تم الاعتذار ,4 -> لم يتم الارسال,5 -> فشل');
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
        Schema::dropIfExists('invitees');
    }
}
