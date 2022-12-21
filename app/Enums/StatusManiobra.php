<?php

namespace App\Enums;

enum StatusManiobra: string
{
    case COMPLETA = '1';
    case PENDIENTE = '2';
    case INCOMPLETA = '3';
}
