<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *  الدعوات

         */
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('title');
            $table->text('image')->nullable();
            $table->enum('has_barcode',[0,1])->default(0);
            $table->string('barcode',255)->nullable();
            $table->enum('send_date' ,[0,1])->default(0);
            $table->string('address');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('password',255);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('status' ,[0,1])->default(0);
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
        Schema::dropIfExists('invitations');
    }
}
