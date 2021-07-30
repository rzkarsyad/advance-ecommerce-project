<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function CouponView()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.view_coupon', compact('coupons'));
    }

    public function CouponStore(Request $request)
    {
        $request->validate(
            [
                'coupon_name' => 'required',
                'coupon_discount' => 'required',
                'coupon_validity' => 'required',
            ]
        );

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Successfully Added Coupon',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CouponEdit($id)
    {
        $coupons = Coupon::findOrFail($id);
        return view('backend.coupon.edit_coupon', compact('coupons'));
    }

    public function CouponUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'coupon_name' => 'required',
                'coupon_discount' => 'required',
                'coupon_validity' => 'required',
            ]
        );

        Coupon::findOrFail($id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Successfully Updated Coupon',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-coupon')->with($notification);
    }

    public function CouponDelete($id)
    {
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Successfully Deleted Coupon',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
