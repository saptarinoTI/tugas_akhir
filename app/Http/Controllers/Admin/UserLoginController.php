<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.users.userlogin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('superadmin')) {
            $roles = Role::select('id', 'name')
                ->where('name', '!=', 'superadmin')
                ->where('name', '!=', 'dosen')
                ->get();
        }

        if (auth()->user()->hasRole('admin')) {
            $roles = Role::select('id', 'name')
                ->where('name', '!=', 'superadmin')
                ->where('name', '!=', 'admin')
                ->where('name', '!=', 'dosen')
                ->get();
        }
        return view('admin.users.userlogin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,id|numeric',
            'name' => 'required',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::error('Gagal', 'Gagal menambahkan data user.');
            return redirect()->back()->withErrors($validator);
        }
        $user = new User();
        $user->id = $request->username;
        $user->name = strtolower(htmlspecialchars($request->name));
        $user->password = Hash::make('12345678');
        $user->save();
        $user->assignRole($request->role);
        Alert::success('Berhasil', 'Data login user berhasil ditambahkan');
        return redirect()->route('user-login.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->dosen) {
            $user->dosen->delete();
        }
        $user->delete();
    }

    public function getData()
    {
        $roles = User::select('id', 'name', 'email')->whereHas('roles', function ($query) {
            $query->Where('roles.name', '!=', 'superadmin');
        })
            ->with('roles')
            ->get();
        return DataTables::of($roles)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('name', function ($row) {
                return ucwords($row->name);
            })
            ->addColumn('email', function ($row) {
                if ($row->email) {
                    return ucwords($row->email);
                } else {
                    return "<b>-</b>";
                }
            })
            ->addColumn('role', function ($row) {
                $role = ucwords($row->roles->pluck('name')->implode(', '));
                return $role;
            })
            ->addColumn('btn', function ($row) {
                if (auth()->user()->hasRole('admin')) {
                    if ($row->roles->pluck('name')->implode(', ') != 'admin') {
                        return '<a href="user-login/' . $row->id . '" class="btn-delete btn px-2 py-1 btn-danger border-0 text-white"><i class="bx bx-trash"></i></a>';
                    }
                } elseif (auth()->user()->hasRole('superadmin')) {
                    return '<a href="user-login/' . $row->id . '" class="btn-delete btn px-2 py-1 btn-danger border-0 text-white"><i class="bx bx-trash"></i></a>';
                }
            })
            ->rawColumns(['id', 'name', 'email', 'role', 'btn'])
            ->make(true);
    }
}
