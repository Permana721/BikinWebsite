<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => "Gagal login dengan {$provider}. Silakan coba lagi."]);
        }

        $email = $socialUser->getEmail();
        $providerId = $socialUser->getId();
        $nickname = $socialUser->getNickname() ?? $socialUser->getName() ?? 'User';
        $name = $socialUser->getName() ?? $nickname;

        // Generate fallback email if provider doesn't return one
        if (!$email) {
            // Remove numbers from the nickname
            $cleanName = preg_replace('/[0-9]+/', '', $nickname);
            // Also remove any spaces or non-alphabetical characters to form a clean email prefix
            $cleanName = preg_replace('/[^a-zA-Z]/', '', $cleanName);
            
            // Fallback just in case it becomes empty
            if (empty($cleanName)) {
                $cleanName = 'user';
            }

            $email = strtolower($cleanName) . '@gmail.com';
        }

        // Find user by provider_id first
        $user = User::where('provider_name', $provider)
                    ->where('provider_id', $providerId)
                    ->first();

        // If not found, try to find by email if email exists
        if (!$user && $email) {
            $user = User::where('email', $email)->first();
            
            if ($user) {
                // Update provider details if not set
                if (! $user->provider_name) {
                    $user->update([
                        'provider_name' => $provider,
                        'provider_id' => $providerId,
                    ]);
                }
            }
        }

        // If still no user found, create one
        if (!$user) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'provider_name' => $provider,
                'provider_id' => $providerId,
                'role' => 'user',
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('user.dashboard');
    }
}
