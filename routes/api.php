<?php

declare(strict_types=1);

use App\Http\Controllers\Phone\PhoneUserController;
use App\Http\Controllers\Post\PostUserController;
use App\Http\Controllers\Role\RoleUserController;
use App\Http\Controllers\User\UserPhoneController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\User\UserRoleController;
use App\Http\Controllers\Car\CarOwnerController;
use App\Http\Controllers\Country\CountryPostController;
use App\Http\Controllers\Mechanic\MechanicOwnerController;
use App\Http\Controllers\Owner\OwnerMechanicController;
use App\Http\Controllers\Post\PostCountryController;
use App\Http\Controllers\Image\ImageableController;
use App\Http\Controllers\Image\ImageController;
use App\Http\Controllers\Comment\CommentableController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Tag\TaggableController;
use App\Http\Controllers\Tag\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| One To One: User hasOne Phone
|--------------------------------------------------------------------------
*/
Route::prefix('one-to-one')->name('one-to-one.')->group(function (): void {
    // hasOne side
    Route::get('users', [UserPhoneController::class, 'index'])->name('users.index');
    Route::get('users/search', [UserPhoneController::class, 'search'])->name('users.search');
    Route::get('users/{user}/phone', [UserPhoneController::class, 'show'])->name('users.phone.show');
    Route::get('users/{user}/phone/exists', [UserPhoneController::class, 'exists'])->name('users.phone.exists');
    Route::post('users/{user}/phone/create', [UserPhoneController::class, 'create'])->name('users.phone.create');
    Route::post('users/{user}/phone/save', [UserPhoneController::class, 'save'])->name('users.phone.save');
    Route::post('users/{user}/phone/first-or-create', [UserPhoneController::class, 'firstOrCreate'])->name('users.phone.first-or-create');
    Route::put('users/{user}/phone', [UserPhoneController::class, 'updateOrCreate'])->name('users.phone.update-or-create');
    Route::patch('users/{user}/phone', [UserPhoneController::class, 'update'])->name('users.phone.update');
    Route::delete('users/{user}/phone', [UserPhoneController::class, 'destroy'])->name('users.phone.destroy');

    // belongsTo side
    Route::get('phones', [PhoneUserController::class, 'index'])->name('phones.index');
    Route::get('phones/by-user/{user}', [PhoneUserController::class, 'byUser'])->name('phones.by-user');
    Route::get('phones/{phone}/user', [PhoneUserController::class, 'show'])->name('phones.user.show');
    Route::get('phones/{phone}/owner/{user}', [PhoneUserController::class, 'isOwner'])->name('phones.user.is-owner');
    Route::put('phones/{phone}/user', [PhoneUserController::class, 'associate'])->name('phones.user.associate');
    Route::patch('phones/{phone}/user', [PhoneUserController::class, 'updateUser'])->name('phones.user.update');
    Route::delete('phones/{phone}/user', [PhoneUserController::class, 'destroyUser'])->name('phones.user.destroy');
    Route::delete('phones/{phone}', [PhoneUserController::class, 'destroy'])->name('phones.destroy');
});

/*
|--------------------------------------------------------------------------
| One To Many: User hasMany Post
|--------------------------------------------------------------------------
*/
Route::prefix('one-to-many')->name('one-to-many.')->group(function (): void {
    // hasMany side
    Route::get('users', [UserPostController::class, 'index'])->name('users.index');
    Route::get('users/stats', [UserPostController::class, 'stats'])->name('users.stats');
    Route::get('users/search', [UserPostController::class, 'search'])->name('users.search');
    Route::get('users/{user}/posts', [UserPostController::class, 'list'])->name('users.posts.list');
    Route::get('users/{user}/posts/count', [UserPostController::class, 'count'])->name('users.posts.count');
    Route::get('users/{user}/posts/latest', [UserPostController::class, 'latest'])->name('users.posts.latest');
    Route::get('users/{user}/posts/filter', [UserPostController::class, 'filter'])->name('users.posts.filter');
    Route::get('users/{user}/posts/summary', [UserPostController::class, 'summary'])->name('users.posts.summary');
    Route::get('users/{user}/posts/{post}', [UserPostController::class, 'find'])->whereNumber('post')->name('users.posts.find');
    Route::post('users/{user}/posts/create', [UserPostController::class, 'create'])->name('users.posts.create');
    Route::post('users/{user}/posts/create-many', [UserPostController::class, 'createMany'])->name('users.posts.create-many');
    Route::post('users/{user}/posts/save', [UserPostController::class, 'save'])->name('users.posts.save');
    Route::post('users/{user}/posts/save-many', [UserPostController::class, 'saveMany'])->name('users.posts.save-many');
    Route::post('users/{user}/posts/first-or-create', [UserPostController::class, 'firstOrCreate'])->name('users.posts.first-or-create');
    Route::put('users/{user}/posts/update-or-create', [UserPostController::class, 'updateOrCreate'])->name('users.posts.update-or-create');
    Route::post('users/{user}/posts/{post}/adopt', [UserPostController::class, 'adopt'])->name('users.posts.adopt');
    Route::patch('users/{user}/posts', [UserPostController::class, 'updateAll'])->name('users.posts.update-all');
    Route::patch('users/{user}/posts/{post}', [UserPostController::class, 'update'])->whereNumber('post')->name('users.posts.update');
    Route::delete('users/{user}/posts', [UserPostController::class, 'destroyAll'])->name('users.posts.destroy-all');
    Route::delete('users/{user}/posts/{post}', [UserPostController::class, 'destroy'])->whereNumber('post')->name('users.posts.destroy');

    // belongsTo side
    Route::get('posts', [PostUserController::class, 'index'])->name('posts.index');
    Route::get('posts/orphans', [PostUserController::class, 'orphans'])->name('posts.orphans');
    Route::get('posts/search', [PostUserController::class, 'search'])->name('posts.search');
    Route::get('posts/by-user/{user}', [PostUserController::class, 'byUser'])->name('posts.by-user');
    Route::get('posts/{post}/user', [PostUserController::class, 'show'])->name('posts.user.show');
    Route::get('posts/{post}/author/{user}', [PostUserController::class, 'isAuthor'])->name('posts.user.is-author');
    Route::put('posts/{post}/user', [PostUserController::class, 'associate'])->name('posts.user.associate');
    Route::delete('posts/{post}/user', [PostUserController::class, 'dissociate'])->name('posts.user.dissociate');
    Route::patch('posts/{post}/user', [PostUserController::class, 'updateUser'])->name('posts.user.update');
    Route::delete('posts/{post}/user/destroy', [PostUserController::class, 'destroyUser'])->name('posts.user.destroy');
    Route::delete('posts/{post}', [PostUserController::class, 'destroy'])->name('posts.destroy');
});

/*
|--------------------------------------------------------------------------
| Many To Many: User belongsToMany Role
|--------------------------------------------------------------------------
*/
Route::prefix('many-to-many')->name('many-to-many.')->group(function (): void {
    // user side
    Route::get('users', [UserRoleController::class, 'index'])->name('users.index');
    Route::get('users/{user}/roles', [UserRoleController::class, 'show'])->name('users.roles.show');
    Route::get('users/{user}/roles/by-pivot', [UserRoleController::class, 'byPivot'])->name('users.roles.by-pivot');
    Route::get('users/{user}/roles/has', [UserRoleController::class, 'hasRole'])->name('users.roles.has');
    Route::post('users/{user}/roles', [UserRoleController::class, 'attach'])->name('users.roles.attach');
    Route::put('users/{user}/roles/sync', [UserRoleController::class, 'sync'])->name('users.roles.sync');
    Route::put('users/{user}/roles/sync-without-detaching', [UserRoleController::class, 'syncWithoutDetaching'])->name('users.roles.sync-without-detaching');
    Route::post('users/{user}/roles/toggle', [UserRoleController::class, 'toggle'])->name('users.roles.toggle');
    Route::patch('users/{user}/roles/{role}/pivot', [UserRoleController::class, 'updatePivot'])->whereNumber('role')->name('users.roles.update-pivot');
    Route::delete('users/{user}/roles', [UserRoleController::class, 'detachAll'])->name('users.roles.detach-all');
    Route::delete('users/{user}/roles/{role}', [UserRoleController::class, 'detach'])->whereNumber('role')->name('users.roles.detach');

    // role side
    Route::get('roles', [RoleUserController::class, 'index'])->name('roles.index');
    Route::get('roles/{role}/users', [RoleUserController::class, 'show'])->name('roles.users.show');
    Route::post('roles/{role}/users', [RoleUserController::class, 'attach'])->name('roles.users.attach');
    Route::put('roles/{role}/users/sync', [RoleUserController::class, 'sync'])->name('roles.users.sync');
    Route::delete('roles/{role}/users', [RoleUserController::class, 'detachAll'])->name('roles.users.detach-all');
    Route::delete('roles/{role}/users/{user}', [RoleUserController::class, 'detach'])->whereNumber('user')->name('roles.users.detach');
});


/*
|--------------------------------------------------------------------------
| Has One Through: Mechanic hasOneThrough Owner (through Car)
|--------------------------------------------------------------------------
*/
Route::prefix('has-one-through')->name('has-one-through.')->group(function (): void {
    // mechanic side
    Route::get('mechanics', [MechanicOwnerController::class, 'index'])->name('mechanics.index');
    Route::get('mechanics/search', [MechanicOwnerController::class, 'search'])->name('mechanics.search');
    Route::get('mechanics/{mechanic}/owner', [MechanicOwnerController::class, 'show'])->name('mechanics.owner.show');
    Route::get('mechanics/{mechanic}/owner/fluent', [MechanicOwnerController::class, 'fluent'])->name('mechanics.owner.fluent');
    Route::get('mechanics/{mechanic}/owner/exists', [MechanicOwnerController::class, 'exists'])->name('mechanics.owner.exists');
    Route::patch('mechanics/{mechanic}/owner', [MechanicOwnerController::class, 'update'])->name('mechanics.owner.update');
    Route::delete('mechanics/{mechanic}/owner', [MechanicOwnerController::class, 'destroy'])->name('mechanics.owner.destroy');
    Route::get('mechanics/{mechanic}/car', [MechanicOwnerController::class, 'car'])->name('mechanics.car.show');
    Route::post('mechanics/{mechanic}/car', [MechanicOwnerController::class, 'createCar'])->name('mechanics.car.create');

    // intermediate side
    Route::post('cars/{car}/owner', [CarOwnerController::class, 'create'])->name('cars.owner.create');

    // owner side
    Route::get('owners', [OwnerMechanicController::class, 'index'])->name('owners.index');
    Route::get('owners/by-mechanic/{mechanic}', [OwnerMechanicController::class, 'byMechanic'])->name('owners.by-mechanic');
    Route::get('owners/{owner}/mechanic', [OwnerMechanicController::class, 'show'])->name('owners.mechanic.show');
});

/*
|--------------------------------------------------------------------------
| Has Many Through: Country hasManyThrough Post (through User)
|--------------------------------------------------------------------------
*/
Route::prefix('has-many-through')->name('has-many-through.')->group(function (): void {
    // country side
    Route::get('countries', [CountryPostController::class, 'index'])->name('countries.index');
    Route::get('countries/stats', [CountryPostController::class, 'stats'])->name('countries.stats');
    Route::get('countries/search', [CountryPostController::class, 'search'])->name('countries.search');
    Route::get('countries/{country}/posts', [CountryPostController::class, 'show'])->name('countries.posts.show');
    Route::get('countries/{country}/posts/count', [CountryPostController::class, 'count'])->name('countries.posts.count');
    Route::get('countries/{country}/posts/latest', [CountryPostController::class, 'latest'])->name('countries.posts.latest');
    Route::get('countries/{country}/posts/filter', [CountryPostController::class, 'filter'])->name('countries.posts.filter');
    Route::get('countries/{country}/posts/paginate', [CountryPostController::class, 'paginate'])->name('countries.posts.paginate');
    Route::get('countries/{country}/posts/{post}', [CountryPostController::class, 'post'])->whereNumber('post')->name('countries.posts.find');
    Route::get('countries/{country}/users', [CountryPostController::class, 'users'])->name('countries.users');
    Route::patch('countries/{country}/posts', [CountryPostController::class, 'update'])->name('countries.posts.update');
    Route::delete('countries/{country}/posts', [CountryPostController::class, 'destroy'])->name('countries.posts.destroy');

    // post side
    Route::get('posts', [PostCountryController::class, 'index'])->name('posts.index');
    Route::get('posts/by-country/{code}', [PostCountryController::class, 'byCountry'])->name('posts.by-country');
    Route::get('posts/{post}/country', [PostCountryController::class, 'show'])->name('posts.country.show');
});

/*
|--------------------------------------------------------------------------
| Polymorphic One To One: User and Post morphOne Image
|--------------------------------------------------------------------------
*/
Route::prefix('polymorphic-one-to-one')->name('polymorphic-one-to-one.')->group(function (): void {
    // morphTo side
    Route::get('images', [ImageController::class, 'index'])->name('images.index');
    Route::get('images/details', [ImageController::class, 'details'])->name('images.details');
    Route::get('images/search', [ImageController::class, 'search'])->name('images.search');
    Route::get('images/{image}/imageable', [ImageController::class, 'show'])->name('images.imageable.show');
    Route::put('images/{image}/imageable', [ImageController::class, 'reassign'])->name('images.imageable.reassign');
    Route::delete('images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');

    // morphOne side, {type} is a morph map alias: user or post
    Route::get('{type}', [ImageableController::class, 'index'])->whereIn('type', ['user', 'post'])->name('imageables.index');
    Route::get('{type}/{id}/image', [ImageableController::class, 'show'])->whereIn('type', ['user', 'post'])->whereNumber('id')->name('imageables.image.show');
    Route::get('{type}/{id}/image/exists', [ImageableController::class, 'exists'])->whereIn('type', ['user', 'post'])->whereNumber('id')->name('imageables.image.exists');
    Route::post('{type}/{id}/image', [ImageableController::class, 'create'])->whereIn('type', ['user', 'post'])->whereNumber('id')->name('imageables.image.create');
    Route::put('{type}/{id}/image', [ImageableController::class, 'updateOrCreate'])->whereIn('type', ['user', 'post'])->whereNumber('id')->name('imageables.image.update-or-create');
    Route::patch('{type}/{id}/image', [ImageableController::class, 'update'])->whereIn('type', ['user', 'post'])->whereNumber('id')->name('imageables.image.update');
    Route::delete('{type}/{id}/image', [ImageableController::class, 'destroy'])->whereIn('type', ['user', 'post'])->whereNumber('id')->name('imageables.image.destroy');
});

/*
|--------------------------------------------------------------------------
| Polymorphic One To Many: Post and Video morphMany Comment
|--------------------------------------------------------------------------
*/
Route::prefix('polymorphic-one-to-many')->name('polymorphic-one-to-many.')->group(function (): void {
    // morphTo side
    Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('comments/details', [CommentController::class, 'details'])->name('comments.details');
    Route::get('comments/search', [CommentController::class, 'search'])->name('comments.search');
    Route::get('comments/{comment}/commentable', [CommentController::class, 'show'])->name('comments.commentable.show');
    Route::put('comments/{comment}/commentable', [CommentController::class, 'reassign'])->name('comments.commentable.reassign');
    Route::patch('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // morphMany side, {type} is a morph map alias: post or video
    Route::get('{type}', [CommentableController::class, 'index'])->whereIn('type', ['post', 'video'])->name('commentables.index');
    Route::get('{type}/{id}/comments', [CommentableController::class, 'list'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('commentables.comments.list');
    Route::get('{type}/{id}/comments/count', [CommentableController::class, 'count'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('commentables.comments.count');
    Route::get('{type}/{id}/comments/latest', [CommentableController::class, 'latest'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('commentables.comments.latest');
    Route::get('{type}/{id}/comments/filter', [CommentableController::class, 'filter'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('commentables.comments.filter');
    Route::get('{type}/{id}/comments/{comment}', [CommentableController::class, 'find'])->whereIn('type', ['post', 'video'])->whereNumber('id')->whereNumber('comment')->name('commentables.comments.find');
    Route::post('{type}/{id}/comments/create', [CommentableController::class, 'create'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('commentables.comments.create');
    Route::post('{type}/{id}/comments/create-many', [CommentableController::class, 'createMany'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('commentables.comments.create-many');
    Route::post('{type}/{id}/comments/save', [CommentableController::class, 'save'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('commentables.comments.save');
    Route::patch('{type}/{id}/comments/approve', [CommentableController::class, 'approve'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('commentables.comments.approve');
    Route::patch('{type}/{id}/comments', [CommentableController::class, 'updateAll'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('commentables.comments.update-all');
    Route::patch('{type}/{id}/comments/{comment}', [CommentableController::class, 'update'])->whereIn('type', ['post', 'video'])->whereNumber('id')->whereNumber('comment')->name('commentables.comments.update');
    Route::delete('{type}/{id}/comments', [CommentableController::class, 'destroyAll'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('commentables.comments.destroy-all');
    Route::delete('{type}/{id}/comments/{comment}', [CommentableController::class, 'destroy'])->whereIn('type', ['post', 'video'])->whereNumber('id')->whereNumber('comment')->name('commentables.comments.destroy');
});

/*
|--------------------------------------------------------------------------
| Polymorphic Many To Many: Post and Video morphToMany Tag
|--------------------------------------------------------------------------
*/
Route::prefix('polymorphic-many-to-many')->name('polymorphic-many-to-many.')->group(function (): void {
    // tag side
    Route::get('tags', [TagController::class, 'index'])->name('tags.index');
    Route::post('tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('tags/by-type/{type}', [TagController::class, 'byType'])->whereIn('type', ['post', 'video'])->name('tags.by-type');
    Route::patch('tags/{tag}', [TagController::class, 'update'])->whereNumber('tag')->name('tags.update');
    Route::delete('tags/{tag}', [TagController::class, 'destroy'])->whereNumber('tag')->name('tags.destroy');
    Route::get('tags/{tag}/{type}', [TagController::class, 'show'])->whereIn('type', ['post', 'video'])->whereNumber('tag')->name('tags.taggables.show');
    Route::post('tags/{tag}/{type}', [TagController::class, 'attach'])->whereIn('type', ['post', 'video'])->whereNumber('tag')->name('tags.taggables.attach');
    Route::put('tags/{tag}/{type}/sync', [TagController::class, 'sync'])->whereIn('type', ['post', 'video'])->whereNumber('tag')->name('tags.taggables.sync');
    Route::delete('tags/{tag}/{type}', [TagController::class, 'detachAll'])->whereIn('type', ['post', 'video'])->whereNumber('tag')->name('tags.taggables.detach-all');
    Route::delete('tags/{tag}/{type}/{id}', [TagController::class, 'detach'])->whereIn('type', ['post', 'video'])->whereNumber('tag')->whereNumber('id')->name('tags.taggables.detach');

    // morphToMany side, {type} is a morph map alias: post or video
    Route::get('{type}', [TaggableController::class, 'index'])->whereIn('type', ['post', 'video'])->name('taggables.index');
    Route::get('{type}/{id}/tags', [TaggableController::class, 'show'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('taggables.tags.show');
    Route::get('{type}/{id}/tags/has', [TaggableController::class, 'has'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('taggables.tags.has');
    Route::post('{type}/{id}/tags', [TaggableController::class, 'attach'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('taggables.tags.attach');
    Route::post('{type}/{id}/tags/create', [TaggableController::class, 'create'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('taggables.tags.create');
    Route::put('{type}/{id}/tags/sync', [TaggableController::class, 'sync'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('taggables.tags.sync');
    Route::put('{type}/{id}/tags/sync-without-detaching', [TaggableController::class, 'syncWithoutDetaching'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('taggables.tags.sync-without-detaching');
    Route::post('{type}/{id}/tags/toggle', [TaggableController::class, 'toggle'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('taggables.tags.toggle');
    Route::delete('{type}/{id}/tags', [TaggableController::class, 'detachAll'])->whereIn('type', ['post', 'video'])->whereNumber('id')->name('taggables.tags.detach-all');
    Route::delete('{type}/{id}/tags/{tag}', [TaggableController::class, 'detach'])->whereIn('type', ['post', 'video'])->whereNumber('id')->whereNumber('tag')->name('taggables.tags.detach');
});