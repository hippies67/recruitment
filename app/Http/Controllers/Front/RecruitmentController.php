<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CV;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use App\Models\RecruitmentUser;
use App\Models\Division;
use App\Models\StudyProgram;
use App\Models\Semester;
use App\Models\StudentClass;
use App\Models\SpecializationDivision;
use App\Models\District;
use App\Models\Village;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $data['districts'] = District::where('regency_id', '=', '3211')->get();
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

    public function checkNim(Request $request)
    {
        if($request->Input('nim')){
            $nim = RecruitmentUser::where('nim',$request->Input('nim'))->first();
            if($nim){
                return 'false';
            }else{
                return  'true';
            }
        }
    }

    public function getVillage(Request $request)
    {
        $data['villages'] = Village::where("district_id",$request->district_id)
                    ->get(["name","id"]);
        return response()->json($data);
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
        Log::info($request);
        $request->validate([
            'nama_lengkap' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'kelas' => 'required',
            'program_studi' => 'required',
            'semester' => 'required',
            'divisi_value' => 'required',
            'spesialisasi_divisi' => 'required',
            'pengetahuan_divisi' => 'required',
            'pengalaman_divisi' => 'required',
            'pengalaman_organisasi' => 'required',
            'minat_menjadi_pengurus' => 'required',
            'file' => 'required|mimetypes:application/pdf',
        ]);
        $data = [
            'recruitment' => getActiveRecruitment()->id,
            'nama_lengkap' => $request->nama_lengkap,
            'nim' => $request->nim,
            'email' => $request->email,
            'alamat' => $request->kecamatan . ', ' . $request->desa,
            'kelas' => $request->kelas,
            'program_studi' => $request->program_studi,
            'semester' => $request->semester,
            'divisi' => $request->divisi_value,
            'spesialisasi_divisi' => $request->spesialisasi_divisi,
            'pengetahuan_divisi' => $request->pengetahuan_divisi,
            'pengalaman_divisi' => $request->pengalaman_divisi,
            'pengalaman_organisasi' => $request->pengalaman_organisasi,
            'minat_menjadi_pengurus' => $request->minat_menjadi_pengurus,
            'status' => 'proses'
        ];
        $file = $request->file('file')->store("/public/input/recruitments");

        RecruitmentUser::create($data);
        $userId = DB::table('recruitment_users')
            ->select('id')
            ->where('nim', '=', $data['nim'])
            ->get();

        $dataCV = [
            'user' => $userId[0]->id,
            'fileName' => $file
        ];
        CV::create($dataCV);
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
