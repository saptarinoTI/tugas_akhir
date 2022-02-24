<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserLoginController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('superadmin')) {
            $roles = Role::select('id', 'name')
                ->where('name', '!=', 'superadmin')
                ->where('name', '!=', 'dosen')
                ->get();
        } elseif (Auth::user()->hasRole('admin')) {
            $roles = Role::select('id', 'name')
                ->where('name', '!=', 'superadmin')
                ->where('name', '!=', 'admin')
                ->where('name', '!=', 'dosen')
                ->get();
        }
        return view('admin.users.userlogin.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,id|integer',
            'name' => 'required',
            'role' => 'required',
        ]);

        $user = new User();
        $user->id = $request->username;
        $user->name = $request->name;
        $user->password = Hash::make('12345678');
        $user->save();

        $user->assignRole($request->role);

        Alert::success('Berhasil', 'Data login user berhasil ditambahkan');
        return redirect()->route('user-login.index');
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
                        return '<a href="user-login/' . $row->id . '" class="btn btn-delete border-0 px-2 btn-danger"><i class="ti ti-trash"></i></a>';
                    }
                } elseif (auth()->user()->hasRole('superadmin')) {
                    return '<a href="user-login/' . $row->id . '" class="btn btn-delete border-0 px-2 btn-danger"><i class="ti ti-trash"></i></a>';
                }
            })
            ->rawColumns(['id', 'name', 'email', 'role', 'btn'])
            ->make(true);
    }

    public function importData(Request $request)
    {
        $messages = [
            'required' => 'Silahkan pilih file excel terlebih dahulu.',
        ];
        $request->validate([
            'importexcel' => 'required',
        ], $messages);
        $extensions = array("xls", "xlsx");
        $result = array($request->file('importexcel')->getClientOriginalExtension());

        if (in_array($result[0], $extensions)) {
            // Do something when Succeeded
            Excel::import(new UsersImport, $request->file('importexcel'));
            Alert::success('Berhasil', 'Data login user berhasil ditambahkan');
            return back();
        } else {
            // Do something when it fails
            Alert::error('Gagal', 'Silahkan upload file excel dengan ekstensi xlsx atau xls');
            return back();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->dosen->delete();
        $user->delete();
    }
}
