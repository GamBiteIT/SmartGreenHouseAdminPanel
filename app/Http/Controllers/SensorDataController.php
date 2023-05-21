<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Parametre;
use App\Models\SensorData;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;
use App\Http\Requests\UpdateSensorDataRequest;

class SensorDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new SensorData;

        $data->season_id = $request->season_id;
        $data->humidity = $request->humidity;
        $data->temperature = $request->temperature;
        $data->soil = $request->soil;
        $data->light = $request->light;

        $data->save();
        $parametre = Parametre::latest()->first();

        if($request->temperature>$parametre['TemperatureValeur']){
            Notification::make()
            ->title('Hot Temperature Detected')
            // ->icon('heroicon-o-sun')
            ->body("Temperature is {$request->temperature} °C")
            ->sendToDatabase(User::first());
        }



        return response()->json([
            'data' => $data,
            'message' => 'Plant record created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SensorData $sensorData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SensorData $sensorData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSensorDataRequest $request, SensorData $sensorData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SensorData $sensorData)
    {
        //
    }
}
