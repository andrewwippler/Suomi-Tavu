<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Helpers\Tavu;

class TavuController extends Controller
{

    public function tavuta(Request $request): View
    {
        $input = $request->all();
        // Store the user...
        $uusi = Tavu::tavuta($input['textarea']);
        // error_log(var_dump($input));
        $valmis = Tavu::rakkenta($uusi);

        return view('tavu', ['lauset' => $valmis]);
    }
}
