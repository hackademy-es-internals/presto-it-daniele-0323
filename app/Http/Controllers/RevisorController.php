<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\BecomeRevisor;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class RevisorController extends Controller
{
    public function index(){
        $announcement_to_check = Announcement::where('is_accepted', null)->orderBy('created_at', 'asc')->first();
        return view('revisor.index', compact('announcement_to_check'));
    }

    public function acceptAnnouncement(Announcement $announcement){
        if(!$announcement->setAccepted(true)){
            return redirect()->back()->with('access.denied', 'Annuncio già revisionato da altri utenti');
        }
        Auth::user()->setLastReviewed($announcement->id);
        return redirect()->back()->with('message', 'Complimenti, hai accettato l\'annuncio');
    }

    public function rejectAnnouncement(Announcement $announcement){
        if(!$announcement->setAccepted(false)){
            return redirect()->back()->with('access.denied', 'Annuncio già revisionato da altri utenti');
        }
        Auth::user()->setLastReviewed($announcement->id);
        return redirect()->back()->with('message', 'Complimenti, hai negato la ricchezza a qualcuno');
    }

    public function undoReview(Announcement $announcement){
        $announcement->setAccepted(null);
        Auth::user()->setLastReviewed(null);
        return redirect()->back()->with('message', 'Complimenti, hai rimediato ai tuoi errori'); 
    }

    public function becomeRevisor(){
        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
        return redirect()->back()->with('message', 'Complimenti! Hai fatto richiesta per diventare revisore.');
    }

    public function makeRevisor(User $user){
        Artisan::call('presto:MakeUserRevisor', ["email" => $user->email]);
        return redirect('/')->with('message', 'Complimenti! L\'utente è diventato revisore.');

    }
}
