<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('image')->nullable();
            $table->string('sku')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('stock')->default(0);
            $table->timestamps();
        });

        // Insert some sample products for testing
        DB::table('products')->insert([
            [
                'name' => 'Laptop',
                'description' => 'High-performance laptop for professionals',
                'price' => 1299.99,
                'image' => 'laptop.jpg',
                'sku' => 'TECH-001',
                'is_active' => true,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse',
                'price' => 49.99,
                'image' => 'mouse.jpg',
                'sku' => 'ACC-001',
                'is_active' => true,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop Bag',
                'description' => 'Water-resistant laptop bag with multiple compartments',
                'price' => 79.99,
                'image' => 'laptop-bag.jpg',
                'sku' => 'ACC-002',
                'is_active' => true,
                'stock' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'USB-C Dock',
                'description' => 'Multi-port USB-C dock for laptops',
                'price' => 129.99,
                'image' => 'usb-dock.jpg',
                'sku' => 'ACC-003',
                'is_active' => true,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'External SSD',
                'description' => '1TB External SSD with USB 3.1',
                'price' => 159.99,
                'image' => 'external-ssd.jpg',
                'sku' => 'STORAGE-001',
                'is_active' => true,
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
