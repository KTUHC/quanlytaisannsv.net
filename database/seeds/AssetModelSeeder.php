<?php

use Illuminate\Database\Seeder;
use App\Models\AssetModel;
use Illuminate\Support\Facades\Storage;

class AssetModelSeeder extends Seeder
{
    public function run()
    {
        AssetModel::truncate();

        // Laptops
        factory(AssetModel::class, 1)->states('mbp-13-model')->create(); // 1
        factory(AssetModel::class, 1)->states('mbp-air-model')->create(); // 2
        factory(AssetModel::class, 1)->states('surface-model')->create(); // 3
        factory(AssetModel::class, 1)->states('xps13-model')->create(); // 4
        factory(AssetModel::class, 1)->states('spectre-model')->create(); // 5
        factory(AssetModel::class, 1)->states('zenbook-model')->create(); // 6
        factory(AssetModel::class, 1)->states('yoga-model')->create(); // 7

        // Desktops
        factory(AssetModel::class, 1)->states('macpro-model')->create(); // 8
        factory(AssetModel::class, 1)->states('lenovo-i5-model')->create(); // 9
        factory(AssetModel::class, 1)->states('optiplex-model')->create(); // 10

        // Conference Phones
        factory(AssetModel::class, 1)->states('polycom-model')->create(); // 11
        factory(AssetModel::class, 1)->states('polycomcx-model')->create(); // 12

        // Tablets
        factory(AssetModel::class, 1)->states('ipad-model')->create(); // 13
        factory(AssetModel::class, 1)->states('tab3-model')->create(); // 14

        // Phones
        factory(AssetModel::class, 1)->states('iphone11-model')->create(); // 15
        factory(AssetModel::class, 1)->states('iphone12-model')->create(); // 16

        // Displays
        factory(AssetModel::class, 1)->states('ultrafine')->create(); // 17
        factory(AssetModel::class, 1)->states('ultrasharp')->create(); // 18

        $src = public_path('/img/demo/models/');
        $dst = 'models'.'/';
        $del_files = Storage::files($dst);

        foreach($del_files as $del_file){ // iterate files
            $file_to_delete = str_replace($src,'',$del_file);
            \Log::debug('Deleting: '.$file_to_delete);
            try  {
                Storage::disk('public')->delete($dst.$del_file);
            } catch (\Exception $e) {
                \Log::debug($e);
            }
        }


        $add_files = glob($src."/*.*");
        foreach($add_files as $add_file){
            $file_to_copy = str_replace($src,'',$add_file);
            \Log::debug('Copying: '.$file_to_copy);
            try  {
                Storage::disk('public')->put($dst.$file_to_copy, file_get_contents($src.$file_to_copy));
            } catch (\Exception $e) {
                \Log::debug($e);
            }
        }


    }

}
