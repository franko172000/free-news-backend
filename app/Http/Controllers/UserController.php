<?php

namespace App\Http\Controllers;

use App\Actions\User\UpdatePreferenceAction;
use App\Actions\User\UpdateProfileAction;
use App\Http\Requests\UpdatePreferenceRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function index(): UserResource
    {
        $user = request()->user();
        return new UserResource($user);
    }

    /**
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $status = UpdateProfileAction::run([
            'user' => $request->user(),
            'email' => $request->input('email'),
            'name' => $request->input('name')
        ]);

        if($status){
            return $this->respondSuccess(message: "Profile updated");
        }
        return $this->respondInternalError("Unexpected error. Please try again");
    }

    /**
     * @param UpdatePreferenceRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function updatePreference(UpdatePreferenceRequest $request): JsonResponse
    {
        $status = UpdatePreferenceAction::run([
            'user' => $request->user(),
            'sources' => $request->input('sources'),
            'categories' => $request->input('categories')
        ]);

        if($status){
            return $this->respondSuccess(message: "Profile updated");
        }
        return $this->respondInternalError("Unexpected error. Please try again");
    }
}
