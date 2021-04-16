<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::all();

        return view('candidates.index', compact('candidates'));
    }
    public function storeImage($imageName, $image){
        Storage::disk('storage')->put($imageName, file($image));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'name'=>'required',
            'birthday'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'graduated_year'=>'required'
        ]);
        $imageName = Str::random(20) . '.' .$request->image->clientExtension();  
        // dd(file($imageName));
        // Storage::disk('storage')->put($imageName, file($request->image));
        // storeImage($imageName, $request->image);
        Storage::disk('storage')->put($imageName, file($request->image));
        $candidate = new Candidate([
            'name' => $request->get('name'),
            'sex' => (int)$request->get('sex'),
            'birthday' => date('Y-m-d', strtotime($request->get('birthday'))),
            'image_url' => $imageName,
            'graduated_year' => (int)trim($request->get('graduated_year'))
        ]);
        $candidate->save();
        // $imageName = Str::random(20) . '.' .$request->image->clientExtension();
        // file($request->image)->storeAs('/', $imageName, "storage_image");
        return redirect('/candidates')->with('success', 'Candidate saved!');
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
    public function edit($id)
    {
        $candidate = Candidate::find($id);
        // dd($candidate);
        return view('candidates.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'name'=>'required',
            'birthday'=>'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'graduated_year'=>'required'
        ]);

        $candidate = Candidate::find($id);
        // dd($candidate);
        $candidate->name =  $request->get('name');
        $candidate->sex = (int)$request->get('sex');
        $candidate->birthday = date('Y-m-d', strtotime($request->get('birthday')));
        // dd($request);
        if(($request->image != null) and ($candidate->image != $request->image_name)){
            $imageName = Str::random(20) . '.' .$request->image->clientExtension();
            // storeImage($imageName, $request->image);
            Storage::disk('storage')->put($imageName, file($request->image));
            // dd(storage_path('images/' . $candidate->image_url));
            // \File::delete('images/'.$candidate->image_url);
            \File::delete( storage_path('app/public/images/' . $candidate->image_url));
            $candidate->image_url = $imageName;
        }
        $candidate->graduated_year = (int)trim($request->get('graduated_year'));
        $candidate->save();
        return redirect('/candidates')->with('success', 'Candidate updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Candidate::find($id)->delete();
        return response()->json(['success'=>'Candidate deleted successfully.']);
    }
}
