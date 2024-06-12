<?php

namespace Nguyenhien\Feedback;

use Backend\Facades\Backend;
use Backend\Models\UserRole;
use System\Classes\PluginBase;
/**
 * feedback Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'nguyenhien.feedback::lang.plugin.name',
            'description' => 'nguyenhien.feedback::lang.plugin.description',
            'author'      => 'nguyenhien',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {
        
    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return [
            'Nguyenhien\Feedback\Components\Mails' => 'mails',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return []; // Remove this line to activate

        return [
            'nguyenhien.feedback.some_permission' => [
                'tab' => 'nguyenhien.feedback::lang.plugin.name',
                'label' => 'nguyenhien.feedback::lang.permissions.some_permission',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        return []; // Remove this line to activate

        return [
            'feedback' => [
                'label'       => 'nguyenhien.feedback::lang.plugin.name',
                'url'         => Backend::url('nguyenhien/feedback/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['nguyenhien.feedback.*'],
                'order'       => 500,
            ],
        ];
    }
}
