<?php

namespace App\Http\Controllers;

use App\Models\ContactGroup;

class ContactGroupController extends Controller
{
    public function index()
    {
        $contactGroups = auth()->user()->currentTeam->contactGroups()->paginate();
        return view('contact.group.index', compact('contactGroups'));
    }

    public function create()
    {
        return view('contact.group.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactGroup  $contactGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ContactGroup $contactGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactGroup  $contactGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactGroup $contactGroup)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactGroup  $contactGroup
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(ContactGroup $contactGroup)
    {
        abort_unless($contactGroup->team->is(auth()->user()->currentTeam), 403);

        $contactGroup->delete();
        return back();
    }
}
