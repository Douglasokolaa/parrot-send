<?php

namespace App\Http\Controllers;

use App\Models\Phonebook;

class PhoneBookController extends Controller
{
    public function index()
    {
        $phonebooks = auth()->user()->currentTeam->phonebooks()->paginate();
        return view('phonebook.index', compact('phonebooks'));
    }

    public function create()
    {
        return view('phonebook.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phonebook  $contactGroup
     * @return \Illuminate\Http\Response
     */
    public function show(Phonebook $contactGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phonebook  $contactGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Phonebook $contactGroup)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phonebook  $contactGroup
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Phonebook $phonebook)
    {
        abort_unless($phonebook->team->is(auth()->user()->currentTeam), 403);

        $phonebook->delete();
        return back();
    }
}
