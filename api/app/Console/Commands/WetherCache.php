<?php
 
namespace App\Console\Commands;
 
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use App\BL\Wether\IWetherService;
 
class WetherCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wether:cache';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache wether data for every user';

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
     */
    public function handle(IWetherService $wetherService): void
    {
        Log::info('Wether caching command is starting...');
        $REDIS_KEY = config('constants.REDIS_KEY');
        $users = User::all();
        $users->each(function (User $user, int $key) use($wetherService, $REDIS_KEY){
            $key = $REDIS_KEY.$user->id;
            $weather = $wetherService->getWether($user->latitude,$user->longitude);
            if(isset($weather['detailedForecast'])){
                Log::info($user->id);
                Log::info($weather['detailedForecast']);
            }
            Redis::set($key, json_encode($weather));
        });
        Log::info('Wether caching command is ending');
    }
}