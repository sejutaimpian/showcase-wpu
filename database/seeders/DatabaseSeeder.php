<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AppType;
use App\Models\Developer;
use App\Models\Language;
use App\Models\Project;
use App\Models\Tech;
use App\Models\Time;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();
        Time::factory(10)->create();

        AppType::create([
            'name' => 'Desktop',
            'icon' => 'app type icon/desktop.png'
        ]);
        AppType::create([
            'name' => 'Internet Of Things',
            'icon' => 'app type icon/iot.png'
        ]);
        AppType::create([
            'name' => 'Mobile',
            'icon' => 'app type icon/mobile.png'
        ]);
        AppType::create([
            'name' => 'Other',
            'icon' => 'app type icon/other.png'
        ]);
        AppType::create([
            'name' => 'Service',
            'icon' => 'app type icon/service.png'
        ]);
        AppType::create([
            'name' => 'Website',
            'icon' => 'app type icon/website.png'
        ]);
        // 6 app_type

        Tech::create([
            'name' => 'AlpineJS',
            'link' => 'https://alpinejs.dev/',
            'icon' => 'tech icon/alpinejs.svg'
        ]);
        Tech::create([
            'name' => 'Bootstrap',
            'link' => 'https://getbootstrap.com/',
            'icon' => 'tech icon/bootstrap.svg'
        ]);
        Tech::create([
            'name' => 'ExpressJS',
            'link' => 'https://expressjs.com/',
            'icon' => 'tech icon/expressjs.svg'
        ]);
        Tech::create([
            'name' => 'Flutter',
            'link' => 'https://flutter.dev/',
            'icon' => 'tech icon/flutter.svg'
        ]);
        Tech::create([
            'name' => 'Flutter',
            'link' => 'https://flutter.dev/',
            'icon' => 'tech icon/flutter.svg'
        ]);
        Tech::create([
            'name' => 'GatsbyJS',
            'link' => 'https://gatsbyjs.com/',
            'icon' => 'tech icon/gatsby.svg'
        ]);
        Tech::create([
            'name' => 'jQuery',
            'link' => 'https://jquery.com/',
            'icon' => 'tech icon/jquery.svg'
        ]);
        Tech::create([
            'name' => 'Laravel',
            'link' => 'https://laravel.com/',
            'icon' => 'tech icon/laravel.svg'
        ]);
        Tech::create([
            'name' => 'Livewire',
            'link' => 'https://livewire.laravel.com/',
            'icon' => 'tech icon/livewire.svg'
        ]);
        Tech::create([
            'name' => 'MariaDB',
            'link' => 'https://mariadb.org/',
            'icon' => 'tech icon/mariadb.svg'
        ]);
        Tech::create([
            'name' => 'MongoDB',
            'link' => 'https://mongodb.com/',
            'icon' => 'tech icon/mongodb.svg'
        ]);
        Tech::create([
            'name' => 'MySQL',
            'link' => 'https://mysql.com/',
            'icon' => 'tech icon/mysql.svg'
        ]);
        Tech::create([
            'name' => 'NextJS',
            'link' => 'https://nextjs.org/',
            'icon' => 'tech icon/nextjs.svg'
        ]);
        Tech::create([
            'name' => 'NodeJS',
            'link' => 'https://nodejs.org/',
            'icon' => 'tech icon/nodejs.svg'
        ]);
        Tech::create([
            'name' => 'NuxtJS',
            'link' => 'https://nuxtjs.com/',
            'icon' => 'tech icon/nuxtjs.svg'
        ]);
        Tech::create([
            'name' => 'SQLite',
            'link' => 'https://sqlite.org/',
            'icon' => 'tech icon/sqlite.svg'
        ]);
        Tech::create([
            'name' => 'TailwindCSS',
            'link' => 'https://tailwindcss.com/',
            'icon' => 'tech icon/tailwindcss.svg'
        ]);
        Tech::create([
            'name' => 'Vite',
            'link' => 'https://vitejs.dev/',
            'icon' => 'tech icon/vite.svg'
        ]);
        Tech::create([
            'name' => 'VueJS',
            'link' => 'https://vuejs.org/',
            'icon' => 'tech icon/vuejs.svg'
        ]);
        // 19 tech

        Language::create([
            'name' => 'CSS (Cascading Style Sheets)',
            'link' => 'https://developer.mozilla.org/en-US/docs/Web/CSS',
            'icon' => 'language icon/css3.svg'
        ]);
        Language::create([
            'name' => 'Dart',
            'link' => 'https://dart.dev/',
            'icon' => 'language icon/dart.svg'
        ]);
        Language::create([
            'name' => 'Go',
            'link' => 'https://go.dev/',
            'icon' => 'language icon/go.svg'
        ]);
        Language::create([
            'name' => 'HTML (Hypertext Markup Language)',
            'link' => 'https://developer.mozilla.org/en-US/docs/Web/HTML',
            'icon' => 'language icon/html5.svg'
        ]);
        Language::create([
            'name' => 'Javascript',
            'link' => 'https://developer.mozilla.org/en-US/docs/Web/javascript',
            'icon' => 'language icon/javascript.svg'
        ]);
        Language::create([
            'name' => 'Kotlin',
            'link' => 'https://kotlinlang.org/',
            'icon' => 'language icon/kotlin.svg'
        ]);
        Language::create([
            'name' => 'PHP',
            'link' => 'https://php.net/',
            'icon' => 'language icon/php.svg'
        ]);
        Language::create([
            'name' => 'Python',
            'link' => 'https://python.org/',
            'icon' => 'language icon/python.svg'
        ]);
        Language::create([
            'name' => 'Typescript',
            'link' => 'https://www.typescriptlang.org/',
            'icon' => 'language icon/typescript.svg'
        ]);
        Language::create([
            'name' => 'C++',
            'link' => 'https://isocpp.org/',
            'icon' => 'language icon/cplusplus.svg'
        ]);
        Language::create([
            'name' => '.NET',
            'link' => 'https://dotnet.microsoft.com/',
            'icon' => 'language icon/dotnet.svg'
        ]);
        // 11 language

        Developer::factory(20)->create();
        Project::factory(50)->create();

        for ($i = 1; $i <= 50; $i++) {
            DB::table('project_tech')->insert([
                'project_id' => $i,
                'tech_id' => mt_rand(1, 19)
            ]);
        }
        for ($i = 1; $i <= 50; $i++) {
            DB::table('language_project')->insert([
                'project_id' => $i,
                'language_id' => mt_rand(1, 11)
            ]);
        }
    }
}
