<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            # jika ada ajak maka
            $data = (new UserService)->all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn_1 =  '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" data-url="' . route('user.edit', $row->id) . '" class="edit btn btn-primary btn-sm editItem"><i class="fas fa-edit"></i></a>';
                    $actionBtn = $actionBtn_1 .  ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-url="' . route('user.destroy', $row->id) . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem"><i class="fas fa-trash"></i> Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('user.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        (new UserService)->buat($request);
        return response()->json(['success' => 'Data Hass Been Added']);
    }

    public function edit($id)
    {
        $data = (new UserService)->find($id);
        if (empty($data)) {
            # jika data kosong maka
            return response()->json(['error' => 'Data Not Found']);
        }
        return response()->json($data);
    }

    public function destroy($id)
    {
        (new UserService)->destroy($id);
        return response()->json(['success' => 'Data Hass Been Deleted']);
    }
}
