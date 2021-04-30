<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follower;
use App\User;
class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $follow_requests=Follower::with('from_user')->where(["to_user_id"=>auth()->user()->id,"accepted"=>0])->get();
        $followers=Follower::with('from_user','to_user')->
                             where(["to_user_id"=>auth()->user()->id,"accepted"=>1])->
                             orWhereRaw("from_user_id = ? AND accepted = ?", [auth()->user()->id,1])
                             ->get();
        $active_follow = "#4966a8";
        $border_active_follow="border-bottom-acctive";
        return view('follow_view/followers',compact('follow_requests','followers','active_follow','border_active_follow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // إرسال طلب المتابعة
        $follower= new Follower();
        $follower->to_user_id=$request->get('user_id');
        $follower->from_user_id=auth()->user()->id;
        $follower->accepted=0;
        $follower->save();
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $follow= Follower::find($id);
        $follow->accepted = 1;
        $follow->save();
        return redirect('user/followers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        //
       
        $follow = Follower::find($id);
        $follow->delete();
        /* -------------End code-------------- */
       /*  هذا علشان توجية الصفحة فقط اضافة مكملة */
        $redirect_to=$request->get('redirect_to');
        if(isset( $redirect_to))
        return redirect($request->get('redirect_to'));
        else
        return redirect('users');
    }
}
