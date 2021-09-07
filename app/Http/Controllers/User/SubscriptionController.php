<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function create()
    {
        $packages = Package::all();
        return view('user.subscription.subscribe', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Package $package)
    {
        $ending_date = Carbon::now()->addDays($package->duration);

        Subscription::create([
            'name' => $package->name,
            'description' => $package->description,
            'price' => $package->price,
            'user_id' => auth()->user()->id,
            'package_id' => $package->id,
            'started_at' => now(),
            'ending_on' => $ending_date,
        ]);
    }
}
