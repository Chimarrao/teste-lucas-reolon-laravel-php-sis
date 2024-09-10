<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turma>
 */
class TurmaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_turma' => $this->faker->unique()->word(), // Nome único para a turma
            'turno' => $this->faker->randomElement(['Manhã', 'Tarde', 'Integral']), // Turnos possíveis
            'quantidade_vagas' => $this->faker->numberBetween(20, 40), // Quantidade de vagas aleatória
            'ano_letivo' => $this->faker->year(), // Gera um ano letivo
            'serie' => $this->faker->randomElement(['G1', 'G2', 'G3', '1º', '2º', '3º', '4º', '5º', '6º', '7º', '8º', '9º', '1ºEM', '2ºEM', '3ºEM']), // Série escolar
        ];
    }
}
