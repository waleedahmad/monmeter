<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\FuelLog;
use App\Models\TankLog;
use App\Models\User;
use Illuminate\Console\Command;

class SyncLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync client fuel consumption logs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $locations = User::where('role','=','admin')
            ->join('user_details','users.id','=', 'user_details.user_id')->get();

        foreach ($locations  as $location){
            $this->log($location->static_ip, $location->user_id );
        }
    }

    public function log($ip, $admin_id){
        $obj = $this->getRawData($ip);
        foreach ($obj->user_levels as $data) {
            $fuel_log = new FuelLog([
                'client_id' =>  $this->getClientId($data->tag),
                'fuel_level' => $data->litres,
                'admin_id' => $admin_id
            ]);
            $fuel_log->save();
        }

        $tank_log = new TankLog([
            'fuel_level' => $obj->current_level,
            'admin_id' => $admin_id
        ]);
        $tank_log->save();
    }

    public function getClientId($tag){
        return Client::where('card_tag','=',$tag)->first()->id;
    }

    public function getRawData($ip){
        return json_decode(file_get_contents('http://'.$ip));
    }
}
