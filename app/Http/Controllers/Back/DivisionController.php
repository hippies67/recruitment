<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\SpecializationDivision;
use Alert;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['division'] = Division::all();
        $data['specialization_division'] = SpecializationDivision::all();
        return view('back.division.data', $data);
    }

    public function checkDivisionName(Request $request) 
    {
        if($request->Input('nama')){
            $nama = Division::where('nama',$request->Input('nama'))->first();
            if($nama){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_nama')){
            $edit_nama = Division::where('nama',$request->Input('edit_nama'))->first();
            if($edit_nama){
                return 'false';
            }else{
                return  'true';
            }
        }
    }

    public function checkSpecializationDivisionName(Request $request) 
    {
        if($request->Input('nama')){
            $nama = SpecializationDivision::where('nama',$request->Input('nama'))->first();
            if($nama){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_nama')){
            $edit_nama = SpecializationDivision::where('nama',$request->Input('edit_nama'))->first();
            if($edit_nama){
                return 'false';
            }else{
                return  'true';
            }
        }
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
        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ];

        Division::create($data)
        ? Alert::success('Berhasil', 'Divisi telah berhasil ditambahkan!')
        : Alert::error('Error', 'Divisi gagal ditambahkan!');

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
    public function update(Request $request, Division $division)
    {
        $data = [
            'nama' => $request->edit_nama,
            'deskripsi' => $request->edit_deskripsi,
        ];

        $division->update($data)
        ? Alert::success('Berhasil', "Divisi telah berhasil diubah!")
        : Alert::error('Error', "Divisi gagal diubah!");

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
        $division = Division::findOrFail($id);
        foreach($division->specialization_divisions as $specialization) {
            $specialization->delete();
        }

        foreach($division->recruitmentUsers as $recruitment_user) {
            $recruitment_user->delete();
        }
        
        $division->delete()
            ? Alert::success('Berhasil', "Divisi dan seluruh data terkait telah berhasil dihapus.")
            : Alert::error('Error', "Divisi gagal dan seluruh data terkait dihapus!");

        return redirect()->back();
    }
}
