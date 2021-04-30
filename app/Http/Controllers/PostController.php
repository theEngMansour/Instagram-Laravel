<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Like;
use App\Follower;
use App\Comment;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::with('likes','comments')->withCount('likes','comments')->whereIn('user_id', auth()->user()->following()->where('accepted','=',1)->
        pluck('to_user_id'))->orderBy("created_at","DESC")->latest()->paginate(6);
        //pluck تجيب كل الصف لانة وير تجيب صف واحد
        $active_home="#4966a8";
        $border_active_home="border-bottom-acctive";
        return view('home',compact('posts','active_home','border_active_home'));
    }
    public function userPosts(Request $request)
    {
        //where تبحث لك على كل منشورات خاصة بالمستخدم وتجلبها
        //يعني من خلال نموذج البيانات الخاص بالمنشورات نقدر نجلب منشورات الذي توافق مستخدم الحالي 
        $posts=Post::where(["user_id"=>auth()->user()->id])->latest()->paginate(5);
        $active_profile="#4966a8";
        $Profiles=User::where("id",auth()->user()->id)->get();
        $border_active_profile="border-bottom-acctive";
        return view('post_views/user_posts',compact('posts','active_profile','border_active_profile','Profiles'));
    }

    



    public function userFriendPosts($id)
    {
        //$follow_requests=Follower::where(["from_user_id"=>auth()->user()->id,"to_user_id"=>$id,"accepted"=>1])->get();
   /*  if(isset($follow_requests[0])) */ /* صفر اذا كانت القيمة موجودة */
   if (policy(Post::Class)->show_friend(auth()->user(),$id)) 
     
    {
         $posts=Post::withCount('likes')->where(["user_id"=>$id])->paginate(5);
         return view('post_views/friend_posts',compact('posts'));
    }
        else
        return redirect('home');  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        //لجلب وعرض صفحة إنشاء منشور جديد
        return view('post_views/new_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { /*  إنشاء منشور جديد */


        $this->validate($request,[         // هذي داله فلديت تتحقق من انه لابد ان يكون الحقول في الاستمارة لاتكون فاضية
    // كل ماتعملة هذي الدالة هي إعادة صفحة عندما تكون الحقول فاضية محدد في مصفوفة
            'body' => 'required',              // الحد الاقصى للاحرف max:150
        ],
        [
            
            'body.required'=>'لم يتم كتابة شيئاً',
        ]
        );
        $Post= new Post();
        $Post->body=$request->get('body'); 
        $Post->user_id=auth()->user()->id;
        $Post->image_path=$request->get('filename');
        $Post->save();
      
        return redirect('post/'.$Post->id);
   
  

//        /*  ----------------------------------------------------------------- */

//         // حفظ البيانات في قاعدة البيانات
//         if($request->hasfile('filename')) /* إذا تمتلك ملف مرفق شرط يعبر عن ذلك */
//         {   // علشان عدل ع اسم صورة 
//            $file = $request->file('filename');
//            $name=time().$file->getClientOriginalName();
//              //getClientOriginalName هذي الدالة تخلي اسم صورة حسب اللحظة الزمنية الذي ارتفع فيها صورة علشان لايوحد تشابهة 
//            $file->move(public_path().'/images/posts', $name);
//             // خاص بالتطبيق  يعني نقل صوره لهذا الاسم بعد التعديلات ع اسمها public  الى مسار   public_path الدالة 
//         } 
//         /* تعني اني  بنشئ بيانات جديدة في قاعدة البيانات  برسلها عبر نموذج البيانات */
//        $Post= new Post();
//        // كاني اقول له القيمة القديم اسندها لقيمة الجديدة في الحقل الجديد بستخدام مساواة 
//        $Post->body=$request->get('body'); 
//      /*   name=""   هو نفسة الذي يكون اسم الحقل  get('body') الذي يكون في هذي  */
//        $Post->user_id=auth()->user()->id;
//        $Post->image_path=$name;
//        $Post->save();
     
//        return redirect('post/'.$Post->id);
//      /*   new Post();: شرح ماذا عملت : عملت انا سجلت انشئ لي شيء جديد في نموذج البيانات عبر التالي :  مع متغير
//        name="body"   ولازم يكون اسم الحقل  get('body') ضيف له قيمة جديدة لاني في البداية سجلت نيو والقيمة الجديدة باتجي لك من حقل اسمة  body بعدها قلت من نموذج البيانات عمود اسمة 
//  */       
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
        $post = Post::with('user')->find($id);
        $user = auth()->user();
        if ($user->can('show', $post)) {
            /* with('اسم دالة الذي في نموذج  البيانات حق منشورات لربط اكثر من علاقة  في جدول البيانات ') */
           
        /*  يعني نموذج المقالات + نموذج المستخدم وتقدر ستخدم اي عمود من نموذج مستخدم */
            //جلب مقال مع مستخدم نموذج مستخدم علشان اقدر اعرض الاسم تبع مستخدم مع صورتة
            $count = Like::where('post_id', $id)->count();
            $userLike = Like::where(["user_id"=>auth()->user()->id,"post_id"=>$id])->get();
            $post_comments = Post::with('comments', 'comments.user')->find($id);
            return view('post_views/view_post',compact('post','count','userLike','post_comments'));
        }
        else{
            return redirect('not_found');
        }
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //عرض صفحة تعديل 
        $post = Post::find($id);
        //if ($post->user_id==auth()->user()->id)
        if (auth()->user()->can('edit', $post)) 
        // تحقق من المستخدم الذي عمل تسجيل الدخول هو نفسة صاحب المنشور ويملك الحق في تعديل على بياناته
            return view('post_views/edit_post',compact('post'));
        else /* غير ذلك نحولة لصفحة لايوجد منشور */
            return redirect('not_found');    
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
        //تحيث البيانات بعد تعديلها
        
        $post= Post::find($id);
        if (auth()->user()->can('update', $post)) {
            $post->body=$request->get('body');
            $post->save();
            return redirect('post/'.$id);
        }
        else
            return redirect('not_found'); 

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
        $post = Post::find($id);
        /* if ($post->user_id==auth()->user()->id) { */
        if (auth()->user()->can('delete', $post)) {
            $post->delete();
            return redirect('user/posts');
        }
        else
            return redirect('not_found');  
    }
}
