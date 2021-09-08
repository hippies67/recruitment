<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use Alert;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['semester'] = Semester::all();
        return view('back.semester.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkSemesterName(Request $request) 
    {
        if($request->Input('nama')){
            $nama = Semester::where('nama',$request->Input('nama'))->first();
            if($nama){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_nama')){
            $edit_nama = Semester::where('nama',$request->Input('edit_nama'))->first();
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

        Semester::create($data)
        ? Alert::success('Berhasil', 'Semester telah berhasil ditambahkan!')
        : Alert::error('Error', 'Semester gagal ditambahkan!');

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
    public function update(Request $request, Semester $semester)
    {
        $data = [
            'nama' => $request->edit_nama,
        ];

        $semester->update($data)
        ? Alert::success('Berhasil', "Semester telah berhasil diubah!")
        : Alert::error('Error', "Semester gagal diubah!");

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
        $semester = Semester::findOrFail($id);
        foreach($semester->recruitmentUsers as $recruitment_user) {
            $recruitment_user->delete();
        }

        $semester->delete()
            ? Alert::success('Berhasil', "Semester dan seluruh data terkait telah berhasil dihapus.")
            : Alert::error('Error', "Semester dan seluruh data terkait gagal dihapus!");

        return redirect()->back();
    }
}
