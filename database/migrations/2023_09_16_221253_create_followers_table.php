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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete("cascade");
            //laravel hace lo posible por hacer las cosas de la manera mas facil y automatica pero en este caso no puede adivinar que tabla es la que se esta referenciando, por eso se le debe indicar en el metodo constrained el nombre de la tabla a la que se esta referenciando
            $table->foreignId('follower_id')->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
