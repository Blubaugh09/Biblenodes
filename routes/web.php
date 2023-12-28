<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // User Interactions
    Route::delete('user-interactions/destroy', 'UserInteractionsController@massDestroy')->name('user-interactions.massDestroy');
    Route::resource('user-interactions', 'UserInteractionsController');

    // Nodes
    Route::delete('nodes/destroy', 'NodesController@massDestroy')->name('nodes.massDestroy');
    Route::post('nodes/media', 'NodesController@storeMedia')->name('nodes.storeMedia');
    Route::post('nodes/ckmedia', 'NodesController@storeCKEditorImages')->name('nodes.storeCKEditorImages');
    Route::resource('nodes', 'NodesController');

    // Bookmarks
    Route::delete('bookmarks/destroy', 'BookmarksController@massDestroy')->name('bookmarks.massDestroy');
    Route::resource('bookmarks', 'BookmarksController');

    // Session
    Route::delete('sessions/destroy', 'SessionController@massDestroy')->name('sessions.massDestroy');
    Route::resource('sessions', 'SessionController');

    // Notes
    Route::delete('notes/destroy', 'NotesController@massDestroy')->name('notes.massDestroy');
    Route::resource('notes', 'NotesController');

    // Node Images
    Route::delete('node-images/destroy', 'NodeImagesController@massDestroy')->name('node-images.massDestroy');
    Route::resource('node-images', 'NodeImagesController');

    // Node Type
    Route::delete('node-types/destroy', 'NodeTypeController@massDestroy')->name('node-types.massDestroy');
    Route::post('node-types/media', 'NodeTypeController@storeMedia')->name('node-types.storeMedia');
    Route::post('node-types/ckmedia', 'NodeTypeController@storeCKEditorImages')->name('node-types.storeCKEditorImages');
    Route::resource('node-types', 'NodeTypeController');

    // Verse Connections
    Route::delete('verse-connections/destroy', 'VerseConnectionsController@massDestroy')->name('verse-connections.massDestroy');
    Route::resource('verse-connections', 'VerseConnectionsController');

    // Node Media
    Route::delete('node-media/destroy', 'NodeMediaController@massDestroy')->name('node-media.massDestroy');
    Route::post('node-media/media', 'NodeMediaController@storeMedia')->name('node-media.storeMedia');
    Route::post('node-media/ckmedia', 'NodeMediaController@storeCKEditorImages')->name('node-media.storeCKEditorImages');
    Route::resource('node-media', 'NodeMediaController');

    // Links
    Route::delete('links/destroy', 'LinksController@massDestroy')->name('links.massDestroy');
    Route::resource('links', 'LinksController');

    // Verse Connection Links
    Route::delete('verse-connection-links/destroy', 'VerseConnectionLinksController@massDestroy')->name('verse-connection-links.massDestroy');
    Route::resource('verse-connection-links', 'VerseConnectionLinksController');

    // Diagram Types
    Route::delete('diagram-types/destroy', 'DiagramTypesController@massDestroy')->name('diagram-types.massDestroy');
    Route::resource('diagram-types', 'DiagramTypesController');

    // Bible Pathways
    Route::delete('bible-pathways/destroy', 'BiblePathwaysController@massDestroy')->name('bible-pathways.massDestroy');
    Route::resource('bible-pathways', 'BiblePathwaysController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
