<?php

namespace Database\Factories;

use App\Models\NhanVien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NhanVien>
 */
class NhanVienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ma_nv' => 'NV' . $this->faker->unique()->numberBetween(1000, 9999),
            'ten_nv' => $this->faker->name(),
            'tuoi' => $this->faker->numberBetween(18, 55),
            'sdt' => $this->faker->phoneNumber(), 
        ];
    }
}
