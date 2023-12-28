<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // User Interactions
    Route::apiResource('user-interactions', 'UserInteractionsApiController');

    // Nodes
    Route::post('nodes/media', 'NodesApiController@storeMedia')->name('nodes.storeMedia');
    Route::apiResource('nodes', 'NodesApiController');

    // Verse Connections
    Route::apiResource('verse-connections', 'VerseConnectionsApiController');

    // Node Media
    Route::post('node-media/media', 'NodeMediaApiController@storeMedia')->name('node-media.storeMedia');
    Route::apiResource('node-media', 'NodeMediaApiController');

    // Links
    Route::apiResource('links', 'LinksApiController');

    // Verse Connection Links
    Route::apiResource('verse-connection-links', 'VerseConnectionLinksApiController');

    // Diagram Types
    Route::apiResource('diagram-types', 'DiagramTypesApiController');

    // Bible Pathways
    Route::apiResource('bible-pathways', 'BiblePathwaysApiController');
});
