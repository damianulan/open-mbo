<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MBO\ObjectiveTemplateCategory;

class MBOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(ObjectiveTemplateCategory::count() > 0){
            return;
        }
        $category = new ObjectiveTemplateCategory();
        $category->name = 'Cele Globalne';
        $category->shortname = 'global';
        $category->global = true;
        $category->save();

        $category = new ObjectiveTemplateCategory();
        $category->name = 'Cele Kontrolne';
        $category->shortname = 'audit';
        $category->save();

        $category = new ObjectiveTemplateCategory();
        $category->name = 'Cele Indywidualne';
        $category->shortname = 'individual';
        $category->save();
    }
}
