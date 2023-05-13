<?php

namespace App\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;
use Yajra\DataTables\Html\Builder;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Blade helpers not run in console mode
        if ($this->app->runningInConsole()) {
            return;
        }

        // Form builder
        FormBuilder::component('errors', 'components.form-errors', ['name']);
        FormBuilder::component('help', 'components.form-help', ['content']);
        FormBuilder::component('plantext', 'components.form-plantext', ['name', 'value']);

        // Menu macro
        Menu::macro('postLink', function (string $url, string $text) {
            $formId = uniqid('form-');
            $script = "event.preventDefault(); document.getElementById('{$formId}').submit();";
            $format = '<form id="%s" action="%s" method="POST" style="display: none;">%s</form>';
            $this->add(
                Link::to($url, $text)
                    ->setAttribute('onclick', $script)
                    ->append(sprintf($format, $formId, $url, csrf_field()))
            );
        });

        Menu::macro('mainMenu', function () {
            if (Auth::user()->hasRole('Administrators')) {
                return Menu::new()
                    ->route('home', '<i class="fas fa-fw fa-home mr-2"></i>' . __('Home'))
                    ->url('/users', '<i class="far fa-fw fa-user mr-2"></i>' . __('Quản lý người dùng'))
                    ->route('students.index', '<i class="far fa-fw fa-user mr-2"></i>' . __('Quản lý sinh viên'))
                    ->route('teacher.index', '<i class="far fa-fw fa-user mr-2"></i>' . __('Quản lý Giảng viên'))
                    ->route('roles.index', '<i class="fas fa-fw fa-shield-alt mr-2"></i>' . __('Quản lý quyền'))
                    ->addClass('list-unstyled sidebar-menu mb-0')
                    ->setAttribute('role', 'menu')
                    ->setActiveClassOnParent(true)
                    ->setActiveFromRequest();
            } elseif (Auth::user()->hasRole('Teachers')) {
                return Menu::new()
                    ->route('home', '<i class="fas fa-fw fa-home mr-2"></i>' . __('Home'))
                    ->route('students.index', '<i class="far fa-fw fa-user mr-2"></i>' . __('Quản lý sinh viên'))
                    ->route('classcourse.index', '<i class="fas fa-school mr-2"></i>' . __('Quản lý lớp học'))
                    ->route('studentcheck.index', '<i class="fas fa-fw fa-shield-alt mr-2"></i>' . __('Điểm danh'))
                    ->route('studentcheckmanager.index', '<i class="fas fa-fw fa-shield-alt mr-2"></i>' . __('Quản lý điểm danh'))
                    ->addClass('list-unstyled sidebar-menu mb-0')
                    ->setAttribute('role', 'menu')
                    ->setActiveClassOnParent(true)
                    ->setActiveFromRequest();
            }

        });

        // DataTable Builder
        Builder::macro('domBs4', function () {
            $dom = "<'row'<'col-sm-12 col-md-8'B><'col-sm-12 col-md-4'f>>"
                . "<'row'<'col-sm-12 table-responsive'tr>>"
                . "<'row'<'col-sm-12 col-md-5'Si><'col-sm-12 col-md-7'p>>";

            return $this->dom($dom);
        });
    }
}
