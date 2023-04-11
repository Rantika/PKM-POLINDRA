<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function create($param){
        if ($param['for'] == 'student'){

            $type = ['confirmed_bimbingan', 'approval_proposal', 'reviewed_proposal', 'given_simbelmawa'];
            $data = [
                [
                    'title' => 'Bimbingan dikonfirmasi Pembimbing',
                    'body'  => 'Bimbingan '.$param['description'].' telah dikonfirmasi pembimbing'
                ],
                [
                    'title' => 'Proposal telah di-approve Pembimbing',
                    'body'  => 'Proposal yang anda ajukan telah diperiksa dan disetujui pembimbing'
                ],
                [
                    'title' => 'Proposal telah di-review Reviewer',
                    'body'  => 'Proposal yang anda ajukan telah diperiksa dan direview reviewer'
                ],
                [
                    'title' => 'Akun simbelmawa telah diberikan',
                    'body'  => 'Admin telah memberikan akun simbelwama anda'
                ],
            ];
        }
        if ($param['for'] == 'lecturer'){

            $type = ['added_bimbingan', 'uploaded_proposal', 'given_simbelmawa'];
            $data = [
                [
                    'title' => 'Dosbing - Peserta menambahkan bimbingan',
                    'body'  => 'Peserta '.$param['description'].' mengajukan bimbingan baru'
                ],
                [
                    'title' => 'Dosbing - Peserta mengupload proposal',
                    'body'  => 'Peserta '.$param['description'].' telah mengupload proposal PKM'
                ],
                [
                    'title' => 'Dosbing - Akun simbelmawa telah diberikan',
                    'body'  => 'Admin telah memberikan akun simbelwama anda'
                ],
            ];
        }
        if ($param['for'] == 'reviewer'){
            $type = ['uploaded_proposal', 'uploaded_proposal_done'];
            $data = [
                [
                    'title' => 'Reviewer - Peserta mengopload proposal',
                    'body'  => 'Peserta '.$param['description'].' telah mengupload proposal hasil review'
                ],
                [
                    'title' => 'Reviewer - Peserta mengupload proposal hasil review',
                    'body'  => 'Peserta '.$param['description'].' telah mengupload proposal hasil review'
                ],
            ];
        }
        if ($param['for'] == 'admin'){
            $type = ['student_registration', 'added_bimbingan', 'uploaded_proposal_done'];
            $data = [
                [
                    'title' => 'Pendaftaran Peserta Baru',
                    'body'  => 'Peserta '.$param['description'].' baru saja mendaftar'
                ],
                [
                    'title' => 'Peserta menambahkan bimbingan',
                    'body'  => 'Peserta '.$param['description'].' mengajukan bimbingan ke dosen pembimbing'
                ],
                [
                    'title' => 'Peserta mengupload proposal hasil review',
                    'body'  => 'Peserta '.$param['description'].' telah mengupload proposal hasil review'
                ],
            ];
        }

        Notification::create([
            'user_id'   => $param['id'],
            'type'      => $type[$param['type']],
            'title'     => $data[$param['type']]['title'],
            'body'      => $data[$param['type']]['body'],
        ]);
    }

    public function get($user_id)
    {
        return response()->json([
            'new' => Notification::where('user_id', $user_id)->where('is_read', 0)->count(), // 0 :
            'data' => Notification::where('user_id', $user_id)->limit(5)->orderBy('created_at', 'DESC')->get(), // limit 5 : orderBy :
        ]);
    }

    public function getAll($user_id)
    {
        return response()->json(Notification::where('user_id', $user_id)->get());
    }

    public function updateRead($user_id)
    {
        return response()->json(
            Notification::where('user_id', $user_id)->where('is_read', 0)->update([
                'is_read'   => 1
            ])
        );
    }
}
