<?php

namespace App\Http\Controllers\Resource;

use Auth;
use App\User;
use App\User\Contact;
use App\User\Identity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function common()
    {
        return Auth::user();
    }

    public function identity()
    {
        $user = Auth::user();
        $identity = $user->identity;
        return $identity ?? [
            'degree'        =>      '',
            'student_id'    =>      '',
        ];
    }

    public function contact()
    {
        $user = Auth::user();
        $contact = $user->contact;
        return $contact ?? [
            'college'       =>      '',
            'domitory'      =>      '',
            'room'          =>      '',
            'phone'         =>      '',
        ];
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Auth::id() != $user->id)
            abort(403);
        
        $raw = $request->input();
        $raw->id = Auth::id();

        $word = $request->input('_word', '');
        switch($word) {
            case 'common':
                if($user->update($request->input()))
                    return [
                        'status'    =>      true
                    ];
            case 'identity':
                if(!$identity = Identity::find($user->id))
                    $res = Identity::create($request->input());
                else
                    $res = $identity->update($request->input());
                if($res)
                    return [
                        'status'    =>      true
                    ];
            case 'contact':
                $conatct = Contact::find($user->id);
                if($contact->updateOrCreate($request->input()))
                    return [
                        'status'    =>      true
                    ];
            default: abort(405);
        }

        return [
            'status'    =>      false,
            'error'     =>      'db error',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
