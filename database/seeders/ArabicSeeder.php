<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Updates all 'ar' locale translation rows with real Arabic content.
 * Run after the main DatabaseSeeder: php artisan db:seed --class=ArabicSeeder
 */
class ArabicSeeder extends Seeder
{
    public function run(): void
    {
        // ── Services ──────────────────────────────────────────────────
        $serviceAr = [
            'Enterprise Security' => [
                'title'       => 'أمن المؤسسات',
                'subtitle'    => 'حماية متعددة الطبقات لمواجهة التهديدات الحديثة.',
                'description' => 'حلول شاملة للكشف عن التهديدات وإدارة الجدران النارية وتأمين المؤسسات بالكامل.',
            ],
            'Network Infrastructure' => [
                'title'       => 'البنية التحتية للشبكات',
                'subtitle'    => 'شبكات عالية الأداء ومرنة مصممة للتوسع.',
                'description' => 'تصميم ونشر شبكات قابلة للتوسع وعالية الأداء لدعم عملياتك المتنامية.',
            ],
            'Cloud Solutions' => [
                'title'       => 'حلول السحابة',
                'subtitle'    => 'هجرة وتوسع وتحسين البنية التحتية السحابية.',
                'description' => 'هجرة السحابة الخاصة والعامة والأتمتة والإدارة للحفاظ على مرونة أعمالك.',
            ],
            'IT Consulting' => [
                'title'       => 'استشارات تقنية المعلومات',
                'subtitle'    => 'توجيه تقني استراتيجي يتوافق مع نمو الأعمال.',
                'description' => 'خرائط طريق تقنية استراتيجية وإرشادات التحول الرقمي مصممة وفق أهداف عملك.',
            ],
            'Data Management' => [
                'title'       => 'إدارة البيانات',
                'subtitle'    => 'تحويل البيانات الخام إلى معلومات موثوقة.',
                'description' => 'حلول التحليل والحوكمة وذكاء الأعمال التي تحول بياناتك إلى أصل استراتيجي.',
            ],
            'Smart Home Integration' => [
                'title'       => 'تكامل المنزل الذكي',
                'subtitle'    => 'كل جهاز، متصل بشكل مثالي.',
                'description' => 'أنظمة إضاءة ذكية ومناخية وأمنية وترفيهية متكاملة بالكامل ومتحكم بها صوتيًا.',
            ],
        ];

        $enServices = DB::table('service_translations')->where('locale', 'en')->get();
        foreach ($enServices as $enRow) {
            $ar = $serviceAr[$enRow->title] ?? null;
            if ($ar) {
                DB::table('service_translations')
                    ->where('service_id', $enRow->service_id)
                    ->where('locale', 'ar')
                    ->update([
                        'title'       => $ar['title'],
                        'subtitle'    => $ar['subtitle'],
                        'description' => $ar['description'],
                        'updated_at'  => now(),
                    ]);
            }
        }

        // ── Smart Features ────────────────────────────────────────────
        $featureAr = [
            'Smart Lighting'    => ['title' => 'إضاءة ذكية',       'subtitle' => 'تحكم في الإضاءة بالأوامر الصوتية والجداول الزمنية الآلية.'],
            'Security Systems'  => ['title' => 'أنظمة الأمن',      'subtitle' => 'أمان متقدم بكاميرات وحساسات الحركة والأقفال الذكية.'],
            'Climate Control'   => ['title' => 'التحكم في المناخ', 'subtitle' => 'منظمات حرارة ذكية لأقصى راحة وكفاءة في استهلاك الطاقة.'],
            'Entertainment'     => ['title' => 'الترفيه',          'subtitle' => 'أنظمة صوت ومرئيات متكاملة لتجربة ترفيهية منزلية غامرة.'],
            'Automation'        => ['title' => 'الأتمتة',          'subtitle' => 'أتمتة الروتين والمهام اليومية وعمليات الأجهزة.'],
            'Energy Management' => ['title' => 'إدارة الطاقة',     'subtitle' => 'مراقبة استهلاك الطاقة وتحسينه لتوفير التكاليف.'],
        ];

        $enFeatures = DB::table('smart_feature_translations')->where('locale', 'en')->get();
        foreach ($enFeatures as $enRow) {
            $ar = $featureAr[$enRow->title] ?? null;
            if ($ar) {
                DB::table('smart_feature_translations')
                    ->where('smart_feature_id', $enRow->smart_feature_id)
                    ->where('locale', 'ar')
                    ->update(['title' => $ar['title'], 'subtitle' => $ar['subtitle'], 'updated_at' => now()]);
            }
        }

        // ── Smart Benefits ────────────────────────────────────────────
        $benefitAr = [
            'Convenience' => ['title' => 'الراحة',  'subtitle' => 'تحكم سهل في بيئة منزلك من أي مكان وفي أي وقت.'],
            'Security'    => ['title' => 'الأمان',  'subtitle' => 'راحة بال محسّنة مع مراقبة على مدار الساعة والتحكم الذكي في الوصول.'],
            'Efficiency'  => ['title' => 'الكفاءة', 'subtitle' => 'تحسين استهلاك الطاقة وتقليل فواتير المرافق والمساهمة في كوكب أخضر.'],
        ];

        $enBenefits = DB::table('smart_benefit_translations')->where('locale', 'en')->get();
        foreach ($enBenefits as $enRow) {
            $ar = $benefitAr[$enRow->title] ?? null;
            if ($ar) {
                DB::table('smart_benefit_translations')
                    ->where('smart_benefit_id', $enRow->smart_benefit_id)
                    ->where('locale', 'ar')
                    ->update(['title' => $ar['title'], 'subtitle' => $ar['subtitle'], 'updated_at' => now()]);
            }
        }

        // ── Projects ──────────────────────────────────────────────────
        $projectAr = [
            'Luxury Smart Home Integration' => [
                'name'        => 'تكامل المنزل الذكي الفاخر',
                'description' => 'نظام منزل ذكي متكامل لعقار فاخر تبلغ مساحته 10,000 قدم مربع.',
            ],
            'Enterprise Network Security' => [
                'name'        => 'أمن شبكات المؤسسات',
                'description' => 'تطبيق بروتوكولات أمان شبكة قوية عبر مواقع متعددة.',
            ],
            'E-commerce Platform' => [
                'name'        => 'منصة التجارة الإلكترونية',
                'description' => 'تطوير منصة تجارة إلكترونية قابلة للتوسع مع بوابات دفع سلسة.',
            ],
            'Healthcare Mobile App' => [
                'name'        => 'تطبيق الرعاية الصحية للهاتف المحمول',
                'description' => 'إنشاء تطبيق هاتفي موجه للمريض لحجز المواعيد وسجلات الصحة.',
            ],
            'Smart Office Automation' => [
                'name'        => 'أتمتة المكاتب الذكية',
                'description' => 'تطبيق أتمتة ذكية لتحسين كفاءة المكتب.',
            ],
            'Cloud Migration Project' => [
                'name'        => 'مشروع الترحيل السحابي',
                'description' => 'ترحيل سلس للأنظمة القديمة إلى بنية تحتية سحابية آمنة.',
            ],
        ];

        $enProjects = DB::table('project_translations')->where('locale', 'en')->get();
        foreach ($enProjects as $enRow) {
            $ar = $projectAr[$enRow->name] ?? null;
            if ($ar) {
                DB::table('project_translations')
                    ->where('project_id', $enRow->project_id)
                    ->where('locale', 'ar')
                    ->update(['name' => $ar['name'], 'description' => $ar['description'], 'updated_at' => now()]);
            }
        }

        // ── Challenges ────────────────────────────────────────────────
        $challengeAr = [
            'Luxury Smart Home Integration' => [
                'title'       => 'تكامل المنزل الذكي الفاخر',
                'challenge'   => 'دمج أنظمة معقدة في عقار كبير',
                'solution'    => 'بنية منزل ذكي مخصصة',
                'result'      => 'توفير 40% في الطاقة، وقت تشغيل 99.9%',
                'description' => 'حوّل SNI تجربتنا المنزلية بأتمتة سلسة.',
            ],
            'Enterprise Network Security' => [
                'title'       => 'أمن شبكات المؤسسات',
                'challenge'   => 'تأمين شبكة عالمية ضد التهديدات الإلكترونية.',
                'solution'    => 'تطبيق أمان متعدد الطبقات',
                'result'      => 'صفر اختراقات، تأمين أكثر من 500 جهاز',
                'description' => 'شبكتنا الآن محصّنة بفضل خبرة SNI.',
            ],
            'E-commerce Platform' => [
                'title'       => 'منصة التجارة الإلكترونية',
                'challenge'   => 'بناء متجر إلكتروني عالي الزيارات.',
                'solution'    => 'منصة سحابية قابلة للتوسع.',
                'result'      => 'زيادة المبيعات بنسبة 300%، 50,000 مستخدم',
                'description' => 'تضاعفت مبيعاتنا عبر الإنترنت منذ إطلاق المنصة الجديدة.',
            ],
        ];

        $enChallenges = DB::table('challenge_translations')->where('locale', 'en')->get();
        foreach ($enChallenges as $enRow) {
            $ar = $challengeAr[$enRow->title] ?? null;
            if ($ar) {
                DB::table('challenge_translations')
                    ->where('challenge_id', $enRow->challenge_id)
                    ->where('locale', 'ar')
                    ->update([
                        'title'       => $ar['title'],
                        'challenge'   => $ar['challenge'],
                        'solution'    => $ar['solution'],
                        'result'      => $ar['result'],
                        'description' => $ar['description'],
                        'updated_at'  => now(),
                    ]);
            }
        }

        // ── FAQs ──────────────────────────────────────────────────────
        $faqAr = [
            'What services does SNI offer?' => [
                'question' => 'ما هي الخدمات التي تقدمها SNI؟',
                'answer'   => 'تقدم SNI خدمات أمن المؤسسات، والبنية التحتية للشبكات، وحلول السحابة، واستشارات تقنية المعلومات، وإدارة البيانات، وتكامل المنزل الذكي، وتطوير التطبيقات والمواقع.',
            ],
            'Do you provide 24/7 support?' => [
                'question' => 'هل تقدمون دعمًا على مدار الساعة؟',
                'answer'   => 'نعم، نوفر دعمًا على مدار الساعة لجميع عملائنا من المؤسسات مع فرق دعم مخصصة.',
            ],
            'How long does a typical project take?' => [
                'question' => 'كم يستغرق المشروع النموذجي؟',
                'answer'   => 'تتفاوت الجداول الزمنية للمشاريع حسب النطاق والتعقيد. تتراوح معظم المشاريع بين 4-12 أسبوعًا.',
            ],
            'Do you offer free consultations?' => [
                'question' => 'هل تقدمون استشارات مجانية؟',
                'answer'   => 'نعم، نقدم استشارات أولية مجانية لفهم احتياجاتكم وتقديم توصيات مخصصة.',
            ],
        ];

        $enFaqs = DB::table('faq_translations')->where('locale', 'en')->get();
        foreach ($enFaqs as $enRow) {
            $ar = $faqAr[$enRow->question] ?? null;
            if ($ar) {
                DB::table('faq_translations')
                    ->where('faq_id', $enRow->faq_id)
                    ->where('locale', 'ar')
                    ->update(['question' => $ar['question'], 'answer' => $ar['answer'], 'updated_at' => now()]);
            }
        }

        // ── About ─────────────────────────────────────────────────────
        DB::table('about_translations')
            ->where('locale', 'ar')
            ->update([
                'title'       => 'عن SNI',
                'description' => 'في شركة Secure Net Innovation، نلتزم بتقديم حلول تقنية مستدامة وشاملة. نسعى إلى تمكين الشركات بأحدث الحلول التقنية التي تدفع النمو وتعزز الكفاءة. تأسست SNI برؤية لسد الفجوة بين التكنولوجيا المعقدة واحتياجات الأعمال، ونمت لتصبح شريكًا موثوقًا للشركات حول العالم.',
                'updated_at'  => now(),
            ]);

        // ── Location (Address) ────────────────────────────────────────
        DB::table('location_translations')
            ->where('locale', 'ar')
            ->update([
                'address'    => '111 غريت ويسترن ستريت، كوينز، نيويورك 75100',
                'updated_at' => now(),
            ]);
    }
}
