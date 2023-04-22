<?php

namespace Database\Seeders;

use App\Models\Core\ActiveService;
use App\Models\Core\Client;
use App\Models\Core\Project;
use App\Models\Core\ProjectActiveService;
use App\Models\Core\Provider;
use App\Models\Core\ProviderProjectActiveService;
use App\Models\Core\Service;
use App\Models\Core\User;
use App\Utilities\Payments\Flutterwave\FlutterwaveConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['email' => 'sasa@sasa.sa', 'username' => 'sasa', 'first_name' => 'sasa', 'last_name' => 'orasanin', 'password' => bcrypt('sasasasa')]);
        $client = Client::create(['name' => 'TitansFit', 'location' => 'Belgrade, Serbia', 'status' => 'active']);
        $client->users()->attach($user);
        $service = Service::create(['name' => 'Payment', 'description' => 'A payment service!', 'slug' => 'payment']);
        $provider = Provider::create([
            'name' => 'Flutterwave', 
            'service_id' => $service->id,
            'metadata' => FlutterwaveConfig::default(),
            'slug' => 'flutterwave'
        ]);
        $activeService = ActiveService::create(['client_id' => $client->id, 'service_id' => $service->id, 'status' => 'OK']);
        $project = Project::create(['name' => 'Sasa', 'client_id' => $client->id]);
        $projectWithActiveServices = ProjectActiveService::create(['active_service_id' => $activeService->id, 'project_id' => $project->id, 'status' => 'OK']);
        $providersPerActiveService = ProviderProjectActiveService::create([
            'project_active_service_id' => $projectWithActiveServices->id,
            'provider_id' => $provider->id,
            'config' => [
                'public_key' => 'FLWPUBK_TEST-1971f1ac45530b73ddd5d20f5c188ed3-X',
                'secret_key' => 'FLWSECK_TEST-a6d6b6522c6a60b2d7930e48407f6a4b-X',
                ...FlutterwaveConfig::default()
            ]
        ]);
    }
} 