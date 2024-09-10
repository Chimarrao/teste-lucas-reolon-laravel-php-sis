<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_turma',
        'turno',
        'quantidade_vagas',
        'ano_letivo',
        'serie',
    ];

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    public function vagasDisponiveis()
    {
        return $this->quantidade_vagas - $this->matriculas()->count();
    }
}
