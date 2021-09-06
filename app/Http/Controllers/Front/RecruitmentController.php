<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use App\Models\RecruitmentUser;
use App\Models\Division;
use App\Models\StudyProgram;
use App\Models\Semester;
use App\Models\StudentClass;
use App\Models\SpecializationDivision;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['recruitment'] = Recruitment::all();
        $data['recruitment_user'] = RecruitmentUser::all();
        $data['class'] = StudentClass::all();
        $data['division'] = Division::all();
        $data['study_program'] = StudyProgram::all();
        $data['semester'] = Semester::all();
        $data['specialization_division'] = SpecializationDivision::all();
        if(count($data['recruitment']) < 1 || empty(getActiveRecruitment()) || count($data['class']) < 1 || count($data['division']) < 1 || count($data['study_program']) < 1 || count($data['semester']) < 1 || count($data['specialization_division']) < 1) {
            return view('front.coming_soon');
        } else {
            return view('front.data', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkEmail(Request $request) 
    {
        if($request->Input('email')){
            $email = RecruitmentUser::where('email',$request->Input('email'))->first();
            if($email){
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
            'recruitment' => getActiveRecruitment()->id,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'program_studi' => $request->program_studi,
            'semester' => $request->semester,
            'divisi' => $request->divisi_value,
            'pengetahuan_divisi' => $request->pengetahuan_divisi,
            'pengalaman_divisi' => $request->pengalaman_divisi,
            'pengalaman_organisasi' => $request->pengalaman_organisasi,
            'minat_menjadi_pengurus' => $request->minat_menjadi_pengurus,
            'status' => 'proses'
        ];

        RecruitmentUser::create($data);
        
        return redirect()->back()->with('sukses', 'Data telah berhasil dikirim');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
