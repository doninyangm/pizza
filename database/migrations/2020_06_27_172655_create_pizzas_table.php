<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Pizza;

class CreatePizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('size');
            $table->string('image');
            $table->decimal('price_euro');
            $table->decimal('price_dollar');
            $table->longText('description');
            $table->timestamps();
        });

        Pizza::create([
            'name' => 'Margherita',
            'size'  => 'Medium',
            'image' => 'img/1.jpg',
            'price_dollar' => 20.00,
            'price_euro' => 15.00,
            'description' => 'A hugely popular margherita, with a deliciously tangy single cheese topping.'
        ]);

        Pizza::create([
            'name' => 'Margherita',
            'size'  => 'Small',
            'image' => 'img/1.jpg',
            'price_dollar' => 15.00,
            'price_euro' => 10.00,
            'description' => 'A hugely popular margherita, with a deliciously tangy single cheese topping.'
        ]);

        Pizza::create([
            'name' => 'Double Cheese Margherita.',
            'size'  => 'Medium',
            'image' => 'img/1.jpg',
            'price_dollar' => 30.00,
            'price_euro' => 25.00,
            'description' => 'The ever-popular Margherita - loaded with extra cheese... oodies of it!'
        ]);

        Pizza::create([
            'name' => 'Farm House',
            'size'  => 'Large',
            'image' => 'img/2.jpg',
            'price_dollar' => 50.00,
            'price_euro' => 25.00,
            'description' => 'A pizza that goes ballistic on veggies! Check out this mouth watering overload of crunchy, crisp capsicum, succulent mushrooms and fresh tomatoes'
        ]);

        Pizza::create([
            'name' => 'Peppy Paneer',
            'size'  => 'Large',
            'image' => 'img/3.jpg',
            'price_dollar' => 23.00,
            'price_euro' => 19.00,
            'description' => 'Chunky paneer with crisp capsicum and spicy red pepper - quite a mouthful!'
        ]);

        Pizza::create([
            'name' => 'Mexican Green Wave',
            'size'  => 'Large',
            'image' => 'img/Mexican_Green_Wave.jpg',
            'price_dollar' => 23.00,
            'price_euro' => 19.00,
            'description' => 'Chunky paneer with crisp capsicum and spicy red pepper - quite a mouthful!'
        ]);

        Pizza::create([
            'name' => 'Deluxe Veggie',
            'size'  => 'Medium',
            'image' => 'img/Deluxe_Veggie.jpg',
            'price_dollar' => 23.00,
            'price_euro' => 19.00,
            'description' => "For a vegetarian looking for a BIG treat that goes easy on the spices, this one's got it all.. The onions, the capsicum, those delectable mushrooms - with paneer and golden corn to top it all."
        ]);

        Pizza::create([
            'name' => 'Veg Extravaganza',
            'size'  => 'Medium',
            'image' => 'img/Veg_Extravaganz.jpg',
            'price_dollar' => 23.00,
            'price_euro' => 19.00,
            'description' => "A pizza that decidedly staggers under an overload of golden corn, exotic black olives, crunchy onions, crisp capsicum, succulent mushrooms, juicyfresh tomatoes and jalapeno - with extra cheese to go all around."
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizzas');
    }
}
