<?php

namespace App\Facades\Modules;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Facades\Modules\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = new Module();
        $module->name = 'calendar';
        $module->category = 'elearning';
        $module->icon = 'bi-calendar2-week-fill';
        $module->active = true;
        $module->order = 1;
        $module->save();

        $module = new Module();
        $module->name = 'blended';
        $module->category = 'elearning';
        $module->icon = 'bi-layers-half';
        $module->active = true;
        $module->order = 3;
        $module->save();

        $module = new Module();
        $module->name = 'tasks';
        $module->category = 'elearning';
        $module->icon = 'bi-check-square-fill';
        $module->active = true;
        $module->order = 2;
        $module->save();

        $module = new Module();
        $module->name = 'learning_paths';
        $module->category = 'elearning';
        $module->icon = 'bi-signpost-split-fill';
        $module->active = true;
        $module->order = 4;
        $module->save();

        $module = new Module();
        $module->name = 'reports';
        $module->category = 'admin';
        $module->icon = 'bi-bar-chart-steps';
        $module->active = true;
        $module->order = 5;
        $module->save();

        $module = new Module();
        $module->name = 'projects';
        $module->category = 'admin';
        $module->icon = 'bi-box-seam-fill';
        $module->active = false;
        $module->order = 6;
        $module->save();
    }

}
