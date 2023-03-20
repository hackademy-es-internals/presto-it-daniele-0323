<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function welcome() {
        $announcements = Announcement::where('is_accepted', true)->latest()->take(6)->get();
        
        return view('welcome', compact('announcements'));
    }

    public function indexAnnouncement() {
        $announcements = Announcement::where('is_accepted', true)->paginate(6);
        
        return view('index', compact('announcements'));
    }

    public function categoryShow(Category $category) {

        return view('categoryShow', compact('category'));
    }

    public function setLanguage($lang){
        session()->put('locale', $lang);
        return redirect()->back();
    }

    public function searchAnnouncements(Request $request){
        $announcements = Announcement::search($request->searched)->where('is_accepted', true)->paginate(6);
        return view('index', compact('announcements'));
    }
}
