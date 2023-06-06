<?php

namespace App\Filament\Resources\SeasonResource\Widgets;

use Carbon\Carbon;
use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ParametrePlant extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';
    public ?Model $record = null;

    public function mount(Model $record)
    {
        $this->record = $record;
    }

    protected function getCards(): array
    {
        $plant = $this->record->plant;
        $date_start  =  $this->record->start_day;
        $today = Carbon::today();
        $date = Carbon::createFromFormat('Y-m-d', $date_start);
        $daysDifference = $today->diffInDays($date);
        $weeks = Carbon::now()->addDays($daysDifference)->diffInWeeks();



        $duree_floration = $plant->duree_floration;
        $duree_nouaison = $plant->duree_nouaison;
        $duree_debut_recolte = $plant->duree_debut_recolte;
        $duree_fin_recorte = $plant->duree_fin_recorte;

        return [
            Card::make('Current Week',$weeks),
            Card::make('duree floration', $duree_floration)->description("week"),
            Card::make('duree nouaison', $duree_floration + $duree_nouaison),
            Card::make('duree debutrecolte', $duree_floration + $duree_nouaison + $duree_debut_recolte),
            Card::make('duree fin recolte', $duree_floration + $duree_nouaison + $duree_debut_recolte + $duree_fin_recorte),

        ];
    }
}
