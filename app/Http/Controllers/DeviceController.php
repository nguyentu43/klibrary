<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\DeviceRequest;

class DeviceController extends Controller
{
    public function __construct(){
        $this->middleware('can:view,device')->only('show', 'edit');
        $this->middleware('can:update,device')->only('update');
        $this->middleware('can:delete,device')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Auth::user()->devices()->get();
        return view('devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeviceRequest $request)
    {
        $data = $request->all();
        if($request->filled('default'))
            $data['default'] = true;
        $device = Auth::user()->devices()->create($data);
        return redirect()->route('devices.index')->with('message', __('app.device.messages.add', ['device' => $device->name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(DeviceRequest $request, Device $device)
    {
        $data = $request->all();
        if(!empty($data['default']))
        {
            Auth::user()->devices()->update([ 'default' => false ]);
            $data['default'] = true;
        }
        else {
            $data['default'] = false;
        }

        if($device->update($data))
            return redirect()->route('devices.index', compact('device'))->with('message', __('app.device.messages.update', ['device' => $device->name]));
        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        if($device->delete())
            return redirect()->route('devices.index')->with('message', __('app.device.messages.delete', ['device' => $device->name]));
        return abort(403);
    }
}
