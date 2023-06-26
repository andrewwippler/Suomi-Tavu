<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Helpers\Tavu;
use Illuminate\Http\JsonResponse;

class TavuController extends Controller
{

    public function tavuta(Request $request): View
    {
        $input = $request->all();
        $uusi = Tavu::tavuta($input['textarea']);
        // error_log(var_dump($input));
        $valmis = Tavu::rakkenta($uusi);

        return view('tavu', ['lauset' => $valmis]);
    }

    public function jsontavuta(Request $request): JsonResponse
    {
        $input = $request->all();
        $uusi = Tavu::tavuta($input['textarea']);
        // error_log(var_dump($input));
        $valmis = Tavu::rakkenta($uusi);

        return response()->json([
          'lauset' => $valmis,
          'raw' => $uusi,
        ]);
    }
}
