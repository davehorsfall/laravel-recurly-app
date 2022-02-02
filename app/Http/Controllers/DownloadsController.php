<?php

namespace App\Http\Controllers;

use App\Download;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $downloads = Download::all();

        return view('downloads.index')->with('downloads', $downloads);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function show(Download $download)
    {
        return view('downloads.show')->with('download', $download);
    }
}
