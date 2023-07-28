<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_id  = User::all()->random()->id;
       
       
       
       
        return [
            'name' => fake()->name(),  
            'phone' => fake()->PhoneNumber(),
            'about_store' => fake()->paragraph(),  
            'link_website' => fake()->url(),
            'services' => fake()->paragraph(),
            'location' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'user_id' => $user_id ,
            'store_cover' => fake()->randomElement([
                'https://m.media-amazon.com/images/I/61iQu0VHEWL._AC_UL480_FMwebp_QL65_.jpg',
                'https://m.media-amazon.com/images/I/61xW8gDKGGL._AC_UL480_FMwebp_QL65_.jpg',
                'https://m.media-amazon.com/images/I/71JouV4uIVL._AC_UL480_FMwebp_QL65_.jpg',
                'https://images-eu.ssl-images-amazon.com/images/G/42/Egypt-hq/2022/img/Consumer_Electronics/PC/1483263_EG_PCRevamp_L2_Desktop-03.jpg',
                'https://m.media-amazon.com/images/I/61LjHM2KxfL._AC_UL480_QL65_.jpg',
                'https://m.media-amazon.com/images/I/61Gp0PLpnTL._AC_UL480_QL65_.jpg',
                'https://images-eu.ssl-images-amazon.com/images/G/02/AISExports_UK_GW/Desktop/AIS_GW_DESKTOP_CATCARD_BOOKS_378x304._SY304_CB642486522_.jpg',
                'https://m.media-amazon.com/images/I/410pPI-1NRL._SY500__AC_SY230_.jpg',
                'https://m.media-amazon.com/images/I/4165BwTcQzL._AC._SR360,460.jpg',
                'https://m.media-amazon.com/images/I/71tduSp8ooL._AC._SR360,460.jpg']),
            'store_image' => fake()->randomElement([
                'https://m.media-amazon.com/images/I/61iQu0VHEWL._AC_UL480_FMwebp_QL65_.jpg',
                'https://m.media-amazon.com/images/I/61xW8gDKGGL._AC_UL480_FMwebp_QL65_.jpg',
                'https://m.media-amazon.com/images/I/71JouV4uIVL._AC_UL480_FMwebp_QL65_.jpg',
                'https://images-eu.ssl-images-amazon.com/images/G/42/Egypt-hq/2022/img/Consumer_Electronics/PC/1483263_EG_PCRevamp_L2_Desktop-03.jpg',
                'https://m.media-amazon.com/images/I/61LjHM2KxfL._AC_UL480_QL65_.jpg',
                'https://m.media-amazon.com/images/I/61Gp0PLpnTL._AC_UL480_QL65_.jpg',
                'https://images-eu.ssl-images-amazon.com/images/G/02/AISExports_UK_GW/Desktop/AIS_GW_DESKTOP_CATCARD_BOOKS_378x304._SY304_CB642486522_.jpg',
                'https://m.media-amazon.com/images/I/410pPI-1NRL._SY500__AC_SY230_.jpg',
                'https://m.media-amazon.com/images/I/4165BwTcQzL._AC._SR360,460.jpg',
                'https://m.media-amazon.com/images/I/71tduSp8ooL._AC._SR360,460.jpg']),




        ];
    }
}
