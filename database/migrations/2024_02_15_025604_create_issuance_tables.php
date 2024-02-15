<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuanceTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issuances', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name')->index();
            $table->smallInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->smallInteger('type')->default(0);
            $table->json('users');
            $table->smallInteger('required_amount');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('group_issuance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->index();
            $table->foreignId('issuance_id')->index();
            $table->smallInteger('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->json('groups');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->index();
            $table->foreignId('group_id')->index();
            $table->smallInteger('type')->default(0);
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
        Schema::dropIfExists('issuances');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('group_issuance');
        Schema::dropIfExists('templates');
        Schema::dropIfExists('approvals');
    }
}
