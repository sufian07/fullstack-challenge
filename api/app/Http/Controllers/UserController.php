<?php
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller {
    /**
     * Show the profile for a given user.
     */
    public function list() {
        Log::info('User list api is called');

        return response()->json([
            'message' => 'all systems are a go',
            'users' => User::all(),
        ]);
    }
    /**
     * Show the profile for a given user.
     */
    public function show(string $id) {
        $REDIS_KEY = config('constants.REDIS_KEY');
        $user = User::where('id', $id)->firstOrFail();
        $key = $REDIS_KEY.$user->id;
        return  Redis::get($key);
    }
}