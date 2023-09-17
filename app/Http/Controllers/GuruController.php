<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class GuruController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Data Guru';
        $data['roles'] = Role::all();

        return view('users.createguru', $data);
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
            'nama_lengkap' => 'required',
            'nohp' => 'required',
            'noinduk' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required', 
            'tanggal_lahir' => 'required',
            
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
        $role = Role::firstOrCreate(['name' => 'guru']);

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
        ]);

        $user->id_detail = $userDetail->id;
        $user->save();
        

        return redirect('/users')->with('message', 'Data Guru telah ditambahkan');
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
        $data['pageTitle'] = 'Ubah Data Guru';
        $data['user'] = User::where('id', $id)->first();
        
        return view('users.editguru', $data);
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
            ]);

        return redirect('/users')->with('message', 'Data Guru telah diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
