<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category as Category;
use App\Models\Post as Post;
use Gate;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
   if(Gate::allows('isManager')){
if(isset($request->user_id)){
    $posts = Post::filter(['user_id'=>$request->user_id])->paginate(10);
}
else{
    $posts = Post::paginate(10);
}

   }
   else{
    $posts = Post::filter(['user_id'=>auth()->user()->id])->paginate(10);
   }
     
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.required' => 'Поле название обязательно к заполнению',
                'image.required' => 'Вы не выбрали изображение',
            ]
        );

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Post::create($input);


        return redirect()->route('posts.index')->with('success', 'Запись ' . $request['title'] . ' успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        
        if(Gate::allows('isEmployee')){
            $post = $post->filter(['user_id'=>auth()->user()->id])->findOrFail($id);
        }
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $categories = Category::get();
        $post = Post::findOrFail($id);
        
        if(Gate::allows('isEmployee')){
            $post = $post->filter(['user_id'=>auth()->user()->id])->findOrFail($id);
        }
              
        return view('posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        ///
        $request->validate(
            [
                'title' => 'required',
            ],
            [
                'title.required' => 'Поле название обязательно к заполнению',
            ]
        );

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            $image_path = public_path('image') . '/' . $request['image'];
            unset($image_path);
        }

        Post::find($id)->update($input);


        return redirect()->route('posts.index')->with('primary', 'Запись ' . $request['title'] . ' успешно отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Post $post)
    {

        $image_path = public_path('image') . '/' . $post->image;
        $post->delete();
        unset($image_path);
        return redirect()->route('posts.index')->with('danger', 'Запись ' . $post->title . ' удалена');
    }
}
