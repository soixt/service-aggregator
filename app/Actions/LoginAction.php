<?php

namespace App\Actions;

use App\Models\Core\User;

class LoginAction {
    public function handle (User $user, $revokeTokens = false) {
        // Revoke all tokens if they exist or not if multidevice

        if ($revokeTokens) {
            $user->token()->revoke();
        }

        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;

        $token->expires_at = now()->addYear();

        $token->save();

        return "Bearer " . $tokenResult->accessToken;
    }
}