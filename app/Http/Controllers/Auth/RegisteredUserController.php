<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserValidate;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
 use Carbon\Carbon;
class RegisteredUserController extends Controller
{
    protected $UserRepository;

    public function __construct(private UserRepository $userRepository){
        $this->UserRepository = $userRepository;
    }

    public function create(): View
    {
        return view('auth.register');
    }


    public function store(RegisterUserValidate $request): RedirectResponse
    {
        $data = $request->validated();
        $user =$this->UserRepository->createUser($data);

        if ($user) {
            $message = $user->professional_type == 'solicitor' || $user->professional_type == 'professional'
                ? 'Registered successfully as a professional.'
                : 'Registered successfully as a customer.';


            event(new Registered($user));
            Auth::login($user);

            return redirect()->route('dashboard')->with(['message' => $message]);
        }
        return redirect()->route('register')->with(['error' => 'Registration failed. Please try again.']);
        // return redirect(route('dashboard', absolute: false));
    }
}

























