<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\ {User, File, Folder, FileType, FolderCategory} ;
use App\Policies\{UserPolicy, FilePolicy, FolderPolicy, FileTypePolicy, FolderCategoryPolicy};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        File::class => FilePolicy::class,
        Folder::class => FolderPolicy::class,
        FileType::class => FileTypePolicy::class,
        FolderCategory::class => FolderCategory::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
