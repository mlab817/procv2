<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get(database_path() . '/seeders/json/staff.json');
        $json = json_decode($file);

        foreach ($json as $staff) {
        	Staff::create([
        		'name' => $staff->name,
	        ]);
        }
    }
}
