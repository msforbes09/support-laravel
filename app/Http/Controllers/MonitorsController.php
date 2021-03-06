<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Computer;
use App\Monitor;

class MonitorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Computer $computer)
    {
        $this->authorize('create', Monitor::class);

        return view('computers.accessories.monitor', compact('computer'))
            ->with('monitors', Monitor::all());
    }

    public function store(Request $request)
    {
        $this->authorize('create', Monitor::class);

        $request->validate([ 'monitorName' => 'required|min:5|unique:monitors' ]);
        
        Monitor::create(['monitorName' => $request->get('monitorName')]);

        return redirect()->back()
            ->with('status', 'Monitor successfully recorded'); 
    }

    public function attach(Request $request, Computer $computer)
    {
        $this->authorize('create', Monitor::class);

        $request->validate([ 'monitor' => 'required' ]);
        
        $monitor = Monitor::findOrFail($request->get('monitor'));
        
        $computer->monitors()->save($monitor);

        return redirect()->route('computers.show', $computer->id)
            ->with('status', "Monitor:<strong>$monitor->monitorName</strong> has been attached to this computer");
    }

    public function detach(Computer $computer, Monitor $monitor)
    {
        $this->authorize('update', $monitor);

        $monitor->update(['computer_id' => null]);

        return redirect()->back()
            ->with('status', "Monitor:<strong>$monitor->monitorName</strong> has been detached from this computer");
    }
}
