<?php

use Illuminate\Database\Seeder;
use App\PostCategory;

class PostCategoryTableSeeder extends Seeder
{
	protected $translatedNames = [
		'General'				=> 'عام',
		'Banking'				=> 'بنوك',
		'Mobile & Broadband'	=> 'شبكات واتصالات',
		'Travel'				=> 'سفر'
	];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostCategory::create([
        	'title'	=> 'General',
        ]);

        PostCategory::create([
        	'title'	=> 'Banking',
        ]);

        PostCategory::create([
        	'title'	=> 'Mobile & Broadband',
        ]);

        PostCategory::create([
        	'title'	=> 'Travel',
        ]);

        $postsCategories = PostCategory::get();

        foreach ($postsCategories as $postCategory) {
            $postCategory->addTranslation([
                'translatable_attribute' => 'title',
                'translation' => $this->translatedNames[$postCategory->title]
            ]);
        }
    }
}
