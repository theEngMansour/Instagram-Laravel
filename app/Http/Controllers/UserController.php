<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follower;
use App\Post;
use App\Like;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::where("id","!=",auth()->user()->id)->get();
                                                            /*  جميع طلبات مرسلة من مستخدم الحالي */
        $requests=Follower::with('to_user')->where(["from_user_id"=>auth()->user()->id,"accepted"=>0])->get();
        $active_user="#4966a8";
        $border_active_user="border-bottom-acctive";
        return view('follow_view/users',compact('users','active_user','requests','border_active_user'));
    }
    public function user_info(Request $request)
    {
        $is_follower = Follower::where(["from_user_id"=>auth()->user()->id,"to_user_id"=>$request['id']])->get();
        $user = User::find($request['id']);
        $posts = Post::where(["user_id"=>$request['id']])->limit(3)->get(); /* اقل limit(3) */
        $posts_counts = Post::where(["user_id"=>$request['id']])->count();
        $likes_counts = Like::whereIn('post_id', Post::where(["user_id"=>$request['id']])->get()->pluck('id'))->count();

        return view('auth/user_info',compact('user','posts','posts_counts','likes_counts','is_follower'));
    }
    public function autocomplete (request $request){
        $results=array();
        $item = $request->searchname; //نسند لة الكلمة المدخلة من الواجهة المستخدم
        $data=User::where('first_name','LIKE','%' .$item.'%')->orWhere('last_name','LIKE','%' .$item.'%')
        ->take(5)
        ->get();
        return response()->json($data);


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
        //
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
    public function edit()
    {
        //تعديل على معلومات المستخدم
        $user = User::find(auth()->user()->id);  // جيب لي كل الاعمدة الموحودة في جدول المستخدمين 
        return view('auth/user_profile',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)   /*  id لاداعي لــ  */
    {

        //تعديل على البيانات
        $name = ""; 

        if($request->hasfile('filename')) // علشان عدل ع اسم صورة 
            {
            $file = $request->file('filename');
            $name=time().$file->getClientOriginalName();  
            //getClientOriginalName هذي الدالة تخلي اسم صورة حسب اللحظة الزمنية الذي ارتفع فيها صورة علشان لايوحد تشابهة 
            $file->move(public_path().'/images/avatar/', $name);
            // خاص بالتطبيق  يعني نقل صوره لهذا الاسم بعد التعديلات ع اسمها public  الى مسار   public_path الدالة 
            }

        $user = User::find(auth()->user()->id);
        $user->first_name=$request->get('first_name'); 
        // كاني اقول له القيمة القديم اسندها لقيمة الجديدة في الحقل الجديد بستخدام مساواة 
        $user->last_name=$request->get('last_name');
        $user->birth_date=$request->get('birth_date');
        if(strlen($name) > 0) /* لازم تكون صورة مرفوعة اكبر من صفر  */
            $user->avatar = $name;
        $user->save();
        return redirect('user/profile')->with('success','تم تحديث معلومات');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
