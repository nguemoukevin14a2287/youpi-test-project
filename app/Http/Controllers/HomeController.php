<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //page home
    public function home()
    {
        return view('Home.accueil');
    }

    //page a-propos
    public function about()
    {
        return view('Home.a-propos');
    }

    //page candidat
    public function candidat()
    {
        return view('Home.Candidats');
    }

    //page contact
    public function contact()
    {
        return view('Home.Contact');
    }
    public function contactez()
    {
        return view('Home.contactez-nous');
    }

    //page inscription
    public function inscription()
    {
        return view('Home.inscription');
    }

    //page partenariat
    public function partenariat()
    {
        return view('Home.partenariat');
    }

    //page reglement
    public function reglement()
    {
        return view('Home.reglement');
    }
}
