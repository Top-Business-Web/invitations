<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1)->comment('1 -> لم ترسل , 2-> تم الاستلام, 3-> قرأ ,4 -> فشل');
            $table->enum('type', ['whatsapp', 'qr_code'])->default('whatsapp');
            $table->unsignedBigInteger('invitation_id')->nullable();
            $table->unsignedBigInteger('invitee_id')->nullable();
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
        Schema::dropIfExists('statuses');
    }
}
