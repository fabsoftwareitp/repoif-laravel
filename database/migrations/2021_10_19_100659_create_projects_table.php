<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description', 1000)->nullable();
            $table->unsignedTinyInteger('type');
            $table->string('path')->nullable();
            $table->string('path_web')->nullable();
            $table->string('file_name')->nullable();
            $table->string('url')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
