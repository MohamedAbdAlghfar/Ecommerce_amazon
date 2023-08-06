<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [ 
            'f_name' => fake()->name(),    
            'l_name' => fake()->name(),
            'phone' => fake()->PhoneNumber(),
            'gender' => fake()->randomElement([0,1]),
            'address' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => fake()->randomElement([0,1,2,3,4]),
            'profile_image' => fake()->randomElement([
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

   
   
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
