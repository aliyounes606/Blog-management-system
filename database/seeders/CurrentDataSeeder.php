<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CurrentDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'ali',
                'email' => 'ali@ali.com',
                'email_verified_at' => null,
                'password' => Hash::make('00000000'),
                'remember_token' => null,
                'created_at' => '2025-12-06 17:03:00',
                'updated_at' => '2025-12-06 17:03:00',
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'issa',
                'email' => 'issa@issa.com',
                'email_verified_at' => null,
                'password' => Hash::make('00000000'),
                'remember_token' => null,
                'created_at' => '2025-12-10 16:51:23',
                'updated_at' => '2025-12-10 16:51:23',
                'role' => 'user',
            ],

        ]);



        DB::table('categories')->insert([
            [
                'id' => 6,
                'name' => 'Technology & Programming',
                'created_at' => '2025-12-11 17:09:38',
                'updated_at' => '2025-12-11 17:09:38',
            ],
            [
                'id' => 7,
                'name' => 'Lifestyle & Self-Improvement',
                'created_at' => '2025-12-11 17:10:11',
                'updated_at' => '2025-12-11 17:10:11',
            ],
            [
                'id' => 8,
                'name' => 'Travel & Tourism',
                'created_at' => '2025-12-11 17:10:34',
                'updated_at' => '2025-12-11 17:10:34',
            ],
        ]);


        DB::table('blogs')->insert([
            [
                'id' => 16,
                'title' => 'Top 5 AI tools for creating web content',
                'content' => 'The world of content creation is undergoing a revolution thanks to artificial intelligence (AI) tools. Writing blog posts or product descriptions no longer takes hours. In this blog, we discuss the best tools that can accelerate your content creation process, such as image generators and Large Language Models (LLMs)-based article writing tools. We explain how these tools can help marketers and developers alike achieve greater efficiency and productivity.',
                'image' => '1765484131490.jpg',
                'created_at' => '2025-12-11 17:15:31',
                'updated_at' => '2025-12-11 17:15:31',
                'deleted_at' => null,
            ],
            [
                'id' => 17,
                'title' => 'The art of minimalism: How to reduce clutter and increase focus in your life',
                'content' => 'Minimalism is more than just getting rid of things; it\'s a philosophy that helps you prioritize and live more deeply. By applying minimalist principles to your workspace and home, you can reduce stress and free up time and energy for what truly matters. This blog offers a practical guide to begin your decluttering journey, from clothing to your digital commitments, and how this simple change can impact your mental health and overall well-being.',
                'image' => '1765484917490.jpg',
                'created_at' => '2025-12-11 17:28:37',
                'updated_at' => '2025-12-11 17:28:37',
                'deleted_at' => null,
            ],
            [
                'id' => 18,
                'title' => 'A beginner\'s guide to Southeast Asia: budget and planning',
                'content' => 'Southeast Asia is an ideal destination for budget-conscious travelers. In this comprehensive guide, we\'ll give you tips on how to plan your first trip, including the best budget destinations (like Vietnam and Thailand), average daily costs for transportation and accommodation, and advice on visas and essential vaccinations. We\'ll also cover the most important apps you should have on your phone for a smooth and enjoyable travel experience without breaking the bank.',
                'image' => '1765485052465.jpg',
                'created_at' => '2025-12-11 17:30:52',
                'updated_at' => '2025-12-11 17:30:52',
                'deleted_at' => null,
            ],
        ]);


        DB::table('blog_category')->insert([
            [
                'id' => 17,
                'blog_id' => 16,
                'category_id' => 6,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 18,
                'blog_id' => 17,
                'category_id' => 7,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 19,
                'blog_id' => 18,
                'category_id' => 8,
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
