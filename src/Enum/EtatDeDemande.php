<?php

namespace App\Enum;

enum EtatDeDemande: string
{
    case ENCOURS = 'en_cours';
    case VALIDER = 'valider';
    case ANNULER = 'annuler';
}
