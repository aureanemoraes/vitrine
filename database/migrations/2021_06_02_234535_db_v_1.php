<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbV1 extends Migration
{
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->longText('descricao')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('subcategorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->longText('descricao')->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('restrict')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('empresas_parceiras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->longText('descricao')->nullable();
            $table->string('site')->nullable();
            $table->string('logo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('descontos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('forma_pagamento')->nullable();
            $table->float('porcentagem')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('parcelamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('parcelas')->nullable();
            $table->float('valor_minimo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->longText('descricao')->nullable();
            $table->float('valor')->nullable();
            $table->float('desconto')->nullable();
            $table->tinyInteger('disponibilidade')->default(1);
            $table->tinyInteger('relevante')->default(0);
            $table->json('imagens')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('produtos_descontos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->unsignedBigInteger('desconto_id');
            $table->foreign('desconto_id')->references('id')->on('descontos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('subcategorias');
    }
}
