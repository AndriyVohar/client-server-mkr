<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>View medicine</title>
</head>
<body>
    <h1>Medicine #{{ $medicine->id }}</h1>

    <ul>
        <li><strong>Name:</strong> {{ $medicine->name }}</li>
        <li><strong>Manufacturer:</strong> {{ $medicine->manufacturer }}</li>
        <li><strong>Expiration date:</strong> {{ $medicine->expiration_date->format('Y-m-d') }}</li>
        <li><strong>Price:</strong> {{ number_format($medicine->price, 2) }}</li>
    </ul>

    <p>
        <a href="{{ route('medicines.edit', $medicine) }}">Edit</a> |
        <a href="{{ route('medicines.index') }}">Back to list</a>
    </p>
</body>
</html>
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('manufacturer');
            $table->date('expiration_date');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}

