<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        // ── Core Values ───────────────────────────────────────────────
        $coreValues = [
            [
                'icon' => 'Enterprise',
                'en' => ['title' => 'Innovation',   'description' => 'We constantly push the boundaries of technology to deliver cutting-edge solutions.'],
                'ar' => ['title' => 'الابتكار',      'description' => 'نسعى باستمرار إلى دفع حدود التكنولوجيا لتقديم حلول متطورة.'],
            ],
            [
                'icon' => 'Network',
                'en' => ['title' => 'Client Focus', 'description' => 'Our clients are at the center of everything we do. We build lasting partnerships.'],
                'ar' => ['title' => 'التركيز على العملاء', 'description' => 'عملاؤنا في قلب كل ما نقوم به. نحن نبني شراكات دائمة.'],
            ],
            [
                'icon' => 'CLOUD',
                'en' => ['title' => 'Excellence',   'description' => 'We maintain the highest standards of quality in every project we undertake.'],
                'ar' => ['title' => 'التميز',        'description' => 'نحافظ على أعلى معايير الجودة في كل مشروع نتولاه.'],
            ],
            [
                'icon' => 'security',
                'en' => ['title' => 'Integrity',    'description' => 'We operate with transparency and honesty in all our business relationships.'],
                'ar' => ['title' => 'النزاهة',       'description' => 'نعمل بشفافية وأمانة في جميع علاقاتنا التجارية.'],
            ],
        ];

        foreach ($coreValues as $cv) {
            $id = DB::table('core_values')->insertGetId([
                'icon'       => $cv['icon'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            foreach (['en', 'ar'] as $locale) {
                DB::table('core_value_translations')->insert([
                    'core_value_id' => $id,
                    'locale'        => $locale,
                    'title'         => $cv[$locale]['title'],
                    'description'   => $cv[$locale]['description'],
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }

        // ── Team Members ──────────────────────────────────────────────
        $team = [
            ['name' => 'Ahmed Al-Rashid', 'role' => 'CEO & Founder',       'initial' => 'A'],
            ['name' => 'Sarah Chen',      'role' => 'CTO',                  'initial' => 'S'],
            ['name' => 'David Mitchell',  'role' => 'Head of Development',  'initial' => 'D'],
            ['name' => 'Maria Garcia',    'role' => 'Head of Design',       'initial' => 'M'],
        ];

        foreach ($team as $member) {
            DB::table('team_members')->insert([
                'name'       => $member['name'],
                'role'       => $member['role'],
                'initial'    => $member['initial'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ── Why Items ─────────────────────────────────────────────────
        $whyItems = [
            [
                'en' => 'We commit to the highest standards of quality and integrity in every engagement.',
                'ar' => 'نلتزم بأعلى معايير الجودة والنزاهة في كل مشروع.',
            ],
            [
                'en' => 'We constantly incorporate cutting-edge technology to deliver superior client outcomes.',
                'ar' => 'ندمج باستمرار أحدث التقنيات لتحقيق نتائج متفوقة لعملائنا.',
            ],
            [
                'en' => 'We take a comprehensive, enterprise-grade approach to every solution we build.',
                'ar' => 'نتبنى نهجاً شاملاً وبمستوى مؤسسي لكل حل نبنيه.',
            ],
            [
                'en' => 'We provide 24/7 support and maintenance for all solutions we deliver.',
                'ar' => 'نقدم دعماً وصيانة على مدار الساعة لجميع الحلول التي نسلمها.',
            ],
        ];

        foreach ($whyItems as $item) {
            $id = DB::table('why_items')->insertGetId([
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            foreach (['en', 'ar'] as $locale) {
                DB::table('why_item_translations')->insert([
                    'why_item_id' => $id,
                    'locale'      => $locale,
                    'text'        => $item[$locale],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
