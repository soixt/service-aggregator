<?php

namespace App\Actions;

use App\Models\Core\Project;

class GenerateKeysAction {
    public function handle (Project $project) {
        $project->update([
            'public_key' => 'new',
            'private_key' => 'new',
        ]);

        return $project;
    }
}