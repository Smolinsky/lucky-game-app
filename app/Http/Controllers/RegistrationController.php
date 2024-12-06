<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\LinkService;
use App\Services\UserService;

class RegistrationController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly LinkService $linkService
    ){}

    public function showForm()
    {
        return view('welcome');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->register($request->validated());

        $uniqueLink = $this->linkService->generateLink($user);

        return redirect()->route('link.show', $uniqueLink->unique_link);
    }
}
