<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::factory(1000)->create();
        \App\Models\Order::factory(1500)->create();

        $orders = Order::all();

        foreach ($orders as $order){
            $product = Product::find(mt_rand(1,1000));

            $product->orders()->attach($order->id,[
                'quantity' => rand(1,5)
            ]);
        }
    }
}
