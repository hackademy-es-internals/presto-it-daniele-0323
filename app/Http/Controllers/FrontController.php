<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function welcome() {
        $announcements = Announcement::latest()->take(6)->get();
        
        return view('welcome', compact('announcements'));
    }

    public function indexAnnouncement() {
        $announcements = Announcement::paginate(6);
        
        return view('index', compact('announcements'));
    }

    public function categoryShow(Category $category) {

        return view('categoryShow', compact('category'));
    }
}
