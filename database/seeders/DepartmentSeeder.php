<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        // Create Communication Department
        $communication = Department::create(['name' => 'Communication']);

        // Create Internet sub-department
        $internet = Department::create(['name' => 'Internet', 'parent_id' => $communication->id]);

        // Create further sub-departments under Internet
        Department::create(['name' => 'IT', 'parent_id' => $internet->id]);
        Department::create(['name' => 'Field', 'parent_id' => $internet->id]);
        Department::create(['name' => 'NOC Engineer', 'parent_id' => $internet->id]);
    }
}
