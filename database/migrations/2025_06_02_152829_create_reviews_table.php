<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("reviews", function (Blueprint $table) {
            $table->id();
            $table->text("texto");

            $table->tinyInteger("nota"); 

            $table->foreignId("livro_id")
                  ->constrained("livros")
                  ->onDelete("cascade");

            $table->foreignId("usuario_id")
                  ->constrained("usuarios")
                  ->onDelete("cascade");

            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};

