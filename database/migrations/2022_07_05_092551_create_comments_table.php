<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('step_comment_id');
            $table->unsignedBigInteger('proposal_id');
            $table->text('cover')->nullable();
            $table->text('kata_pengantar')->nullable();
            $table->text('bab_1')->nullable();
            $table->text('bab_2')->nullable();
            $table->text('bab_3')->nullable();
            $table->text('daftar_pustaka')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
