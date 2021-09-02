<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpecializationDivision;
use Alert;

class SpecializationDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'division' => $request->division,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ];

        SpecializationDivision::create($data)
        ? Alert::success('Berhasil', 'Spesialisasi telah berhasil ditambahkan!')
        : Alert::error('Error', 'Spesialisasi gagal ditambahkan!');

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
    public function update(Request $request, SpecializationDivision $SpecializationDivision)
    {
        $data = [
            'division' => $request->edit_divisi,
            'nama' => $request->edit_nama,
            'deskripsi' => $request->edit_deskripsi,
        ];

        $SpecializationDivision->update($data)
        ? Alert::success('Berhasil', "Spesialisasi telah berhasil diubah!")
        : Alert::error('Error', "Spesialisasi gagal diubah!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecializationDivision $SpecializationDivision)
    {
        $SpecializationDivision->delete()
            ? Alert::success('Berhasil', "Spesialisasi telah berhasil dihapus.")
            : Alert::error('Error', "Spesialisasi gagal dihapus!");

        return redirect()->back();
    }
}
