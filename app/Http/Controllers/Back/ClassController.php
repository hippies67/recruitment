<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use Alert;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['student_class'] = StudentClass::all();
        return view('back.student_class.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkClassName(Request $request) 
    {
        if($request->Input('nama')){
            $nama = StudentClass::where('nama',$request->Input('nama'))->first();
            if($nama){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_nama')){
            $edit_nama = StudentClass::where('nama',$request->Input('edit_nama'))->first();
            if($edit_nama){
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
            'nama' => $request->nama,
        ];

        StudentClass::create($data)
        ? Alert::success('Berhasil', 'Kelas telah berhasil ditambahkan!')
        : Alert::error('Error', 'Kelas gagal ditambahkan!');

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
    public function update(Request $request, $id)
    {
        $studentClass = StudentClass::findOrFail($id);
        $data = [
            'nama' => $request->edit_nama,
        ];

        $studentClass->update($data)
        ? Alert::success('Berhasil', "Kelas telah berhasil diubah!")
        : Alert::error('Error', "Kelas gagal diubah!");

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
        $studentClass = StudentClass::findOrFail($id);
        foreach($studentClass->recruitmentUsers as $recruitment_user) {
            $recruitment_user->delete();
        }
        
        $studentClass->delete()
            ? Alert::success('Berhasil', "Kelas dan seluruh data terkait telah berhasil dihapus.")
            : Alert::error('Error', "Kelas dan seluruh data terkait gagal dihapus!");

        return redirect()->back();
    }
}
