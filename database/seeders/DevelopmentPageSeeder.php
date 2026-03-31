<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevelopmentPageSeeder extends Seeder
{
    public function run(): void
    {
        // ── Expertise Cards ───────────────────────────────────────────
        $expertise = [
            [
                'image' => '/assets/development/expertise/1.png',
                'en' => [
                    'title'       => 'Web Development',
                    'description' => 'Custom websites and web applications built for performance and growth',
                    'bullets'     => ['Responsive Design', 'E-commerce Platforms', 'CMS Development', 'Progressive Web Apps', 'SEO Optimization'],
                ],
                'ar' => [
                    'title'       => 'تطوير الويب',
                    'description' => 'مواقع وتطبيقات ويب مخصصة مصممة للأداء والنمو',
                    'bullets'     => ['تصميم متجاوب', 'منصات التجارة الإلكترونية', 'تطوير نظام إدارة المحتوى', 'تطبيقات الويب التقدمية', 'تحسين محركات البحث'],
                ],
            ],
            [
                'image' => '/assets/development/expertise/2.png',
                'en' => [
                    'title'       => 'App Development',
                    'description' => 'Native and cross-platform mobile apps that users love',
                    'bullets'     => ['iOS Development', 'Android Development', 'Cross-platform Apps', 'UI/UX Design', 'App Store Deployment'],
                ],
                'ar' => [
                    'title'       => 'تطوير التطبيقات',
                    'description' => 'تطبيقات هاتفية أصلية ومتعددة المنصات يحبها المستخدمون',
                    'bullets'     => ['تطوير iOS', 'تطوير Android', 'تطبيقات متعددة المنصات', 'تصميم واجهة المستخدم', 'نشر على متاجر التطبيقات'],
                ],
            ],
            [
                'image' => '/assets/development/expertise/3.png',
                'en' => [
                    'title'       => 'Software Development',
                    'description' => 'Enterprise-grade software tailored to your exact business needs',
                    'bullets'     => ['Custom Software', 'CRM/ERP Systems', 'API Development', 'Database Design', 'Legacy Modernization'],
                ],
                'ar' => [
                    'title'       => 'تطوير البرمجيات',
                    'description' => 'برمجيات بمستوى مؤسسي مصممة وفق احتياجات أعمالك بالضبط',
                    'bullets'     => ['برمجيات مخصصة', 'أنظمة CRM/ERP', 'تطوير واجهات برمجية', 'تصميم قواعد البيانات', 'تحديث الأنظمة القديمة'],
                ],
            ],
        ];

        foreach ($expertise as $item) {
            $id = DB::table('dev_expertise')->insertGetId([
                'image'      => $item['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            foreach (['en', 'ar'] as $locale) {
                DB::table('dev_expertise_translations')->insert([
                    'dev_expertise_id' => $id,
                    'locale'           => $locale,
                    'title'            => $item[$locale]['title'],
                    'description'      => $item[$locale]['description'],
                    'bullets'          => json_encode($item[$locale]['bullets'], JSON_UNESCAPED_UNICODE),
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
        }

        // ── Technologies ──────────────────────────────────────────────
        $technologies = [
            'React', 'Vue', 'Angular', 'Node.js', 'Java', 'Kotlin',
            'Flutter', 'AWS', 'Azure', 'MongoDB', 'PostgreSQL', 'Docker',
            '.NET Core', 'SQL Server', 'TypeScript', 'Python',
        ];

        foreach ($technologies as $tech) {
            DB::table('dev_technologies')->insert([
                'name'       => $tech,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ── Guarantees ────────────────────────────────────────────────
        $guarantees = [
            [
                'icon' => '🗓️',
                'en' => ['title' => 'On-Time Delivery',        'description' => 'We commit to agreed timelines and milestones. Every sprint is tracked and reported so you always know exactly where your project stands.'],
                'ar' => ['title' => 'التسليم في الموعد',       'description' => 'نلتزم بالجداول الزمنية والمعالم المتفق عليها. يتم تتبع كل سبرينت والإبلاغ عنه حتى تعرف دائماً أين يقف مشروعك.'],
            ],
            [
                'icon' => '💬',
                'en' => ['title' => 'Transparent Communication', 'description' => 'Dedicated project manager, weekly progress reports, and a shared dashboard — you are never left guessing about your project.'],
                'ar' => ['title' => 'التواصل الشفاف',           'description' => 'مدير مشروع مخصص وتقارير تقدم أسبوعية ولوحة تحكم مشتركة — لن تكون أبداً في حالة شك بشأن مشروعك.'],
            ],
            [
                'icon' => '🔧',
                'en' => ['title' => 'Post-Launch Support',      'description' => 'Our relationship does not end at launch. We provide 3 months of free support and flexible maintenance plans for every project.'],
                'ar' => ['title' => 'الدعم بعد الإطلاق',       'description' => 'لا تنتهي علاقتنا عند الإطلاق. نقدم 3 أشهر من الدعم المجاني وخطط صيانة مرنة لكل مشروع.'],
            ],
            [
                'icon' => '🔒',
                'en' => ['title' => 'NDA & Full Confidentiality', 'description' => 'Your ideas and business data are fully protected. We sign NDAs before any engagement and enforce strict data security policies.'],
                'ar' => ['title' => 'السرية التامة واتفاقية NDA', 'description' => 'أفكارك وبياناتك التجارية محمية بالكامل. نوقع اتفاقيات عدم الإفصاح قبل أي تعاون ونطبق سياسات أمان صارمة للبيانات.'],
            ],
        ];

        foreach ($guarantees as $item) {
            $id = DB::table('dev_guarantees')->insertGetId([
                'icon'       => $item['icon'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            foreach (['en', 'ar'] as $locale) {
                DB::table('dev_guarantee_translations')->insert([
                    'dev_guarantee_id' => $id,
                    'locale'           => $locale,
                    'title'            => $item[$locale]['title'],
                    'description'      => $item[$locale]['description'],
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
        }

        // ── Featured Projects ─────────────────────────────────────────
        $projects = [
            [
                'image' => '/assets/development/Image 1.png',
                'tech'  => 'React, Node.js, MongoDB',
                'en' => ['title' => 'E-commerce Platform Redesign', 'description' => 'A full-scale redesign of a retail platform, boosting conversion rates by 40% and reducing page load time by half.'],
                'ar' => ['title' => 'إعادة تصميم منصة التجارة الإلكترونية', 'description' => 'إعادة تصميم شاملة لمنصة بيع بالتجزئة، رفعت معدلات التحويل بنسبة 40% وخفضت وقت تحميل الصفحة إلى النصف.'],
            ],
            [
                'image' => '/assets/development/Image 2.png',
                'tech'  => 'Flutter, Node.js, PostgreSQL',
                'en' => ['title' => 'FinTech Mobile App', 'description' => 'A cross-platform financial app with real-time transaction tracking, biometric login, and bank-grade encryption.'],
                'ar' => ['title' => 'تطبيق المالية الرقمية', 'description' => 'تطبيق مالي متعدد المنصات مع تتبع المعاملات في الوقت الفعلي وتسجيل الدخول البيومتري وتشفير بمستوى بنكي.'],
            ],
            [
                'image' => '/assets/development/Image 3.png',
                'tech'  => 'React, Java, Azure',
                'en' => ['title' => 'Enterprise ERP System', 'description' => 'A fully customized ERP solution integrating HR, inventory, and finance modules for a 500-employee organization.'],
                'ar' => ['title' => 'نظام ERP للمؤسسات', 'description' => 'حل ERP مخصص بالكامل يدمج وحدات الموارد البشرية والمخزون والمالية لمنظمة من 500 موظف.'],
            ],
        ];

        foreach ($projects as $item) {
            $id = DB::table('dev_featured_projects')->insertGetId([
                'image'      => $item['image'],
                'tech'       => $item['tech'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            foreach (['en', 'ar'] as $locale) {
                DB::table('dev_featured_project_translations')->insert([
                    'dev_featured_project_id' => $id,
                    'locale'                  => $locale,
                    'title'                   => $item[$locale]['title'],
                    'description'             => $item[$locale]['description'],
                    'created_at'              => now(),
                    'updated_at'              => now(),
                ]);
            }
        }

        // ── Why Choose SNI (Development) ──────────────────────────────
        $whyItems = [
            [
                'image' => '/assets/development/why/4.png',
                'en' => ['title' => 'Seasoned Engineers',  'description' => 'Our team brings 8+ years of hands-on experience across enterprise, startup, and government projects — delivering solutions that scale.'],
                'ar' => ['title' => 'مهندسون متمرسون',    'description' => 'يتمتع فريقنا بأكثر من 8 سنوات من الخبرة العملية في مشاريع المؤسسات والشركات الناشئة والحكومية — يقدمون حلولاً قابلة للتوسع.'],
            ],
            [
                'image' => '/assets/development/why/5.png',
                'en' => ['title' => 'Agile Methodology',   'description' => 'We work in iterative sprints, adapting quickly to feedback and market changes so your product always stays aligned with your vision.'],
                'ar' => ['title' => 'منهجية رشيقة',        'description' => 'نعمل في سبرينتات تكرارية، نتكيف بسرعة مع التغذية الراجعة وتغيرات السوق حتى يظل منتجك متوافقاً دائماً مع رؤيتك.'],
            ],
            [
                'image' => '/assets/development/why/6.png',
                'en' => ['title' => 'Quality Assurance',   'description' => 'Every release goes through rigorous automated and manual testing. We ship only what meets our strict quality standards — no exceptions.'],
                'ar' => ['title' => 'ضمان الجودة',          'description' => 'يخضع كل إصدار لاختبارات آلية ويدوية صارمة. نشحن فقط ما يستوفي معايير الجودة الصارمة لدينا — بدون استثناءات.'],
            ],
        ];

        foreach ($whyItems as $item) {
            $id = DB::table('dev_why_items')->insertGetId([
                'image'      => $item['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            foreach (['en', 'ar'] as $locale) {
                DB::table('dev_why_item_translations')->insert([
                    'dev_why_item_id' => $id,
                    'locale'          => $locale,
                    'title'           => $item[$locale]['title'],
                    'description'     => $item[$locale]['description'],
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);
            }
        }
    }
}
