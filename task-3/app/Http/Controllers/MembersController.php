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
        
        return view('member.add-member');
    }
    
    /**
     * This method inserts the Member for Data into member tables
     * @param Request $request
     * @return Json success/error message
     */
    public function saveMember(Request $request){
        $validatedData = $this->validate($request,[
            'first_name' => 'required|alpha_dash|max:80',
            'last_name' => 'required|alpha_dash|max:80',
            'email' => 'required|email|max:80',
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
    
    public function listMembersData() {
        $members = Members::select(['id', 'first_name', 'last_name', 'email', 'phone']);
        return Datatables::of($members)
        ->addColumn('action', function($member) {
            return '<a href="/member/edit-member/'.$member->id.'" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i> Edit</a>';
        })
        ->make(true);         
    }
    
    /**
     * Fetch list of all members from database
     * @param type $from
     * @param type $limit
     */
    private function fetchMembers($from, $limit = 15){
        
    }
    
    /**
     * Edit Member Details for specific member
     * @param type $id Member ID
     */
    public function editMember($id){
        $userdata = \App\Members::find($id);
        $userdetails = \App\Members::find($id)->memberdetails;
        //echo "<pre>";
        //var_dump($userdata->user_id);
        return view('member.edit-member', [
            'userinfo' => $userdata,
            'userdetail' => $userdetails,
        ]);
    }
    
    /**
     * 
     * @param Request $request
     */
    private function updateMember(Request $request){
        
    }
}
