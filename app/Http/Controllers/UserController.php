<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('user.dashboard', [
            'title' => 'Dashboard - User | NexGenbot Hospital',
            'user' => Auth::user(),
            'data' => $data,
        ]);
    }

    public function profile()
    {
        $data = Auth::user();
        $emailFerify = Auth::user()->email_verified_at;
        $formattedDate = Carbon::parse($emailFerify)->translatedFormat('d F Y');
        return view('allrole.userprofile', [
            'data' => $data,
            'title' => 'Profile - Page | NexGenbot Hospital',
            'tanggalJoin' => $formattedDate,
        ]);
    }

    public function userAccount()
    {
        $data = Auth::user();
        $emailFerify = Auth::user()->email_verified_at;
        $formattedDate = Carbon::parse($emailFerify)->translatedFormat('d F Y');
        return view('allrole.account-setting', [
            'data' => $data,
            'title' => 'Account Setting - Page | NexGenbot Hospital',
            'tanggalJoin' => $formattedDate,
        ]);
    }


    public function updateAccount(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,13',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::find($userId);
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');

        if ($request->hasFile('image')) {
            if ($user->image && $user->image !== 'default-avatar.png') {
                $oldImagePath = public_path('storage/user-image/' . $user->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/user-image'), $imageName);

            $user->image = $imageName;
        }

        $user->save();

        return redirect()->route('users.profile')->with('success', 'Profile updated successfully.');
    }

    public function resetImage(Request $request)
    {
        $user = User::find(Auth::id());
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        if ($user->image && $user->image !== 'default-avatar.png') {
            $oldImagePath = public_path('storage/user-image/' . $user->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $user->image = 'default-avatar.png';
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil direset ke default.');
    }


    public function changePassword()
    {
        $data = Auth::user();
        $emailFerify = Auth::user()->email_verified_at;
        $formattedDate = Carbon::parse($emailFerify)->translatedFormat('d F Y');
        return view('allrole.change-password', [
            'data' => $data,
            'title' => 'Change Password - Page | NexGenbot Hospital',
            'tanggalJoin' => $formattedDate,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::id());
        if ($request->filled('currentPassword') && $request->filled('newPassword')) {
            $request->validate([
                'currentPassword' => 'required',
                'newPassword' => 'required|string|min:8|same:confirmPassword',
                'confirmPassword' => 'required|string|min:8',
            ]);

            // Cek apakah current password sesuai
            if (!Hash::check($request->input('currentPassword'), $user->password)) {
                return back()->withErrors(['currentPassword' => 'Current password is incorrect']);
            }

            // Update password
            $user->password = bcrypt($request->input('newPassword'));
        }
        $user->save();

        return redirect()->route('users.profile')->with('success', 'Password updated successfully.');
    }
}
