<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudyProgram;
use Alert;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['study_program'] = StudyProgram::all();
        return view('back.study_program.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkStudyProgramName(Request $request) 
    {
        if($request->Input('nama')){
            $nama = StudyProgram::where('nama',$request->Input('nama'))->first();
            if($nama){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_nama')){
            $edit_nama = StudyProgram::where('nama',$request->Input('edit_nama'))->first();
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

        StudyProgram::create($data)
        ? Alert::success('Berhasil', 'Program Studi telah berhasil ditambahkan!')
        : Alert::error('Error', 'Program Studi gagal ditambahkan!');

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
        $studyProgram = StudyProgram::findOrFail($id);
        $data = [
            'nama' => $request->edit_nama,
        ];

        $studyProgram->update($data)
        ? Alert::success('Berhasil', "Program Studi telah berhasil diubah!")
        : Alert::error('Error', "Program Studi gagal diubah!");

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
        $studyProgram = StudyProgram::findOrFail($id);
        $studyProgram->delete()
            ? Alert::success('Berhasil', "Program Studi telah berhasil dihapus.")
            : Alert::error('Error', "Program Studi gagal dihapus!");

        return redirect()->back();
    }
}
