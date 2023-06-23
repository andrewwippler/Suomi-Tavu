<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Helpers\Tavu;

class TavuController extends Controller
{

    public function tavuta(Request $request): View
    {
        $lauset = $request->textarea;
        // Store the user...
        $uusi = Tavu::tavuta($lauset);
        // error_log(var_dump($uusi));
        $valmis = Tavu::rakkenta($uusi);

        return view('tavu', ['lauset' => $valmis]);
    }
}
