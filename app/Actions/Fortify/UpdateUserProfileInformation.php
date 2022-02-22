<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'u_fullname' => ['required', 'string', 'max:255'],
            'u_email' => ['required', 'email', 'max:255'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'u_dob'=>['required'],
            'u_address'=>['required'],
            'u_phoneline'=>['required'],
            'u_address'=>['required'],
            'u_gender'=>['required'],
            'u_country'=>['required'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['u_email'] !== $user->u_email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'u_fullname' => $input['u_fullname'],
                'u_email' => $input['u_email'],
                'u_dob'=>$input['u_dob'],
                'u_address'=>$input['u_address'],
                'u_phoneline'=>$input['u_phoneline'],
                'u_address'=>$input['u_address'],
                'u_gender'=>$input['u_gender'],
                'u_country'=>$input['u_country'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'u_fullname' => $input['u_fullname'],
            'u_email' => $input['u_email'],
            'email_verified_at' => null,
            'u_dob'=>$input['u_dob'],
            'u_address'=>$input['u_address'],
            'u_phoneline'=>$input['u_phoneline'],
            'u_address'=>$input['u_address'],
            'u_gender'=>$input['u_gender'],
            'u_country'=>$input['u_country'],
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
