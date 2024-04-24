<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use App\Models\ECatologueCategory;
use App\Models\ECatologueFile;
use Illuminate\Support\Carbon;


class GuestECatalogueController extends Controller {

    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }
    
    public function ecatalogue(){
        $catalogues = ECatologueCategory::where('deleted',0)
                                        ->with(['catalogueFiles' => function ($query) {
                                            $query->where('deleted', 0);
                                        }])
                                        ->get();
        $data=[
            'catalogues' => $catalogues,
        ];
        return view('/guest/ecatalogue')->with($data);
    }

    public function downloadfile($id){

        $file = ECatologueFile::find($id);
        $file_path = public_path('guestasset/ecatalogue') . '/' . $file->serverfilename;
        
        if ($file->deleted == 0) {
            $file->downloaded = $file->downloaded + 1;
            $file->save();

            return response()->download($file_path);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }



}

?>