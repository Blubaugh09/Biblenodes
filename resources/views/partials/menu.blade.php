<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('bible_pathway_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.bible-pathways.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bible-pathways") || request()->is("admin/bible-pathways/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.biblePathway.title') }}
                </a>
            </li>
        @endcan
        @can('node_creation_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/node-images*") ? "c-show" : "" }} {{ request()->is("admin/node-types*") ? "c-show" : "" }} {{ request()->is("admin/nodes*") ? "c-show" : "" }} {{ request()->is("admin/verse-connections*") ? "c-show" : "" }} {{ request()->is("admin/node-media*") ? "c-show" : "" }} {{ request()->is("admin/links*") ? "c-show" : "" }} {{ request()->is("admin/verse-connection-links*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.nodeCreation.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('node_image_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.node-images.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/node-images") || request()->is("admin/node-images/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.nodeImage.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('node_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.node-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/node-types") || request()->is("admin/node-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.nodeType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('node_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.nodes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/nodes") || request()->is("admin/nodes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.node.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('verse_connection_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.verse-connections.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/verse-connections") || request()->is("admin/verse-connections/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.verseConnection.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('node_medium_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.node-media.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/node-media") || request()->is("admin/node-media/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.nodeMedium.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('link_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.links.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/links") || request()->is("admin/links/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.link.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('verse_connection_link_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.verse-connection-links.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/verse-connection-links") || request()->is("admin/verse-connection-links/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.verseConnectionLink.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('content_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/content-categories*") ? "c-show" : "" }} {{ request()->is("admin/content-tags*") ? "c-show" : "" }} {{ request()->is("admin/content-pages*") ? "c-show" : "" }} {{ request()->is("admin/sessions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('content_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_page_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentPage.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('session_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.sessions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sessions") || request()->is("admin/sessions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.session.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/user-interactions*") ? "c-show" : "" }} {{ request()->is("admin/bookmarks*") ? "c-show" : "" }} {{ request()->is("admin/notes*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_interaction_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-interactions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-interactions") || request()->is("admin/user-interactions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userInteraction.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bookmark_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bookmarks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bookmarks") || request()->is("admin/bookmarks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bookmark.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('note_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.notes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/notes") || request()->is("admin/notes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.note.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('diagram_type_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.diagram-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/diagram-types") || request()->is("admin/diagram-types/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.diagramType.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>