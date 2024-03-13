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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('merek');
            $table->enum('jenis', ['SUV', 'Sedan'])->default('SUV');
            $table->integer('stok');
            $table->double('price', 100, 2);
            $table->string('keterangan');
            $table->timestamps();
        });

        $defaultCarRows = [
            [
                'merek'         => 'Toyota',
                'jenis'         => 'Sedan',
                'stok'          => 5,
                'price'         => 54000000,
                'keterangan'    => 'Mobil Sedan Toyota',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'merek'         => 'Daihatsu',
                'jenis'         => 'SUV',
                'stok'          => 10,
                'price'         => 50000000,
                'keterangan'    => 'Mobil Sedan SUV',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        DB::table('cars')->insert($defaultCarRows);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
