<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataUserController extends Controller
{
    // Show the users list
    public function index()
    {
        // Fetch users with their related kelas and role
        $users = User::with(['kelas', 'role'])->get();
        $kelas = Kelas::all();  // Fetch all classes for the dropdown
        $roles = Role::all();   // Fetch all roles for the dropdown

        return view('admin.datauser.index', compact('users', 'kelas', 'roles'));
    }

    // Update a specific user
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'nisn' => 'nullable|numeric|unique:users,nisn,' . $id,
            'nis' => 'nullable|numeric|unique:users,nis,' . $id,
            'nip' => 'nullable|numeric|unique:users,nip,' . $id,
            'kelas_id' => 'nullable|exists:kelas,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Find the user by id
        $user = User::findOrFail($id);

        // Update user details
        $user->name = $request->name;
        $user->username = $request->username;
        $user->nisn = $request->nisn;
        $user->nis = $request->nis;
        $user->nip = $request->nip;
        $user->kelas_id = $request->kelas_id;
        $user->role_id = $request->role_id;

        // Check if password is being updated
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $user->password = Hash::make($request->password);
        }

        $user->save(); // Save the updated user

        return redirect()->route('datauser.index')->with('success', 'User updated successfully.');
    }

    // Delete a specific user
    public function destroy($id)
    {
        // Find the user by id and delete
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('datauser.index')->with('success', 'User deleted successfully.');
    }

    public function store(Request $request)
    {
        // Determine the user type
        $userType = $request->input('user_type');

        // Validation based on user type
        if ($userType === 'siswa') {
            $request->validate([
                'name' => 'required|string|max:255',
                'nisn' => 'required|numeric|unique:users',
                'nis' => 'required|numeric|unique:users',
                'kelas_id' => 'required|exists:kelas,id',
                'role_id' => 'required|exists:roles,id',
            ]);
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'nip' => 'required|numeric|unique:users',
                'role_id' => 'required|exists:roles,id',
            ]);
        }

        // Create a new user instance
        $user = new User();
        $user->name = $request->name;
        $user->role_id = $request->role_id;

        // Handle Siswa data
        if ($userType === 'siswa') {
            $user->username = $request->nisn;  // Set username as NISN
            $user->password = Hash::make($request->nis);  // Set password as hashed NIS
            $user->nisn = $request->nisn;
            $user->nis = $request->nis;
            $user->kelas_id = $request->kelas_id;
        }
        // Handle Guru/Pegawai data
        else {
            $user->username = $request->nip;  // Set username as NIP
            $user->password = Hash::make($request->nip);  // Set password as hashed NIP
            $user->nip = $request->nip;
        }

        // Save the user to the database
        $user->save();

        // Redirect back to the user list with a success message
        return redirect()->route('datauser.index')->with('success', 'User created successfully.');
    }
}
