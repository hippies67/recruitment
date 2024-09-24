<?php

namespace App\Http\Controllers\Back;

use App\Exports\RecruitmentUserExport;
use App\Http\Controllers\Controller;
use App\Models\CV;
use Illuminate\Http\Request;
use App\Models\RecruitmentUser;
use App\Mail\TerimaRecruitmentMail;
use App\Mail\TolakRecruitmentMail;
use App\Mail\LolosRecruitmentMail;
use App\Mail\TidakLolosRecruitmentMail;
use Alert;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
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
        $data['recruitment_user_cv'] = CV::all();
        $data['recruitment_user_proses'] = RecruitmentUser::where('status', '=', 'proses')->get();
        $data['recruitment_user_lolos'] = RecruitmentUser::where('status', '=', 'lolos')->get();
        $data['recruitment_user_tidak_lolos'] = RecruitmentUser::where('status', '=', 'tidak_lolos')->get();
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

    public function send_lolos_email_no_stage_update($id)
    {
        $recruitment_user = RecruitmentUser::findOrFail($id);
        $recruitment_user->update(['email_sent' => 1]);
        Log::info('mengirim email ke '.$recruitment_user->email.' (send_lolos_email_no_stage_update)');
        Mail::to($recruitment_user->email)->send(new LolosRecruitmentMail($recruitment_user));

        if(count(Mail::failures()) > 0) {
            Alert::error('Error', "Email gagal dikirim!");
            Log::error('Email gagal dikirim (send_lolos_email_no_stage_update)');
        } else {
            Alert::success('Berhasil', "Email telah berhasil dikirim.");
            Log::info('Email berhasil dikirim (send_lolos_email_no_stage_update)');
        }

        return redirect()->back();
    }

    public function send_lolos_email($id)
    {
        $recruitment_user = RecruitmentUser::findOrFail($id);
        $recruitment_user->update(['email_sent' => 1, 'stage' => 2]);
        Log::info('mengirim email ke '.$recruitment_user->email.' (send_lolos_email)');
        Mail::to($recruitment_user->email)->send(new LolosRecruitmentMail($recruitment_user));

        if(count(Mail::failures()) > 0) {
            Alert::error('Error', "Email gagal dikirim!");
            Log::error('Email gagal dikirim (send_lolos_email)');
        } else {
            Alert::success('Berhasil', "Email telah berhasil dikirim.");
            Log::info('Email berhasil dikirim (send_lolos_email)');
        }

        return redirect()->back();
    }

    public function send_tidak_lolos_email($id)
    {
        $recruitment_user = RecruitmentUser::findOrFail($id);
        $recruitment_user->update(['email_sent' => 1]);
        Log::info('mengirim email ke '.$recruitment_user->email.' (send_tidak_lolos_email)');
        Mail::to($recruitment_user->email)->send(new TidakLolosRecruitmentMail($recruitment_user));

        if(count(Mail::failures()) > 0) {
            Alert::error('Error', "Email gagal dikirim!");
            Log::error('Email gagal dikirim (send_tidak_lolos_email)');
        } else {
            Alert::success('Berhasil', "Email telah berhasil dikirim.");
            Log::info('Email berhasil dikirim (send_tidak_lolos_email)');
        }

        return redirect()->back();
    }

    public function stage($id)
    {
        $recruitment_user = RecruitmentUser::findOrFail($id);

        $recruitment_user->update(['stage' => 2])
        ? Alert::success('Berhasil', "Peserta telah dialihkan ke tahap kedua!")
        : Alert::error('Error', "Peserta gagal dialihkan ke tahap kedua!");

        return redirect()->back();
    }

    public function send_terima_email($id)
    {
        $recruitment_user = RecruitmentUser::findOrFail($id);
        $recruitment_user->update(['email_sent' => 2]);
        Log::info('mengirim email ke '.$recruitment_user->email.' (send_terima_email)');
        Mail::to($recruitment_user->email)->send(new TerimaRecruitmentMail($recruitment_user));

        if(count(Mail::failures()) > 0) {
            Alert::error('Error', "Email gagal dikirim!");
            Log::error('Email gagal dikirim (send_terima_email)');
        } else {
            Alert::success('Berhasil', "Email telah berhasil dikirim.");
            Log::info('Email berhasil dikirim (send_terima_email)');
        }

        return redirect()->back();
    }

    public function send_tolak_email($id)
    {
        $recruitment_user = RecruitmentUser::findOrFail($id);
        $recruitment_user->update(['email_sent' => 2]);
        Log::info('mengirim email ke '.$recruitment_user->email.' (send_tolak_email)');
        Mail::to($recruitment_user->email)->send(new TolakRecruitmentMail($recruitment_user));

        if(count(Mail::failures()) > 0) {
            Alert::error('Error', "Email gagal dikirim!");
            Log::error('Email gagal dikirim (send_tolak_email)');
        } else {
            Alert::success('Berhasil', "Email telah berhasil dikirim.");
            Log::info('Email berhasil dikirim (send_tolak_email)');
        }

        return redirect()->back();
    }

    public function reset_email(Request $request, $id)
    {
        $recruitment_user = RecruitmentUser::findOrFail($id);

        $recruitment_user->update(['email_sent' => $request->email_sent, 'stage' => $request->stage])
        ? Alert::success('Berhasil', "Email telah berhasil direset!")
        : Alert::error('Error', "Email gagal direset.");

        return redirect()->back();
    }

    public function send_all_lolos_email()
    {
        $recruitment_user = RecruitmentUser::where('status', '=', 'lolos')->get();

        $emailSent = RecruitmentUser::where('email_sent', '=', '0')->get();

        if (count($emailSent) < 1) {
            Alert::info('Info', 'Semua email telah terkirim!');
        } else {
            foreach ($recruitment_user as $recruitment) {
                Log::info('mengirim email ke '.$recruitment->email.' (send_all_lolos_email)');
                Mail::to($recruitment->email)->send(new LolosRecruitmentMail($recruitment));

                if ($recruitment->update(['email_sent' => 1, 'stage' => 2])){
                    Alert::success('Berhasil', "Email telah berhasil dikirim!");
                    Log::info('Semua Email berhasil dikirim (send_all_lolos_email)');
                }else {
                    Alert::error('Error', "Email gagal dikirim.");
                    Log::error('Semua Email gagal dikirim (send_all_lolos_email)');
                }
            }
        }

        return redirect()->back();
    }

    public function send_all_tidak_lolos_email()
    {
        $recruitment_user = RecruitmentUser::where('status', '=', 'tidak_lolos')->get();

        $emailSent = RecruitmentUser::where('email_sent', '=', '0')->get();

        if (count($emailSent) < 1) {
            Alert::info('Info', 'Semua email telah terkirim!');
        } else {
            foreach ($recruitment_user as $recruitment) {
                Log::info('mengirim email ke '.$recruitment->email.' (send_all_tidak_lolos_email)');
                Mail::to($recruitment->email)->send(new TidakLolosRecruitmentMail($recruitment));

                if ($recruitment->update(['email_sent' => 1])){
                    Alert::success('Berhasil', "Email telah berhasil dikirim!");
                    Log::info('Semua Email berhasil dikirim (send_all_tidak_lolos_email)');
                }else {
                    Alert::error('Error', "Email gagal dikirim.");
                    Log::error('Semua Email gagal dikirim (send_all_tidak_lolos_email)');
                }
            }
        }

        return redirect()->back();
    }

    public function send_all_terima_email()
    {
        $recruitment_user = RecruitmentUser::where('status', '=', 'terima')->get();

        $emailSent = RecruitmentUser::where('email_sent', '=', '1')->get();

        if (count($emailSent) < 1) {
            Alert::info('Info', 'Semua email telah terkirim!');
        } else {
            foreach ($recruitment_user as $recruitment) {
                Log::info('mengirim email ke '.$recruitment->email.' (send_all_terima_email)');
                Mail::to($recruitment->email)->send(new TerimaRecruitmentMail($recruitment));

                if ($recruitment->update(['email_sent' => 2])){
                    Alert::success('Berhasil', "Email telah berhasil dikirim!");
                    Log::info('Semua Email berhasil dikirim (send_all_terima_email)');
                } else {
                    Alert::error('Error', "Email gagal dikirim.");
                    Log::error('Semua Email gagal dikirim (send_all_terima_email)');
                }
            }
        }

        return redirect()->back();
    }

    public function send_all_tolak_email()
    {
        $recruitment_user = RecruitmentUser::where('status', '=', 'tolak')->get();

        $emailSent = RecruitmentUser::where('email_sent', '=', '1')->get();

        if (count($emailSent) < 1) {
            Alert::info('Info', 'Semua email telah terkirim!');
        } else {
            foreach ($recruitment_user as $recruitment) {
                Log::info('mengirim email ke '.$recruitment->email.' (send_all_tolak_email)');
                Mail::to($recruitment->email)->send(new TolakRecruitmentMail($recruitment));

                if ($recruitment->update(['email_sent' => 2])) {
                    Alert::success('Berhasil', "Email telah berhasil dikirim!");
                    Log::info('Semua Email berhasil dikirim (send_all_tolak_email)');
                } else {
                    Alert::error('Error', "Email gagal dikirim.");
                    Log::error('Semua Email gagal dikirim (send_all_tolak_email)');
                }
            }
        }

        return redirect()->back();
    }

    public function export() {
        return Excel::download(new RecruitmentUserExport, 'data recruitment.xlsx');
    }
}
