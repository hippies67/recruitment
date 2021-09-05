<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecruitmentUser;
use App\Mail\AcceptedRecruitmentMail;
use App\Mail\RejectedRecruitmentMail;
use Alert;
use Mail;

class RecruitmentUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['recruitment_user'] = RecruitmentUser::all();
        $data['recruitment_user_proses'] = RecruitmentUser::where('status', '=', 'proses')->get();
        $data['recruitment_user_terima'] = RecruitmentUser::where('status', '=', 'terima')->get();
        $data['recruitment_user_tolak'] = RecruitmentUser::where('status', '=', 'tolak')->get();
        return view('back.recruitment_user.data', $data);
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
        //
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
        $recruitment_user = RecruitmentUser::findOrFail($id);

        $data = [
            'status' => $request->status,
        ];

        $recruitment_user->update($data)
        ? Alert::success('Berhasil', "Status peserta telah berhasil diubah!")
        : Alert::error('Error', "Status peserta gagal diubah!");

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
        $recruitment_user = RecruitmentUser::findOrFail($id);
        $recruitment_user->delete()
            ? Alert::success('Berhasil', "Recruitment User telah berhasil dihapus.")
            : Alert::error('Error', "Recruitment User gagal dihapus!");

        return redirect()->back();
    }

    public function send_accepted_email($id)
    {
        $recruitment_user = RecruitmentUser::findOrFail($id);
        $recruitment_user->update(['email_sent' => 1]);

        Mail::to($recruitment_user->email)->send(new AcceptedRecruitmentMail($recruitment_user));

        if(count(Mail::failures()) > 0) {
            Alert::error('Error', "Email gagal dikirim!");
        } else {
            Alert::success('Berhasil', "Email telah berhasil dikirim.");
        }

        return redirect()->back();
    }

    public function send_rejected_email($id)
    {
        $recruitment_user = RecruitmentUser::findOrFail($id);
        $recruitment_user->update(['email_sent' => 1]);

        Mail::to($recruitment_user->email)->send(new RejectedRecruitmentMail($recruitment_user));

        if(count(Mail::failures()) > 0) {
            Alert::error('Error', "Email gagal dikirim!");
        } else {
            Alert::success('Berhasil', "Email telah berhasil dikirim.");
        }

        return redirect()->back();
    }

    public function reset_email($id)
    {
        $recruitment_user = RecruitmentUser::findOrFail($id);
        
        $recruitment_user->update(['email_sent' => 0])
        ? Alert::success('Berhasil', "Email telah berhasil direset!")
        : Alert::error('Error', "Email gagal direset.");

        return redirect()->back();
    }

    public function send_all_accepted_email()
    {
        $recruitment_user = RecruitmentUser::where('status', '=', 'terima')->get();

        $emailSent = RecruitmentUser::where('email_sent', '=', '0')->get();

        if (count($emailSent) < 1) {
            Alert::info('Info', 'Semua email telah terkirim!');
        } else {
            foreach ($recruitment_user as $recruitment) {

                Mail::to($recruitment->email)->send(new AcceptedRecruitmentMail($recruitment));

                $recruitment->update(['email_sent' => 1])
                ? Alert::success('Berhasil', "Email telah berhasil dikirim!")
                : Alert::error('Error', "Email gagal dikirim.");
            }
        }
                
        return redirect()->back();
    }

    public function send_all_rejected_email()
    {
        $recruitment_user = RecruitmentUser::where('status', '=', 'tolak')->get();

        $emailSent = RecruitmentUser::where('email_sent', '=', '0')->get();

        if (count($emailSent) < 1) {
            Alert::info('Info', 'Semua email telah terkirim!');
        } else {
            foreach ($recruitment_user as $recruitment) {

                Mail::to($recruitment->email)->send(new RejectedRecruitmentMail($recruitment));

                $recruitment->update(['email_sent' => 1])
                ? Alert::success('Berhasil', "Email telah berhasil dikirim!")
                : Alert::error('Error', "Email gagal dikirim.");
            }
        }
                
        return redirect()->back();
    }
}
