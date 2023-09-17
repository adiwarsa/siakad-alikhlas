<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:users-read', ['only' => ['index']]);
        $this->middleware('permission:users-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:users-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Users';
        $data['users'] = User::all();

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Data User';
        $data['roles'] = Role::all();

        return view('users.create', $data);
    }

    public function createortu()
    {
        $data['pageTitle'] = 'Tambah Data Orang Tua';
        $data['santri'] = Santri::all();

        return view('users.createortu', $data);
    }

    public function storeortu(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'unique:users'],
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'nama_lengkap' => 'required',
            'nohp' => 'required',
            'noinduk' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required', 
            'tanggal_lahir' => 'required',
            'santri_id' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Nama belum diisi!',
            'email.required' => 'Email belum diisi!',
            'email.unique' => 'Email telah digunakan!',
            'username.required' => 'Nama pengguna belum diisi!',
            'username.unique' => 'Nama pengguna telah digunakan!',
            'password.required' => 'Kata sandi belum diisi!',
            'password.confirmed' => 'Kata sandi tidak cocok!',
            'tempat_lahir.required' => 'Field tempat lahir belum diisi!',
            'tanggal_lahir.required' => 'Field tanggal lahir belum diisi!',
            'nama_lengkap' => 'Field nama lengkap belum diisi!',
            'nohp' => 'Field nomor telp belum diisi!',
            'noinduk'=> 'Field nomor induk belum diisi!',
            'alamat' => 'Field alamat belum diisi!',
            'santri_id' => 'Santri belum dipilih!',
            
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now()
        ]);
        // Find or create the "administrator" role
        $role = Role::firstOrCreate(['name' => 'orangtua']);

        // Assign the role to the user
        $user->assignRole($role);

        $userDetail = UserDetail::create([
            'user_id' => $user->id, // Assign the user_id to the user's ID
            'noinduk' => $request->noinduk,
            'nama_lengkap' => $request->nama_lengkap,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'santri_id' => $request->santri_id,
        ]);

        $user->id_detail = $userDetail->id;
        $user->save();
        

        return redirect('/users')->with('message', 'Data Orang Tua telah ditambahkan'); 
    }

    public function editortu($id)
    {
        $data['pageTitle'] = 'Ubah Data Guru';
        $data['user'] = User::where('id', $id)->first();
        $data['santri'] = Santri::all();

        return view('users.editortu', $data);
    }

    public function updateortu(Request $request, $id)
    {
        // Validate the request data, similar to the store method
        $rules = [
            'name' => 'required',
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($id)],
            'username' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($id)],
            'password' => ['nullable', 'string', 'confirmed'],
            'nama_lengkap' => 'required',
            'nohp' => 'required',
            'noinduk' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required', 
            'tanggal_lahir' => 'required',
            'santri_id' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Nama belum diisi!',
            'email.required' => 'Email belum diisi!',
            'email.unique' => 'Email telah digunakan!',
            'username.required' => 'Nama pengguna belum diisi!',
            'username.unique' => 'Nama pengguna telah digunakan!',
            'password.required' => 'Kata sandi belum diisi!',
            'password.confirmed' => 'Kata sandi tidak cocok!',
            'tempat_lahir.required' => 'Field tempat lahir belum diisi!',
            'tanggal_lahir.required' => 'Field tanggal lahir belum diisi!',
            'nama_lengkap' => 'Field nama lengkap belum diisi!',
            'nohp' => 'Field nomor telp belum diisi!',
            'noinduk'=> 'Field nomor induk belum diisi!',
            'alamat' => 'Field alamat belum diisi!',
            'santri_id' => 'Santri belum dipilih!',
            
        ];

        $this->validate($request, $rules, $customMessages);

        // Find the user by their ID
        $user = User::findOrFail($id);

        // Update the user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'email_verified_at' => Carbon::now(),
        ]);

        // Update the password if it's provided
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Update the associated user detail
            $user->userDetail->update([
                'noinduk' => $request->noinduk,
                'nama_lengkap' => $request->nama_lengkap,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'santri_id' => $request->santri_id,
            ]);

        return redirect('/users')->with('message', 'Data Orang Tua telah diperbarui');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'unique:users'],
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            
        ];

        $customMessages = [
            'name.required' => 'Nama belum diisi!',
            'email.required' => 'Email belum diisi!',
            'email.unique' => 'Email telah digunakan!',
            'username.required' => 'Nama pengguna belum diisi!',
            'username.unique' => 'Nama pengguna telah digunakan!',
            'password.required' => 'Kata sandi belum diisi!',
            'password.confirmed' => 'Kata sandi tidak cocok!',
            
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now()
        ]);
        // Find or create the "administrator" role
        $role = Role::firstOrCreate(['name' => 'administrator']);

        // Assign the role to the user
        $user->assignRole($role);

        return redirect('/users')->with('message', 'Data Admin telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['pageTitle'] = 'Ubah Data User';
        $data['user'] = $user;
        $data['roles'] = Role::all();
        $data['userRole'] = User::find($user->id)->roles->pluck('name','name')->all();

        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'unique:users,email,' .$user->id],
            'username' => ['required', 'string', 'max:20', 'unique:users,username,' .$user->id],
            'password' => 'confirmed',
            'role' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Nama belum diisi!',
            'email.required' => 'Email belum diisi!',
            'email.unique' => 'Email telah digunakan!',
            'username.required' => 'Nama pengguna belum diisi!',
            'username.unique' => 'Nama pengguna telah digunakan!',
            'password.confirmed' => 'Kata sandi tidak cocok!',
            'role.required' => 'Role belum diisi!',
        ];

        $this->validate($request, $rules, $customMessages);

        if ($request->password == null) {
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();

            $user = User::find($user->id);
            $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                ]);
            $user->assignRole($request->role);

            return redirect('/users')->with('message', 'Data telah diubah');
        } else {
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();

            $user = User::find($user->id);
            $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => Hash::make($request->password)
                ]);
            $user->assignRole($request->role);

            return redirect('/users')->with('message', 'Data telah diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect('/users')->with('message', 'Data telah dihapus');
    }
}
