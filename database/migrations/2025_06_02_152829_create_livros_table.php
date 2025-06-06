<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("livros", function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("isbn")->unique()->nullable();
            $table->integer("ano_publicacao")->nullable();
            $table->text("sinopse")->nullable();

            $table->foreignId("autor_id")
                  ->constrained("autores")
                  ->onDelete("cascade");

            $table->foreignId("genero_id")
                  ->nullable()
                  ->constrained("generos")
                  ->onDelete("set null");

            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};

