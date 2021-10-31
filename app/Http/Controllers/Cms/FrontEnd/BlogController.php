<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:blog-list|blog-create|blog-update|blog-delete', ['only' => ['index','addBlogData']]);
        $this->middleware('permission:blog-create', ['only' => ['addBlog','addBlogData']]);
        $this->middleware('permission:blog-update', ['only' => ['updateBlog','updateBlogData']]);
        $this->middleware('permission:blog-delete', ['only' => ['deleteBlog']]);
    }

    public function index()
    {
        $resultSet = Blog::get();
        return view('cms.website.pages.blog.index',compact('resultSet'));
    }

    public function addBlog()
    {
        return view('cms.website.pages.blog.add');
    }

    public function addBlogData(){
        request()->validate([
            'image' => ['required','image','mimes:jpeg,jpg,png,svg','max:2048'],
            'author' => ['required','max:55'],
            'title' => ['required','unique:blog,title,NULL,id,deleted_at,NULL','max:100'],
            'description' => ['required','max:200']
        ]);

        if (request()->hasFile('image')) {
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random.'-'.$dt.'.'.$extension;
            $purposePath = givePath().'/assets/images/uploads/pages/blog';
            $destination = givePath().'/assets/images/uploads/pages/blog/'.$newFileName;

            if(!File::isDirectory($purposePath)){
                File::makeDirectory($purposePath, 0777, true, true);
            }

            $check = $img->save($destination);
            if ($check) {
                Blog::create([
                    'image' => $newFileName,
                    'author' => request()->author,
                    'title' => request()->title,
                    'slug' => Str::slug(request()->title),
                    'description' => request()->description,
                    'created_by' => Auth::id()
                ]);
            } else {
                return back()->with('error', 'File not Saved in Database!');
            }
            return redirect()->route('website.page.blog')->with('success', 'Your data is successfully added!');
        }
    }

    public function updateBlog($blogId){
        $updateBlog = Blog::where('id',$blogId)->first();
        return view('cms.website.pages.blog.update',compact('updateBlog'));
    }

    public function updateBlogData($blogId){
        $updateBlog = Blog::where('id',$blogId)->first();

        if(empty($updateBlog->image) && empty(request()->image))
        {
            return back()->withErrors(['error' => 'The image is required'])->withInput();
        }

        request()->validate([
            'image' => ['sometimes','nullable','image','mimes:jpeg,jpg,png,svg','max:2048'],
            'author' => ['required','max:55'],
            'title' => ['required','unique:blog,title,'.$blogId.',id,deleted_at,NULL','max:100'],
            'description' => ['required','max:200']
        ]);

        if(!empty(request()->file('image'))){
            unlink(givePath() . '/assets/images/uploads/pages/blog/' . $updateBlog->image);
            $img = Image::make(request()->file('image'));
            $extension = request()->file('image')->extension();
            $random = Str::random(30);
            $dt = Carbon::now()->timestamp;
            $newFileName = $random.'-'.$dt.'.'.$extension;
            $purposePath = givePath().'/assets/images/uploads/pages/blog';
            $destination = givePath().'/assets/images/uploads/pages/blog/'.$newFileName;

            if(!File::isDirectory($purposePath)){
                File::makeDirectory($purposePath, 0777, true, true);
            }
            $check = $img->save($destination);

            if ($check) {
                $updateBlog->update([
                    'image' => $newFileName,
                    'author' => request()->author,
                    'title' => request()->title,
                    'slug' => Str::slug(request()->title),
                    'description' => request()->description,
                    'updated_by' => Auth::id()
                ]);
            } else {
                return back()->withErrors(['error' => 'File not Saved in Database!'])->withInput();
            }

        } else {
            $updateBlog->update([
                'image' => $updateBlog->image,
                'author' => request()->author,
                'title' => request()->title,
                'slug' => Str::slug(request()->title),
                'description' => request()->description,
                'updated_by' => Auth::id()
            ]);
        }
        return redirect()->route('website.page.blog')->with('success', 'Your data is successfully updated!');
    }

    public function changeBlogStatus($blogId)
    {
        $msg = 'Something went wrong.';
        $code = 400;
        $blog = Blog::findOrFail($blogId);

        if (!empty($blog)) {
            $msgText = $blog->is_active ? "inactive" : "activated";
            $blog->update(['is_active' => $blog->is_active ? 0 : 1]);
            $msg = "Blog successfully {$msgText}!";
            $code = 200;
        }

        return response()->json(['msg' => $msg], $code);
    }

    public function deleteBlog($blogId){
        $msg = "Some thing went wrong!";
        $code = 400;
        $records = Blog::all();
        $updateBlog = Blog::where('id',$blogId)->first();
        if (count($records) > 2) {
            if (!empty($updateBlog)) {
                $msgText = $updateBlog->is_disabled ? "enabled" : "disabled";
                $updateBlog->update(['is_disabled' => $updateBlog->is_disabled ? 0 : 1]);
                $msg = "Successfully {$msgText}!";
                $code = 200;
            }
        } else {
            $msg = "You have less than three records Add more record to remove them!";
            $code = 302;
        }
        return response()->json(['msg' => $msg],$code);
    }
}
