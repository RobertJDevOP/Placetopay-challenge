<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\ViewModels\Users\IndexViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(IndexViewModel $viewModel): View
    {
        $role='cliente';

        $users=User::select('name','email','created_at','enabled_at')
                    ->whereHas( 'roles', function ( $query ) use ($role) {
                    $query->where( 'name', $role );
            })->paginate(10);

        $viewModel->collection($users);

        return view('users.index', $viewModel->toArray());
    }

    public function statusUser(string $userEmail,Request $request): RedirectResponse
    {
        $statusUser = $request->input('validation');

        $user = User::where('email', $userEmail)->firstOrFail();

        ($statusUser==='enabled') ?
            $user->markAsEnabled()
            :
            $user->markAsDisabled();

        $msjStatus='Client '.$userEmail.' are '.$statusUser;

        return redirect('/users')->with('success',$msjStatus);
    }

    public function edit(string $email): View
    {
        $user = User::where('email', '=', $email)->firstOrFail();

        return view('users.edit')->with('user',$user);
    }

    public function update(Request $request, string $email): RedirectResponse
    {
        $user = User::where('email', '=', $email)->firstOrFail();

        $user->name = $request->get('name');
        $user->save();

        $msjStatus='Client are modified';

        return redirect('/users')->with('success',$msjStatus);
    }
}
