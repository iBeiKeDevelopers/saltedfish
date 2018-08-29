<?php

namespace App\Http\Controllers\Resource;

use Auth;
use App\User;
use App\User\Contact;
use App\User\Identity;
use App\Enums\CollegeType as College;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
        if($identity)
            $identity->degree = "$identity->degree";
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

    public function avatar(Request $request)
    {
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        if(!isLegalExt($ext)) abort(500);
        $path = $file->store('public/'.date('Y/M'));
        $user = User::find(Auth::id());
        $user->avatar = Storage::url($path);
        $user->save();
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

        $word = $request->input('_word', '');
        $message = validate($raw, $word);
        if(strlen($message))
            return [
                'status'    =>      false,
                'error'     =>      $message,
            ];
        switch($word) {
            case 'common':
                if($user->update($request->input()))
                    return ['status' => true];
            case 'identity':
                if(!$identity = Identity::find($user->id))
                    $res = Identity::create($raw);
                else
                    $res = $identity->update($raw);
                if($res)
                    return ['status' => true];
            case 'contact':
                if(!$contact = Contact::find($user->id))
                    $res = Contact::create($raw);
                else
                    $res = $contact->update($raw);
                if($res)
                    return ['status' => true];
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

function validate(&$arr, $word) {
    switch($word) {
        case 'common':
            $nick_name = $arr['nick_name'];
            if(!strlen($nick_name))
                return "nick name cannot be null!";
            $arr = [
                'nick_name' => $nick_name,
                'id' => Auth::id(),
            ];
            return '';
        case 'identity':
            if(!in_array($arr['degree'], [0,1,2]))
                return "error";
            if(!isStudentId($arr['student_id']))
                return "invalid student id!";
            $arr = [
                'degree' => $arr['degree'],
                'student_id' => $arr['student_id'],
                'id' => Auth::id(),
            ];
            return '';
        case 'contact':
            $college = new College($arr['college']);
            if(!$college)
                return "invalid college!";
            if(!is_numeric($arr['domitory']) || strlen($arr['domitory']) > 3)
                return "invalid domitory number!";
            if(!is_numeric($arr['room']) || strlen($arr['room']) > 4 ||strlen($arr['room']) < 3)
                return "invalid room number!";
            if(!is_numeric($arr['phone']) || strlen($arr['phone']) != 11)
                return "invalid phone number!";
            $arr = [
                'college' => $arr['college'],
                'domitory' => $arr['domitory'],
                'room' => $arr['room'],
                'phone' => $arr['phone'],
                'id' => Auth::id(),
            ];
            return '';
        default: return '';
    }
}

function isStudentId($number) {
    if(strlen("$number") != 8)
        return false;
    if(!is_numeric($number))
        return false;
    return true;
}

function isLegalExt($ext) {
    $arr = [
        'jpg', 'jpeg', 'png',
    ];
    if(in_array($ext, $arr))
        return true;
    else return false;
}