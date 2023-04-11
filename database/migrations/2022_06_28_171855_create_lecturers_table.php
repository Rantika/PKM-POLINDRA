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
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('prody_id');
            $table->string('name');
            $table->string('nip')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_active');
            $table->boolean('is_reviewer');
            $table->boolean('is_dosbing');
            $table->string('username_simbelmawa')->nullable();
            $table->string('password_simbelmawa')->nullable();
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
        Schema::dropIfExists('lecturers');
    }
};
