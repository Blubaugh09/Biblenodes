<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 29,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 30,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 31,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 32,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 33,
                'title' => 'user_interaction_create',
            ],
            [
                'id'    => 34,
                'title' => 'user_interaction_edit',
            ],
            [
                'id'    => 35,
                'title' => 'user_interaction_show',
            ],
            [
                'id'    => 36,
                'title' => 'user_interaction_delete',
            ],
            [
                'id'    => 37,
                'title' => 'user_interaction_access',
            ],
            [
                'id'    => 38,
                'title' => 'node_creation_access',
            ],
            [
                'id'    => 39,
                'title' => 'node_create',
            ],
            [
                'id'    => 40,
                'title' => 'node_edit',
            ],
            [
                'id'    => 41,
                'title' => 'node_show',
            ],
            [
                'id'    => 42,
                'title' => 'node_delete',
            ],
            [
                'id'    => 43,
                'title' => 'node_access',
            ],
            [
                'id'    => 44,
                'title' => 'bookmark_create',
            ],
            [
                'id'    => 45,
                'title' => 'bookmark_edit',
            ],
            [
                'id'    => 46,
                'title' => 'bookmark_show',
            ],
            [
                'id'    => 47,
                'title' => 'bookmark_delete',
            ],
            [
                'id'    => 48,
                'title' => 'bookmark_access',
            ],
            [
                'id'    => 49,
                'title' => 'session_create',
            ],
            [
                'id'    => 50,
                'title' => 'session_edit',
            ],
            [
                'id'    => 51,
                'title' => 'session_show',
            ],
            [
                'id'    => 52,
                'title' => 'session_delete',
            ],
            [
                'id'    => 53,
                'title' => 'session_access',
            ],
            [
                'id'    => 54,
                'title' => 'note_create',
            ],
            [
                'id'    => 55,
                'title' => 'note_edit',
            ],
            [
                'id'    => 56,
                'title' => 'note_show',
            ],
            [
                'id'    => 57,
                'title' => 'note_delete',
            ],
            [
                'id'    => 58,
                'title' => 'note_access',
            ],
            [
                'id'    => 59,
                'title' => 'node_image_create',
            ],
            [
                'id'    => 60,
                'title' => 'node_image_edit',
            ],
            [
                'id'    => 61,
                'title' => 'node_image_show',
            ],
            [
                'id'    => 62,
                'title' => 'node_image_delete',
            ],
            [
                'id'    => 63,
                'title' => 'node_image_access',
            ],
            [
                'id'    => 64,
                'title' => 'node_type_create',
            ],
            [
                'id'    => 65,
                'title' => 'node_type_edit',
            ],
            [
                'id'    => 66,
                'title' => 'node_type_show',
            ],
            [
                'id'    => 67,
                'title' => 'node_type_delete',
            ],
            [
                'id'    => 68,
                'title' => 'node_type_access',
            ],
            [
                'id'    => 69,
                'title' => 'verse_connection_create',
            ],
            [
                'id'    => 70,
                'title' => 'verse_connection_edit',
            ],
            [
                'id'    => 71,
                'title' => 'verse_connection_show',
            ],
            [
                'id'    => 72,
                'title' => 'verse_connection_delete',
            ],
            [
                'id'    => 73,
                'title' => 'verse_connection_access',
            ],
            [
                'id'    => 74,
                'title' => 'node_medium_create',
            ],
            [
                'id'    => 75,
                'title' => 'node_medium_edit',
            ],
            [
                'id'    => 76,
                'title' => 'node_medium_show',
            ],
            [
                'id'    => 77,
                'title' => 'node_medium_delete',
            ],
            [
                'id'    => 78,
                'title' => 'node_medium_access',
            ],
            [
                'id'    => 79,
                'title' => 'link_create',
            ],
            [
                'id'    => 80,
                'title' => 'link_edit',
            ],
            [
                'id'    => 81,
                'title' => 'link_show',
            ],
            [
                'id'    => 82,
                'title' => 'link_delete',
            ],
            [
                'id'    => 83,
                'title' => 'link_access',
            ],
            [
                'id'    => 84,
                'title' => 'verse_connection_link_create',
            ],
            [
                'id'    => 85,
                'title' => 'verse_connection_link_edit',
            ],
            [
                'id'    => 86,
                'title' => 'verse_connection_link_show',
            ],
            [
                'id'    => 87,
                'title' => 'verse_connection_link_delete',
            ],
            [
                'id'    => 88,
                'title' => 'verse_connection_link_access',
            ],
            [
                'id'    => 89,
                'title' => 'diagram_type_create',
            ],
            [
                'id'    => 90,
                'title' => 'diagram_type_edit',
            ],
            [
                'id'    => 91,
                'title' => 'diagram_type_show',
            ],
            [
                'id'    => 92,
                'title' => 'diagram_type_delete',
            ],
            [
                'id'    => 93,
                'title' => 'diagram_type_access',
            ],
            [
                'id'    => 94,
                'title' => 'bible_pathway_create',
            ],
            [
                'id'    => 95,
                'title' => 'bible_pathway_edit',
            ],
            [
                'id'    => 96,
                'title' => 'bible_pathway_show',
            ],
            [
                'id'    => 97,
                'title' => 'bible_pathway_delete',
            ],
            [
                'id'    => 98,
                'title' => 'bible_pathway_access',
            ],
            [
                'id'    => 99,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
