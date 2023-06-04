<?php

namespace App\Filament\Resources\ObservationResource\Widgets;

use App\Models\Season;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ParametrePlant extends BaseWidget
{


    protected function getCards(): array
    {
        $season = Season::latest()->first();
        $plant_parametre = $season->plant();
        $duree_floration = $plant_parametre->get("duree_floration")[0]["duree_floration"];
        $duree_nouaison = $plant_parametre->get("duree_nouaison")[0]["duree_nouaison"];
        $duree_debut_recolte = $plant_parametre->get("duree_debut_recolte")[0]["duree_debut_recolte"];
        $duree_fin_recorte = $plant_parametre->get("duree_fin_recorte")[0]["duree_fin_recorte"];
        return [
            Card::make('duree floration',$duree_floration)->description("week"),
            Card::make('duree nouaison',$duree_floration+$duree_nouaison),
            Card::make('duree debut recolte',$duree_floration+$duree_nouaison+$duree_debut_recolte),
            Card::make('duree fin recorte',$duree_floration+$duree_nouaison+$duree_debut_recolte+$duree_fin_recorte),
        ];
    }
}
