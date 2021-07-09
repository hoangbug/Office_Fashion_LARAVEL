<?php

namespace App\Http\Controllers\Admin\Affiliate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\User\Affiliate\AffiliatePartner;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax()) {
            if(!empty($request->start_date) && !empty($request->end_date)) {
                $start_date = $request->start_date;
                $end_date = $request->end_date;

                if(($start_date) == ($end_date)){
                    $data = DB::table('affiliate_partners')->select('id', 'avatar', 'firstname', 'lastname', 'email', 'phone', 'status')->whereDate('affiliate_partners.created_at', '=', $start_date)->get()->toArray();
                }else{
                    $data = DB::table('affiliate_partners')->select('id', 'avatar', 'firstname', 'lastname', 'email', 'phone', 'status')->whereBetween('affiliate_partners.created_at', array($start_date, $end_date))->get()->toArray();
                }
            }
            foreach($data as $key => $value){
                $status = $value->status;
                if(($status) == 1){
                    $data[$key]->status = 'Chờ phê duyệt';
                }elseif(($status) == 2){
                    $data[$key]->status = 'Đang hoạt động';
                }elseif(($status) == 3){
                    $data[$key]->status = 'Đang khóa';
                }
            }
            return Datatables::of($data)->make(true);
        }
        return view('admin/pages/affiliate.view-partner');
    }

    public function delete(Request $request)
    {
        if(request()->ajax()) {
            if(!empty($request->id) && is_numeric($request->id)) {
                $deleteAvatar = AffiliatePartner::select('avatar')->where('id', '=', $request->id)->get()->toArray();
                $des_path = 'storage/images/affiliate/' . $deleteAvatar[0]['avatar'];
                if (file_exists($des_path)) {
                    unlink($des_path);
                }
                AffiliatePartner::find($request->id)->delete();
            }
        }
    }

    public function edit(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $data = DB::table('affiliate_partners')->select('*')->where('id', '=', $request->id)->get()->toArray();
                
                return view('admin/pages/affiliate.edit-partner',[
                    'data' => $data
                ]);
            }
        }
    }

    public function approve(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $partner = AffiliatePartner::find($request->id);
                $partner->status = 2;
                $partner->save();
            }
        }
    }

    public function lockup(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $partner = AffiliatePartner::find($request->id);
                $partner->status = 3;
                $partner->save();
            }
        }
    }
}
