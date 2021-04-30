<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //علشان تبحث لي بجميع مستخدمين علشان ماتتكرر عملية الاعجاب where علشان نستخدم دالة 
        //علشان نستخدم دالة 
       /*  لما إعمل دالة وبينها فاصل يعني طابق لي معرف مستخدم مع معرف منشور */
        $is_like = Like::where(["user_id"=>auth()->user()->id,"post_id"=>$request->get('post_id')]);
        if($is_like->count()==0){
            $like= new Like();
            $like->post_id=$request->get('post_id');
            $like->user_id=auth()->user()->id;
            $like->save();
        }
        $count = Like::where('post_id', $request->get('post_id'))->count();
        /* عدد الاعجابات على منشور */
        return response()->json(['count' => $count,'id' => $like->id]); 
        /* يعيد هذا التابع قيمتين واحدة عدد الاعجابات والثاني معرف الاعجاب */
        //return redirect('post/'.$request->get('post_id'));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        //ابحث لي عم كل مستخدمين الذي يطابق مع معرف منشور
        $like = Like::where(["user_id"=>auth()->user()->id,"post_id"=>$post_id]);
        $like->delete();
        $count = Like::where('post_id',$post_id )->count();
        /* عد عدد الاعجابات بعد الحذف من ثم نرسل لواجهة كم اصبحت عدد الاعجابات بعد الحذف */
        return response()->json(['count' => $count]); 
       /* return redirect('post/'.$post_id);*/
    } 
}