<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use LaravelFileViewer;

class DashboardController extends Controller
{
    
    public function review()
    {
        $data["proposal"] = Proposal::get();
        return view('coba-review', $data);
    }
    
    public function post_review($file)
    {   
        $filepath='public/'.$file;
        $file_url ="public/".$file;

        $file_data=[
            [
                'label' => __('Label'),
                'value' => "Value"
                ]
            ];
            
            return LaravelFileViewer::show($file,$filepath,$file_url,$file_data);
        }
        
        public function index()
        {
            $data['proposal'] = Proposal::get();
            
            return view('admin.index', $data);
        }
        
        public function ajax() // ajax :
        {
            $data['year'] = Proposal::select('year')->groupBy('year')->get(); // groupBy :
            foreach ($data['year'] as $item){ // foreach :
                $response[] = [
                    'year' => $item->year,
                    'total' => Proposal::where('year', $item->year)->count(), // count :
                ];
            }
            
            return response()->json($response);
        }
        
        public function ajaxLolos() // ajaxLolos :
        {
            $data['year'] = Proposal::select('year')->groupBy('year')->get();
            foreach ($data['year'] as $item){
                $response[] = [
                    'year' => $item->year,
                    'total' => Proposal::where('year', $item->year)->where('status', 3)->count(), // 3 :
                ];
            }
            
            return response()->json($response);
        }
    }
    