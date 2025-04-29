<?php

namespace Database\Seeders;

use App\Models\Rubric;
use App\Models\Category;
use Illuminate\Database\Seeder;

class RubricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        // Rubrics for Final Year Project Proposal
        $proposalCategory = $categories->where('name', 'Final Year Project Proposal')->first();
        if ($proposalCategory) {
            Rubric::create([
                'category_id' => $proposalCategory->id,
                'title' => 'Problem Definition',
                'description' => 'Clear articulation of the problem being addressed and its significance.',
                'max_score' => 20,
            ]);

            Rubric::create([
                'category_id' => $proposalCategory->id,
                'title' => 'Methodology',
                'description' => 'Appropriate research methods and approaches to address the problem.',
                'max_score' => 30,
            ]);

            Rubric::create([
                'category_id' => $proposalCategory->id,
                'title' => 'Feasibility',
                'description' => 'Realistic timeline, resources, and technical feasibility of the proposed project.',
                'max_score' => 25,
            ]);

            Rubric::create([
                'category_id' => $proposalCategory->id,
                'title' => 'Literature Review',
                'description' => 'Comprehensive review of relevant literature and existing solutions.',
                'max_score' => 25,
            ]);
        }

        // Rubrics for System Design Document
        $designCategory = $categories->where('name', 'System Design Document')->first();
        if ($designCategory) {
            Rubric::create([
                'category_id' => $designCategory->id,
                'title' => 'Architecture Design',
                'description' => 'Appropriate system architecture that addresses the problem requirements.',
                'max_score' => 30,
            ]);

            Rubric::create([
                'category_id' => $designCategory->id,
                'title' => 'Database Design',
                'description' => 'Well-structured database schema with proper relationships and normalization.',
                'max_score' => 25,
            ]);

            Rubric::create([
                'category_id' => $designCategory->id,
                'title' => 'UI/UX Design',
                'description' => 'Intuitive user interface design with good user experience considerations.',
                'max_score' => 20,
            ]);

            Rubric::create([
                'category_id' => $designCategory->id,
                'title' => 'Security Considerations',
                'description' => 'Appropriate security measures and data protection strategies.',
                'max_score' => 25,
            ]);
        }

        // Rubrics for Project Presentation
        $presentationCategory = $categories->where('name', 'Project Presentation')->first();
        if ($presentationCategory) {
            Rubric::create([
                'category_id' => $presentationCategory->id,
                'title' => 'Content & Organization',
                'description' => 'Well-organized presentation with clear, concise, and relevant content.',
                'max_score' => 30,
            ]);

            Rubric::create([
                'category_id' => $presentationCategory->id,
                'title' => 'Delivery & Communication',
                'description' => 'Clear communication, good pace, and engaging delivery.',
                'max_score' => 25,
            ]);

            Rubric::create([
                'category_id' => $presentationCategory->id,
                'title' => 'Visual Aids',
                'description' => 'Effective use of slides, diagrams, and other visual elements.',
                'max_score' => 20,
            ]);

            Rubric::create([
                'category_id' => $presentationCategory->id,
                'title' => 'Q&A Handling',
                'description' => 'Ability to address questions effectively and demonstrate knowledge.',
                'max_score' => 25,
            ]);
        }

        // Rubrics for Final Project Report
        $reportCategory = $categories->where('name', 'Final Project Report')->first();
        if ($reportCategory) {
            Rubric::create([
                'category_id' => $reportCategory->id,
                'title' => 'Executive Summary',
                'description' => 'Clear and concise summary of the project, its goals, and outcomes.',
                'max_score' => 15,
            ]);

            Rubric::create([
                'category_id' => $reportCategory->id,
                'title' => 'Implementation Details',
                'description' => 'Comprehensive documentation of the implementation process, challenges, and solutions.',
                'max_score' => 30,
            ]);

            Rubric::create([
                'category_id' => $reportCategory->id,
                'title' => 'Testing & Validation',
                'description' => 'Thorough testing approach with clear results and validation of requirements.',
                'max_score' => 25,
            ]);

            Rubric::create([
                'category_id' => $reportCategory->id,
                'title' => 'Conclusion & Future Work',
                'description' => 'Insightful conclusions, limitations, and suggestions for future improvements.',
                'max_score' => 15,
            ]);

            Rubric::create([
                'category_id' => $reportCategory->id,
                'title' => 'References & Documentation',
                'description' => 'Proper citations, references, and comprehensive documentation.',
                'max_score' => 15,
            ]);
        }
    }
}