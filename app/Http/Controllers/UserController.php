<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Mail;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {
        
        $users = User::all();
        return view('user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdateUserRequest $request)
    {
        try {

            $user = $this->userRepository->createNew($request->all());

            return redirect()->route('user.index')
                         ->with('success', __('page-data.user_added_successfully'));
        } catch(Exception $e) {
            dd($e);
            return redirect()->route('user.index')
                         ->with('error', $e->getMessage());            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrUpdateUserRequest $request)
    {   
       
        try {

            $user = $this->userRepository->updateUserInfo($request->user_id, $request->all());

            return redirect()->route('user.index')
                         ->with('success', __('page-data.user_updated_successfully'));
    
        } catch(Exception $e) {
            return redirect()->route('user.index')
                         ->with('error', $e->getMessage()); 
    
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')
                         ->with('deleted', __('page-data.user_deleted_successfully'));
    }
   
}
