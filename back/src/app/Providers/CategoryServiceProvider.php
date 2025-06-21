<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Category\Service\CategoryInitializationService;
use App\Domain\Category\Repository\CategoryRepositoryInterface;
use App\Domain\Category\Repository\DefaultCategoryRepositoryInterface;
use App\Infrastructure\Category\Repository\CategoryRepository;
use App\Infrastructure\Category\Repository\DefaultCategoryRepository;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            DefaultCategoryRepositoryInterface::class,
            DefaultCategoryRepository::class
        );

        $this->app->bind(CategoryInitializationService::class, function ($app) {
            return new CategoryInitializationService(
                $app->make(CategoryRepositoryInterface::class),
                $app->make(DefaultCategoryRepositoryInterface::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
