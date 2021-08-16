<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbV1 extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->longText('descricao')->nullable();
            $table->tinyInteger('relevante')->default(0);
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
            $table->tinyInteger('relevante')->default(0);
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
            $table->tinyInteger('disponibilidade')->default(0);
            $table->tinyInteger('relevante')->default(0);
            $table->json('imagens')->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->unsignedBigInteger('subcategoria_id');
            $table->foreign('subcategoria_id')->references('id')->on('subcategorias');
            $table->unsignedBigInteger('empresa_parceira_id')->nullable();
            $table->foreign('empresa_parceira_id')->references('id')->on('empresas_parceiras');
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

        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->unsignedBigInteger('desconto_id');
            $table->foreign('desconto_id')->references('id')->on('descontos');
            $table->timestamps();
        });

        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('imagem');
            $table->string('descricao')->nullable();
            $table->string('url')->nullable();
            $table->tinyInteger('ativo')->default(1);
            $table->timestamps();
        });

        Schema::create('entidades', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->longText('descricao')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('subcategorias');
    }
}
