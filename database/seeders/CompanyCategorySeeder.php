<?php

namespace Database\Seeders;

use App\Models\CompanyCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            
            'Other' ,
            'Automotive',
            'Beauty and Personal Care',
            'Clothing and Apparel',
            'Electronics and Gadgets',
            'Home and Garden',
            'Health and Wellness',
            'Sports and Outdoors',
            'Toys and Games',
            'Travel and Tourism',
            'Education and Learning',
            'Technology',
            'Finance',
            'Retail',
            'Construction',
            'Transportation',
            'Real Estate',
            'Entertainment',
            'Agriculture',
            'Energy',
            'Telecommunications',
            'Media',
            'Consulting',
            'Non-Profit',
            'Government',
            'Insurance',
            'Food and Beverage',
            'Fashion',
            'Art',
            'Environmental',
            'Aerospace',
            'Logistics',
            'Pharmaceuticals',
            'Recreation',
            'Security',
            'Legal',
            'Hospitality',
            'Wholesale',
            'Distribution',
            'Manufacturing',
            'Mining',
            
        ];
    
        foreach ($categories as $category) {
            CompanyCategory::create(['name' => $category]);
        }
    }
}
