<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataProcess;

class ImportController extends Controller
{

    /**
     * Load innitial page.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('load');
    }

    /**
     * Process uploaded file.
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\View\View
     */
    public function upload(Request $request)
    {
        $processor = new DataProcess($request->file('file'));
        $result = $processor->processCsv();

        return view('result',['result' => $result ]);
    }
}
