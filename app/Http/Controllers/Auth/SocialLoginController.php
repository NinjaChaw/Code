<?php

namespace App\Http\Controllers\Auth;

use App\Models\SocialProfile;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function сallback(Request $request, $provider)
    {
        // retrieve user profile using OAuth
        try {
            $providerUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            Log::error(sprintf('%s login error: %s', $provider, $e->getMessage()));
            return redirect()->route('login');
        }

        // check if user with given email exists locally. If not - create it
        $userEmail = $providerUser->getEmail() ?: $providerUser->getId() . '_' . $providerUser->getNickname();
        $user = User::firstOrCreate(
            ['email' => $userEmail],
            [
                'name'              => $providerUser->getName(),
                'role'              => User::ROLE_USER,
                'status'            => User::STATUS_ACTIVE,
                'last_login_time'   => Carbon::now(),
                'last_login_ip'     => $request->ip(),
                'password'          => bcrypt($providerUser->token),
            ]
        );

        // retrieve avatar if it's provided and user doesn't have one
        if (!$user->avatar && ($avatarUrl = $providerUser->getAvatar())) {
            $client = new Client();
            $response = $client->get($avatarUrl);
            if ($response->getStatusCode() == 200) {
                $avatarFileName = $user->id . '_' . time() . '.jpg';
                // convert retrieved image to binary format
                $avatarContents = (string) Image::make($response->getBody()->getContents())->encode();
                // save the avatar locally
                if (Storage::put('avatars/' . $avatarFileName, $avatarContents)) {
                    // bind the uploaded avatar to user
                    $user->avatar = $avatarFileName;
                    $user->save();
                } else {
                    Log::error(sprintf('Can not save avatar to %s', $avatarFileName));
                }
            } else {
                Log::error(sprintf('Can not retrieve remote avatar %s', $avatarUrl));
            }
        }

        // check if social profile exists and create a new one if not. User can have multiple social profiles linked (Facebook, Google etc)
        $socialProfile = SocialProfile::firstOrCreate(
            ['provider_name' => $provider, 'provider_user_id' => $providerUser->getId()],
            ['user_id' => $user->id]
        );

        // authenticate user
        auth()->login($user, true);
        return redirect()->route('frontend.dashboard');
    }
}
