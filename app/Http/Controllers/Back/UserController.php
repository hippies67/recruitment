<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\User;
use Alert;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = User::all();
        return view('back.user.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkUsername(Request $request) 
    {
        if($request->Input('username')){
            $username = User::where('username',$request->Input('username'))->first();
            if($username){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_username')){
            $edit_username = User::where('username',$request->Input('edit_username'))->first();
            if($edit_username){
                return 'false';
            }else{
                return  'true';
            }
        }
    }

    public function checkEmail(Request $request) 
    {
        if($request->Input('email')){
            $email = User::where('email',$request->Input('email'))->first();
            if($email){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_email')){
            $edit_email = User::where('email',$request->Input('edit_email'))->first();
            if($edit_email){
                return 'false';
            }else{
                return  'true';
            }
        }
    }

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
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        User::create($data)
        ? Alert::success('Berhasil', 'User telah berhasil ditambahkan!')
        : Alert::error('Error', 'User gagal ditambahkan!');

        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function password($id)
    {
        $data['user'] = User::findOrFail($id);

        return view('back.user.update_password', $data);
    }

    public function updatePassword(Request $request, User $user) 
    {
        
            $this->validate($request, [
           
                'password_lama' => ['required', new MatchOldPassword],
                'password_baru' => 'required',
                'konfirmasi_password_baru' => 'same:password_baru',
            ],
            [
                'password_lama.required' => 'Password Lama harus di isi.',
                'password_baru.required' => 'Password Baru harus di isi.',
                'konfirmasi_password_baru.same' => 'Konfirmasi Password Baru tidak sama.',
            ]);
        
        $data = [
            'password' => Hash::make($request->password_baru),
        ];

        $user->update($data)
        ? Alert::success('Berhasil', "Password telah berhasil diubah!")
        : Alert::error('Error', "Password gagal diubah!");

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = [
            'name' => $request->edit_name,
            'username' => $request->edit_username,
            'email' => $request->edit_email,
            'password' => Hash::make($request->edit_password),
        ];

        $user->update($data)
        ? Alert::success('Berhasil', "User telah berhasil diubah!")
        : Alert::error('Error', "User gagal diubah!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete()
            ? Alert::success('Berhasil', "User telah berhasil dihapus.")
            : Alert::error('Error', "User gagal dihapus!");

        return redirect()->back();
    }
}
