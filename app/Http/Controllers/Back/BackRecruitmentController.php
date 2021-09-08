<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use Alert;
use Storage;

class BackRecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['recruitment'] = Recruitment::all();
        $data['checkIfExists'] = Recruitment::where('status', '=', 'aktif')->count();
        return view('back.recruitment.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkRecruitmentYear(Request $request) 
    {
        if($request->Input('tahun')){
            $tahun = Recruitment::where('tahun',$request->Input('tahun'))->first();
            if($tahun){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_tahun')){
            $edit_tahun = Recruitment::where('tahun',$request->Input('edit_tahun'))->first();
            if($edit_tahun){
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
        $banner = ($request->banner) ? $request->file('banner')->store("/public/input/recruitments") : null;
        $data = [
            'tahun' => $request->tahun,
            'selayang_pandang' => $request->selayang_pandang,
            'banner' => $banner,
            'status' => 'tidak_aktif',
        ];

        Recruitment::create($data)
        ? Alert::success('Berhasil', 'Recruitment telah berhasil ditambahkan!')
        : Alert::error('Error', 'Recruitment gagal ditambahkan!');

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
        $recruitment = Recruitment::findOrFail($id);
        if($request->hasFile('edit_banner')) {
            if(Storage::exists($recruitment->banner) && !empty($recruitment->banner)) {
                Storage::delete($recruitment->banner);
            }

            $banner = $request->file("edit_banner")->store("/public/input/recruitments");
        }
        $data = [
            'tahun' => $request->edit_tahun ? $request->edit_tahun : $recruitment->tahun,
            'selayang_pandang' => $request->edit_selayang_pandang ? $request->edit_selayang_pandang : $recruitment->selayang_pandang,
            'banner' => $request->hasFile('edit_banner') ? $banner : $recruitment->banner,
            'status' => $request->edit_status ? $request->edit_status : $recruitment->status,
        ];

        $recruitment->update($data)
        ? Alert::success('Berhasil', "Recruitment telah berhasil diubah!")
        : Alert::error('Error', "Recruitment gagal diubah!");

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
        $recruitment = Recruitment::findOrFail($id);
        foreach($recruitment->recruitmentUsers as $recruitment_users) {
            $recruitment_users->delete();
        }
        $recruitment->delete()
            ? Alert::success('Berhasil', "Recruitment telah berhasil dihapus.")
            : Alert::error('Error', "Recruitment gagal dihapus!");

        return redirect()->back();
    }
}
