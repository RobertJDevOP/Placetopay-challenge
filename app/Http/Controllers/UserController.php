<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\ViewModels\Users\IndexViewModel;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(IndexViewModel $viewModel): View
    {
        $role='cliente';

        $users=User::select('id','name','email','created_at','enabled_at')
                    ->whereHas( 'roles', function ( $query ) use ($role) {
                    $query->where( 'name', $role );
            }) ->paginate(10);

        $viewModel->collection($users);

        return view('users.index', $viewModel->toArray());
    }
}
