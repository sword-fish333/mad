<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class StaticPagesController extends Controller
{
    public function index(){
            $pages=Blog::all();
        return view('admin.static_pages', array('pages'=>$pages));
    }

    public function addPage(Request $request){

        $this->validate($request,[
           'title'=>'required|string|max:255',
            'page_content'=>'required|string|max:20000',
        ]);
            $page=new Blog();

        if(Blog::count()===0){
            $page->parent_id=0;
        }else if(!empty($request->parent_category)){
            $page->parent_id=$request->parent_category;
        }else{
            return back()->with('error','You have to choose a parent category!');
        }
        if($request->image){
            $photo = \App\Http\Controllers\FilesController::uploadFile($request, "image", "pages_image", array("jpg", "jpeg", "png", "gif"), false);
            $page->image=$photo;
        }
        $page->name=$request->title;
        $page->content=$request->page_content;
        $page->url_rewrite=str_slug($request->slug,'-');
        $page->save();
        return back()->with('success', 'A new Page was added');
    }

    public function editPage($id, Request $request){
        $page=Blog::find($id);
        $page->name=$request->title;
        $page->content=$request->page_content;
        $page->url_rewrite=str_slug($request->slug,'-');

        if(!empty($request->image)){
            $photo = \App\Http\Controllers\FilesController::uploadFile($request, "image", "pages_image", array("jpg", "jpeg", "png", "gif"), false);
            $page->image=$photo;
        }
        if(!empty($request->parent_category)) {
            $page->parent_id = $request->parent_category;
        }

        $page->save();
        return back()->with('success','The page has been edited successfully!');
    }

    public function deletePage($id){

        Blog::find($id)->delete();
        return back()->with('success','Page has been deleted successfully!');
    }


}
