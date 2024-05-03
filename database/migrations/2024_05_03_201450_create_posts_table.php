<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id');
            // or
            // $table->unsignedBigInteger('user_id');

            // $table->foreign('user_id')->references('id')->on('users')
            //     ->cascadeOnUpdate()->restrictOnDelete();
            // or 
            $table->foreignIdFor(User::class); //then laravel will handle automically


            $table->string('image');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->timestamp('published_at')->nullable();
            $table->boolean('featured')->default(false);
            $table->softDeletes();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
