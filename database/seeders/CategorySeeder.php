<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Final Year Project Proposal',
                'description' => 'Documents related to the initial project proposal, including project scope, objectives, and methodology.',
            ],
            [
                'name' => 'System Design Document',
                'description' => 'Documents that outline the system architecture, database design, and overall technical specifications.',
            ],
            [
                'name' => 'Project Presentation',
                'description' => 'Slides and supporting materials for the final project presentation.',
            ],
            [
                'name' => 'Final Project Report',
                'description' => 'The comprehensive final report documenting the entire project process, implementation, and results.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}