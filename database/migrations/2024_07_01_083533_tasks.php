<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            /**
             |-------------------------------------------------------
             | references
             | - task status id (task_statuses table)
             | - creator_id (users table)
             |-------------------------------------------------------
             */
            $table->bigInteger('task_status_id');
            $table->bigInteger('creator_id');

            $table->string('title', 100);
            $table->longText('content');
            $table->string('image')->nullable();

            $table->tinyInteger('is_publish')->default(0);

            $table->timestamps();
            $table->softDeletes();

            /**
             |-------------------------------------------------------
             | table index
             |-------------------------------------------------------
             */
            $table->fullText('title');
            $table->index('task_status_id');
            $table->index('is_publish');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
