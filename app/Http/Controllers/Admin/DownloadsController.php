<?php

namespace App\Http\Controllers\Admin;

use App\Models\Download;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $downloads = Download::sortable()
                ->where('downloads.name', 'like', '%'.$filter.'%')
                ->paginate(5);
        } else {
            $downloads = Download::sortable()
                ->paginate(5);
        }

        return view('admin.downloads.index')->with('downloads', $downloads)->with('filter', $filter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/sharks/create.blade.php)
        return view('admin.downloads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:downloads|max:255',
            'tags' => 'required',
        ]);

        // store
        $download = new Download;
        $download->name = $validated['name'];
        $download->filename = $validated['name'];
        if ($download->save()) {
            $tags = explode(", ", $request->tags);
            $download->tag($tags);            
            $request->session()->flash('success', 'Download has been updated');
        } else {
            $request->session()->flash('error', 'There was an error updating the download');
        }

        return redirect()->route('admin.downloads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Download $download)
    {
        if (Gate::denies('edit-downloads')) {
            return redirect(route('admin.downloads.index'));
        }

        return view('admin.downloads.edit')->with([
            'download' => $download,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Download $download)
    {
        $download->name = $request->name;
        $download->filename = $request->filename;
        if ($download->save()) {
            $tags = explode(", ", $request->tags);
            $download->tag($tags);                        
            $request->session()->flash('success', 'Download has been updated');
        } else {
            $request->session()->flash('error', 'There was an error updating the download');
        }

        return redirect()->route('admin.downloads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Download $download)
    {
        if (Gate::denies('delete-downloads')) {
            return redirect(route('admin.downloads.index'));
        }

        if ($download->delete()) {
            $request->session()->flash('success', 'Download has been deleted');
        } else {
            $request->session()->flash('error', 'There was an error deleting the download');
        }

        return redirect()->route('admin.downloads.index');
    }
}
