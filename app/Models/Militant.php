<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Militant extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'localite',
        'etablissement',
        'section',
        'sexe',
        'niveau_etude',
        'statut',
        'annee_adhesion',
        'photo',
    ];

    // Génération automatique du matricule à la création
    protected static function booted()
    {
        static::creating(function ($militant) {
            $annee = date('Y');
            $dernier = self::whereYear('created_at', $annee)->max('id') ?? 0;
            $numero = str_pad($dernier + 1, 4, '0', STR_PAD_LEFT);
            $militant->matricule = 'MIL-' . $annee . '-' . $numero;
        });
    }
}
