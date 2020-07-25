<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function contact() {
        return view("contact");
    }

    public function contactStore(Request $request) {
        $data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();
        Mail::to('admin@boolpress.it')->send(new NewContact($new_lead));
        return redirect()->route('home');
    }
}
