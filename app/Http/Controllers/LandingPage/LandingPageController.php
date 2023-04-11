<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\News;
use App\Models\Scheme;
use App\Models\ViewConf;
use App\Models\Proposal;
use App\Models\Tahapan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        $data['configs'] = ViewConf::get();
        $data['informations'] = Information::get();
        $data['schemes'] = Scheme::get();
        

        $data['news'] = News::limit(10)->get();
        $data['view_setting'] = ViewConf::orderBy('updated_at', 'desc')->first();

        $data['proposals'] = Proposal::get();
        $data['news'] = News::limit(10)->get(); // limit :

        if ($request->ajax()) {
            return DataTables::of($data['proposals'])
                    ->addIndexColumn()
                    ->addColumn('nama_mahasiswa', function($row){
                        return $row->student->name;
                    })
                    ->addColumn('jurusan_mahasiswa', function($row){
                        return $row->student->prody->name;
                    })
                    ->addColumn('skema', function($row){
                        return $row->scheme->short;
                    })
                    ->editColumn('file_done', function($row){
                        if($row->file_done != null){
                            return '
                                <td class="text-center">
                                    <a href="'.  asset($row->file_done) .'" class="btn btn-sm btn-success" title="Download"><i class="bi bi-download"></i></a>
                                </td>
                            ';
                        } else {
                            return '
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-danger" title="Download" disabled><i class="bi bi-download"></i></a>
                                </td>
                            ';
                        }
                    })
                    ->rawColumns(['file_done'])
                    ->make(true);
        }

        return view('home', $data);
    }

    public function detail($id)
    {
        $data['news'] = News::find($id); // find : untuk mengambil data dari database dengan data primary key

        return view('detail', $data);
    }
}
