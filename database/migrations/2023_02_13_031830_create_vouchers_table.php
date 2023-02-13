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
      Schema::create('vouchers', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique()->index();
        $table->string('reward_id')->nullable();
        $table->string('reward_name')->nullable();
        $table->string('reward_image')->nullable();
        $table->string('username')->index();
        $table->string('status')->index();
        $table->timestamp('used_at')->nullable();
        $table->timestamp('claim_at')->nullable();
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
        Schema::dropIfExists('vouchers');
    }
};