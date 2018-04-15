<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Yajra\Datatables\Facades\Datatables;
use App\Members;
use App\MemberDetails;

class MembersController extends Controller
{
    public function __construct() {
        
    }
    
    /**
     * This function displays the Member Creation form
     */
    public function createMember() {
        $countries = \App\Countries::all();
        return view('member.add-member', [
            'countries' => $countries
        ]);
    }
    
    /**
     * This method inserts the Member for Data into member tables
     * @param Request $request
     * @return Json success/error message
     */
    public function saveMember(Request $request){
        $validatedData = $this->validate($request,[
            'first_name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'email' => 'required|email|unique:members,email|max:80',
            'phone' => 'digits_between:10,15|max:20',
            'country' => 'required|alpha|max:3',
            'dateofbirth' => 'required|date',
            'aboutyou' => 'required',
        ]);
        
        try {
            DB::beginTransaction();
            $datetime = new \DateTime();
            $addMember = \App\Members::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'created_at' => $datetime,
                'updated_at' => $datetime,
                'status' => 0,
            ]);
            
            $dob = date('Y-m-d',strtotime($request->dateofbirth));
            
            $addMemberDetails = \App\MemberDetails::create([
               'user_id' => $addMember->id,
                'birth_date' => $dob,
                'country' => $request->country,
                'about_you' => $request->aboutyou,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ]);
            DB::commit();
            return back()->with('success', 'Member Successfully Created');
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with('error', 'Some issue occured while creating member. Please try again.');
        }
    }
    
    /**
     * This displays list of all members
     */
    public function listMembers() {
        return view('member.list-members');
    }
    
    /**
     * Fetch list of all members from database
     */
    public function listMembersData() {
        $members = Members::select(['id', 'first_name', 'last_name', 'email', 'phone']);
        return Datatables::of($members)
        ->addColumn('action', function($member) {
            return '<a href="/member/edit-member/'.$member->id.'" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i> Edit</a>';
        })
        ->make(true);         
    }
    
    /**
     * Edit Member Details for specific member
     * @param type $id Member ID
     */
    public function editMember($id){
        $userdata = \App\Members::find($id);
        if(count($userdata) > 0){
            $countries = \App\Countries::all();
            $userdetails = \App\Members::find($id)->memberdetails;
            return view('member.edit-member', [
                'userinfo' => $userdata,
                'userdetail' => $userdetails,
                'countries' => $countries
            ]);
        } else {
            abort(404);
        }
    }
    
    /**
     * 
     * @param Request $request
     */
    public function updateMember(Request $request){
        $validatedData = $this->validate($request,[
            'first_name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'email' => 'required|email|max:80',
            'phone' => 'digits_between:10,15|max:20',
            'country' => 'required|alpha|max:3',
            'dateofbirth' => 'required|date',
            'aboutyou' => 'required',
        ]);
        
        try {
            DB::beginTransaction();
            $datetime = new \DateTime();
            $addMember = \App\Members::find($request->memid)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'updated_at' => $datetime,
                'status' => 1,
            ]);
            
            $dob = date('Y-m-d',strtotime($request->dateofbirth));
            
            $addMemberDetails = \App\MemberDetails::where('user_id', $request->memid)->update([
                'birth_date' => $dob,
                'country' => $request->country,
                'about_you' => $request->aboutyou,
                'updated_at' => $datetime,
            ]);
            DB::commit();
            return back()->with('success', 'Member Successfully updated');
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->with('error', 'Some issue occured while updating member. Please try again.');
        }
    }
}
