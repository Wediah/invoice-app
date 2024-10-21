<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'Technology',
            'Finance',
            'Healthcare',
            'Education',
            'Retail',
            'Manufacturing',
            'Construction',
            'Transportation',
            'Hospitality',
            'Real Estate',
            'Entertainment',
            'Agriculture',
            'Mining',
            'Other' // For categories that are not listed
        ];
    
        foreach ($categories as $category) {
            \App\Models\CompanyCategory::create(['name' => $category]);
        }
    }
}
