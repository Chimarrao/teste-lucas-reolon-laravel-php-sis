<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_completo',
        'data_nascimento',
        'tipo_endereco',
        'endereco',
        'cep',
        'numero',
        'complemento',
        'serie',
        'segmento',
        'nome_pai',
        'nome_mae',
        'turma_id'
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    public function setSegmentoAttribute()
    {
        $this->attributes['segmento'] = $this->determineSegmento($this->attributes['serie']);
    }

    private function determineSegmento($serie)
    {
        if (in_array($serie, ['G1', 'G2', 'G3'])) {
            return 'Infantil';
        } elseif (in_array($serie, ['1º', '2º', '3º', '4º', '5º'])) {
            return 'Anos Iniciais';
        } elseif (in_array($serie, ['6º', '7º', '8º', '9º'])) {
            return 'Anos Finais';
        } else {
            return 'Ensino Médio';
        }
    }
}
