<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;


class ContactsController extends Controller
{
    //
    public function listLhAll(){
        $contacts=Customer::orderBy('created_at', 'desc')->get();
        return view('admin.contacts.danhsach',compact('contacts'));
    }
    public function getLhList(Request $request)
{
    $status = $request->input('status');

    if ($status == "Đã liên hệ") {
        $contacts = Customer::where('status', 'like', '%' . $status . '%')->orderBy('updated_at', 'desc')->get();
    } elseif ($status == "Chưa liên hệ") {
        $contacts = Customer::where('status', 'like', '%' . $status . '%')->orderBy('updated_at', 'desc')->get();
    } else {
        $contacts = Customer::orderBy('updated_at', 'desc')->get();
    }

    return view('admin.contacts.danhsach', compact('contacts', 'status'));
}

    public function updateLhStatus(Request $request,$id,$status){
        $contacts=Customer::where('id',$id)->get();
        $contactsdetail=Customer::where('id',$id)->get();
        return view('admin.contacts.updatebill',array('contacts'=>$contacts),compact('contactsdetail'));
    }
    public function updateLhStatusAjax(Request $request, string $id){
        $contacts=Customer::find($id);
        $contacts->status=$request->status;
        $contacts->save();
        return redirect()->route('admin.listLhAll')->with('success','Bạn đã sửa thành công!'); 
    }
    public function cancelLh(string $id)
{
    $contacts = Customer::findOrFail($id);

    $idcustomer = $contacts->id;

    $contactsdetail = Customer::where('id', $id)->get();

    $customer = Customer::find($id);

    foreach ($contactsdetail as $detail) {
        $detail->delete();
    }

    $customer->delete();

    $contacts->delete();

    return redirect()->route('admin.listLhAll')->with('success', 'Bạn đã xóa thành công!');
}

}
