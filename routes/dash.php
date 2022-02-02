<?php


use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExploitController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TechnologyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    //    Post CRUD Routing

    Route::get('dash/view-post', [PostController::class, 'index'])
        ->name('post.index');

    Route::get('dash/add-post', [PostController::class, 'create'])
        ->name('post.create');

    Route::post('dash/add-post', [PostController::class, 'store'])
        ->name('post.store');

    Route::get('dash/post-edit/{post}', [PostController::class, 'edit'])
        ->name('post.edit');

    Route::post('dash/post-edit/{post}', [PostController::class, 'update'])
        ->name('post.update');

    Route::post('dash/post-delete', [PostController::class, 'destroy'])
        ->name('post.destroy');

//    Partner CRUD Routing

    Route::get('dash/view-partner', [PartnerController::class, 'index'])
        ->name('partner.index');

    Route::get('dash/add-partner', [PartnerController::class, 'create'])
        ->name('partner.create');

    Route::post('dash/add-partner', [PartnerController::class, 'store'])
        ->name('partner.store');

    Route::get('dash/partner-edit/{partner}', [PartnerController::class, 'edit'])
        ->name('partner.edit');

    Route::post('dash/partner-edit/{partner}', [PartnerController::class, 'update'])
        ->name('partner.update');

    Route::post('dash/partner-delete', [PartnerController::class, 'destroy'])
        ->name('partner.destroy');

    //    Gallery CRUD Routing

    Route::get('dash/view-gallery', [GalleryController::class, 'index'])
        ->name('gallery.index');

    Route::get('dash/add-gallery', [GalleryController::class, 'create'])
        ->name('gallery.create');

    Route::post('dash/add-gallery', [GalleryController::class, 'store'])
        ->name('gallery.store');

    Route::get('dash/gallery-edit/{gallery}', [GalleryController::class, 'edit'])
        ->name('gallery.edit');

    Route::post('dash/gallery-edit/{gallery}', [GalleryController::class, 'update'])
        ->name('gallery.update');

    Route::post('dash/gallery-delete', [GalleryController::class, 'destroy'])
        ->name('gallery.destroy');

    //    About CRUD Routing

    Route::get('dash/view-about', [AboutController::class, 'index'])
        ->name('about.index');

    Route::get('dash/add-about', [AboutController::class, 'create'])
        ->name('about.create');

    Route::post('dash/add-about', [AboutController::class, 'store'])
        ->name('about.store');

    Route::get('dash/about-edit/{about}', [AboutController::class, 'edit'])
        ->name('about.edit');

    Route::post('dash/about-edit/{about}', [AboutController::class, 'update'])
        ->name('about.update');

    Route::post('dash/about-delete', [AboutController::class, 'destroy'])
        ->name('about.destroy');

        //    Service CRUD Routing

    Route::get('dash/view-service', [ServiceController::class, 'index'])
    ->name('service.index');

    Route::get('dash/add-service', [ServiceController::class, 'create'])
        ->name('service.create');

    Route::post('dash/add-service', [ServiceController::class, 'store'])
        ->name('service.store');

    Route::get('dash/service-edit/{service}', [ServiceController::class, 'edit'])
        ->name('service.edit');

    Route::post('dash/service-edit/{service}', [ServiceController::class, 'update'])
        ->name('service.update');

    Route::post('dash/service-delete', [ServiceController::class, 'destroy'])
        ->name('service.destroy');


     //    Customer CRUD Routing

     Route::get('dash/view-customer', [CustomerController::class, 'index'])
     ->name('customer.index');
 
     Route::get('dash/add-customer', [CustomerController::class, 'create'])
         ->name('customer.create');
 
     Route::post('dash/add-customer', [CustomerController::class, 'store'])
         ->name('customer.store');
 
     Route::get('dash/customer-edit/{customer}', [CustomerController::class, 'edit'])
         ->name('customer.edit');
 
     Route::post('dash/customer-edit/{customer}', [CustomerController::class, 'update'])
         ->name('customer.update');
 
     Route::post('dash/customer-delete', [CustomerController::class, 'destroy'])
         ->name('customer.destroy');
 

     //    Exploit CRUD Routing

     Route::get('dash/view-exploit', [ExploitController::class, 'index'])
     ->name('exploit.index');
 
     Route::get('dash/add-exploit', [ExploitController::class, 'create'])
         ->name('exploit.create');
 
     Route::post('dash/add-exploit', [ExploitController::class, 'store'])
         ->name('exploit.store');
 
     Route::get('dash/exploit-edit/{exploit}', [ExploitController::class, 'edit'])
         ->name('exploit.edit');
 
     Route::post('dash/exploit-edit/{exploit}', [ExploitController::class, 'update'])
         ->name('exploit.update');
 
     Route::post('dash/exploit-delete', [ExploitController::class, 'destroy'])
         ->name('exploit.destroy');
 

     //    Project CRUD Routing

     Route::get('dash/view-project', [ProjectController::class, 'index'])
     ->name('project.index');
 
     Route::get('dash/add-project', [ProjectController::class, 'create'])
         ->name('project.create');
 
     Route::post('dash/add-project', [ProjectController::class, 'store'])
         ->name('project.store');
 
     Route::get('dash/project-edit/{project}', [ProjectController::class, 'edit'])
         ->name('project.edit');
 
     Route::post('dash/project-edit/{project}', [ProjectController::class, 'update'])
         ->name('project.update');
 
     Route::post('dash/project-delete', [ProjectController::class, 'destroy'])
         ->name('project.destroy');
 

     //    Team CRUD Routing

     Route::get('dash/view-team', [TeamController::class, 'index'])
     ->name('team.index');
 
     Route::get('dash/add-team', [TeamController::class, 'create'])
         ->name('team.create');
 
     Route::post('dash/add-team', [TeamController::class, 'store'])
         ->name('team.store');
 
     Route::get('dash/team-edit/{team}', [TeamController::class, 'edit'])
         ->name('team.edit');
 
     Route::post('dash/team-edit/{team}', [TeamController::class, 'update'])
         ->name('team.update');
 
     Route::post('dash/team-delete', [TeamController::class, 'destroy'])
         ->name('team.destroy');


     //    Technology CRUD Routing

     Route::get('dash/view-technology', [TechnologyController::class, 'index'])
     ->name('technology.index');
 
     Route::get('dash/add-technology', [TechnologyController::class, 'create'])
         ->name('technology.create');
 
     Route::post('dash/add-technology', [TechnologyController::class, 'store'])
         ->name('technology.store');
 
     Route::get('dash/technology-edit/{technology}', [TechnologyController::class, 'edit'])
         ->name('technology.edit');
 
     Route::post('dash/technology-edit/{technology}', [TechnologyController::class, 'update'])
         ->name('technology.update');
 
     Route::post('dash/technology-delete', [TechnologyController::class, 'destroy'])
         ->name('technology.destroy');

    
    //    Blog CRUD Routing

    Route::get('dash/view-blog', [BlogController::class, 'index'])
    ->name('blog.index');

    Route::get('dash/add-blog', [BlogController::class, 'create'])
        ->name('blog.create');

    Route::post('dash/add-blog', [BlogController::class, 'store'])
        ->name('blog.store');

    Route::get('dash/blog-edit/{blog}', [BlogController::class, 'edit'])
        ->name('blog.edit');

    Route::post('dash/blog-edit/{blog}', [BlogController::class, 'update'])
        ->name('blog.update');

    Route::post('dash/blog-delete', [BlogController::class, 'destroy'])
        ->name('blog.destroy');


    //    Category CRUD Routing

    Route::get('dash/view-category', [CategoryController::class, 'index'])
    ->name('category.index');

    Route::get('dash/add-category', [CategoryController::class, 'create'])
        ->name('category.create');

    Route::post('dash/add-category', [CategoryController::class, 'store'])
        ->name('category.store');

    Route::get('dash/category-edit/{category}', [CategoryController::class, 'edit'])
        ->name('category.edit');

    Route::post('dash/category-edit/{category}', [CategoryController::class, 'update'])
        ->name('category.update');

    Route::post('dash/category-delete', [CategoryController::class, 'destroy'])
        ->name('category.destroy');
 
 
});
