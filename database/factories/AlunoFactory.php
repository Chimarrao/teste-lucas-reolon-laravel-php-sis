<?php

namespace Database\Factories;

use App\Models\Aluno;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AlunoFactory extends Factory
{
    // Define o modelo que a factory irá criar
    protected $model = Aluno::class;

    /**
     * Definir o estado padrão da factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome_completo' => $this->faker->name(),
            'data_nascimento' => $this->faker->date('Y-m-d', '2010-01-01'), // data de nascimento entre 2010 e 2022
            'tipo_endereco' => $this->faker->randomElement(['Cobrança', 'Residencial', 'Correspondência']),
            'endereco' => $this->faker->streetAddress(),
            'cep' => $this->faker->postcode(),
            'numero' => $this->faker->buildingNumber(),
            'complemento' => $this->faker->secondaryAddress(),
            'serie' => $this->faker->randomElement(['G1', 'G2', 'G3', '1º', '2º', '3º', '4º', '5º', '6º', '7º', '8º', '9º', '1ºEM', '2ºEM', '3ºEM']),
            'segmento' => $this->faker->randomElement(['Infantil', 'Anos Iniciais', 'Anos Finais', 'Ensino Médio']),
            'nome_pai' => $this->faker->name('male'),
            'nome_mae' => $this->faker->name('female'),
        ];
    }
}
