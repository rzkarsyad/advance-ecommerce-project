<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class ShippingAreaController extends Controller
{

    // Division

    public function DivisionView()
    {
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();
        return view('backend.ship.division.view_division', compact('divisions'));
    }

    public function DivisionStore(Request $request)
    {
        $request->validate(
            [
                'division_name' => 'required',
            ]
        );

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Successfully Added Division',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DivisionEdit($id)
    {
        $divisions = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division', compact('divisions'));
    }

    public function DivisionUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'division_name' => 'required',
            ]
        );

        ShipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Successfully Updated Division',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-division')->with($notification);
    }

    public function DivisionDelete($id)
    {
        ShipDivision::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Successfully Deleted Division',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // District 

    public function DistrictView()
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::with('division')->orderBy('id', 'DESC')->get();
        return view('backend.ship.district.view_district', compact('division', 'district'));
    }

    public function DistrictStore(Request $request)
    {
        $request->validate(
            [
                'division_id' => 'required',
                'district_name' => 'required',
            ]
        );

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Successfully Added District',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DistrictEdit($id)
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.edit_district', compact('division', 'district'));
    }

    public function DistrictUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'division_id' => 'required',
                'district_name' => 'required',
            ]
        );

        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Successfully Update District',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-district')->with($notification);
    }

    public function DistrictDelete($id)
    {
        ShipDistrict::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Successfully Deleted District',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // State

    public function StateView()
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $state = ShipState::with('division', 'district')->orderBy('id', 'DESC')->get();
        return view('backend.ship.state.view_state', compact('division', 'district', 'state'));
    }

    public function GetDistrict($division_id)
    {
        $district = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($district);
    }

    public function GetState($district_id)
    {
        $state = ShipState::where('district_id', $district_id)->orderBy('state_name', 'ASC')->get();
        return json_encode($state);
    }

    public function StateStore(Request $request)
    {
        $request->validate(
            [
                'division_id' => 'required',
                'district_id' => 'required',
                'state_name' => 'required',
            ]
        );

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Successfully Added State',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function StateEdit($id)
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.edit_state', compact('division', 'district', 'state'));
    }

    public function StateUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'division_id' => 'required',
                'district_id' => 'required',
                'state_name' => 'required',
            ]
        );

        ShipState::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Successfully Updated State',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-state')->with($notification);
    }

    public function StateDelete($id)
    {
        ShipState::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Successfully Deleted State',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
