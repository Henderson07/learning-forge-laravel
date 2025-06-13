<?php

namespace App\Models;

use App\Enums\PersonEnum;
use Illuminate\Support;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'peoples';

    /**
     * Retorna uma coleção de itens associados
     *
     * @return Illuminate\Support\Collection
     */
    public static function getAllPersons(): Collection
    {
        return Person::whereNotNull('name')->get();
    }

    /**
     * Retorna uma coleção de itens de acordo com o tipo associado
     * Ex: Person::juridic->get();
     * @return Illuminate\Support\Collection
     */
    public function scopeFisic(Builder $query): Builder
    {
        return $query->where('type', PersonEnum::TYPE_FISIC);
    }

    /**
     * Retorna uma coleção de itens de acordo com o tipo associado
     * Ex: Person::juridic->get();
     * @return Illuminate\Support\Collection
     */
    public function scopeJuridic(Builder $query): Builder
    {
        return $query->where('type', PersonEnum::TYPE_JURIDIC);
    }
}
