<?php

namespace App\Http\Controllers;

use App\Model\Advertisement;
use Illuminate\Http\Request;
use App\Http\Resources\AdvertisementResource;
use Auth;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return AdvertisementResource::collection(Advertisement::orderBy('id', 'desc')->paginate($request->take ?? 10));
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
        if ($request->file) {
            $file = $request->file;
            $allow_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
            $file_extension = $file->getClientOriginalExtension();
            if(!in_array($file_extension, $allow_extensions)){
              return response()->json(['error'=>true]);
            }
            $file_directory = 'upload/advertisement/';
            $file_path = $file_directory . time() . "-" . $file->getClientOriginalName();
            $file->move($file_directory, $file_path);
            $advertisement = new Advertisement();
            $advertisement->file_title = $request->title;
            $advertisement->file_path = $file_path;
            $advertisement->user_id = Auth::id();
            $advertisement->file_extension = $file_extension;
            $advertisement->save();
            return response()->json($advertisement);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        return new AdvertisementResource($advertisement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        return new AdvertisementResource($advertisement->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        if($advertisement->delete())
        $advertisement->file_path ? unlink($advertisement->file_path) : null;
        return new AdvertisementResource($advertisement);
    }
}
