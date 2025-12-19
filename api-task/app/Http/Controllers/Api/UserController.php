<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(StoreUserRequest $request, UserService $service)
    {
        return $service->create($request->validated());
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(UpdateUserRequest $request,User $user, UserService $service)
    {
        return $service->update($user, $request->validated());

    }

    public function destroy(User $user, UserService $service)
    {
        $service->delete($user);
        return response()->json(['message' => 'User deleted successfully']);
    }

}
