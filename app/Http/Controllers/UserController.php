<?php

namespace App\Http\Controllers;

use App\Actions\User\UpdateProfileAction;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;
    public function index(): UserResource
    {
        $user = request()->user();
        return new UserResource($user);
    }

    public function updateProfile(UpdateProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        $status = UpdateProfileAction::run([
            'user' => $request->user(),
            'email' => $request->input('email'),
            'name' => $request->input('name')
        ]);

        if($status){
            return $this->respondSuccess("Profile updated");
        }
        return $this->respondInternalError("Unexpected error. Please try again");
    }
}
