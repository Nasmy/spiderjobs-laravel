<?php

namespace App\Providers;

use App\Interfaces\ConfigurationRepositoryInterface;
use App\Interfaces\CountryRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;
use App\Interfaces\EmploymentTypeRepositoryInterface;
use App\Interfaces\ExperienceRepositoryInterface;
use App\Interfaces\JobApplicationRepositoryInterface;
use App\Interfaces\JobCategoryRepositoryInterface;
use App\Interfaces\JobRepositoryInterface;
use App\Interfaces\PermissionRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\ConfigurationRepository;
use App\Repositories\CountryRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\EmploymentTypeRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\JobApplicationRepository;
use App\Repositories\JobCategoryRepository;
use App\Repositories\JobRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(JobCategoryRepositoryInterface::class,JobCategoryRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(ExperienceRepositoryInterface::class, ExperienceRepository::class);
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
        $this->app->bind(EmploymentTypeRepositoryInterface::class, EmploymentTypeRepository::class);
        $this->app->bind(JobApplicationRepositoryInterface::class, JobApplicationRepository::class);
        $this->app->bind(ConfigurationRepositoryInterface::class, ConfigurationRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
