<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
           'remember_token' => Str::random(10),
        ];

    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

     /**
     * Estado personalizado para un usuario administrador.
     */
    public function administrador(): Factory
    {
        return $this->state([
            'name' => 'Administrador',
            'email' => 'admin@cobros.com',
            'password' => Hash::make('admin123'),
        ]);
    }

    /**
     * Estado personalizado para un usuario invitado.
     */
    public function invitado(): Factory
    {
        return $this->state([
            'name' => 'Invitado',
            'email' => 'invitado@cobros.com',
            'password' => Hash::make('guest123'),
        ]);
    }


}
