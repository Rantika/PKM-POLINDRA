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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('reviewer_id')->nullable();
            $table->unsignedBigInteger('lecturer_id');
            $table->unsignedBigInteger('scheme_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->string('file_review')->nullable();
            $table->string('status');
            $table->tinyInteger("approved")->default(0);
            $table->string('year');
            $table->boolean('is_confirmed');
            $table->string('username_simbelmawa')->nullable();
            $table->string('password_simbelmawa')->nullable();
            $table->string('fund_value')->nullable();
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
        Schema::dropIfExists('proposals');
    }
};
