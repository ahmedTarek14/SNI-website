<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Project\Models\Category;
use Modules\Sni\Models\Review;

class CategoryReviewTranslationSeeder extends Seeder
{
    public function run(): void
    {
        // ── Categories ────────────────────────────────────────────────────────
        $categoryMap = [
            'Smart Home'   => 'المنزل الذكي',
            'IT Solutions' => 'حلول تكنولوجيا المعلومات',
            'Cloud'        => 'السحابة',
            'Automation'   => 'الأتمتة',
            'Web Dev'      => 'تطوير الويب',
            'App Dev'      => 'تطوير التطبيقات',
            'Security'     => 'الأمن',
        ];

        $rawCategories = DB::table('categories')->get();
        foreach ($rawCategories as $raw) {
            $category = Category::find($raw->id);

            $en = $category->translateOrNew('en');
            $en->name = $raw->name;
            $en->save();

            $arName = $categoryMap[$raw->name] ?? null;
            if ($arName) {
                $ar = $category->translateOrNew('ar');
                $ar->name = $arName;
                $ar->save();
            }
        }

        // ── Reviews ───────────────────────────────────────────────────────────
        $reviewMap = [
            "The team at SNI is exceptional! Their project delivery is flawless."
                => 'فريق SNI استثنائي! تسليم مشاريعهم لا تشوبه شائبة.',
            "We rely on SNI for all our security needs. Highly recommended."
                => 'نعتمد على SNI لجميع احتياجاتنا الأمنية. موصى به بشدة.',
            "Their innovative solutions have optimized our operations significantly."
                => 'حلولهم المبتكرة حسّنت عملياتنا بشكل ملحوظ.',
            "The energy savings and convenience have exceeded our expectations. SNI truly understands smart home technology."
                => 'وفورات الطاقة والراحة تجاوزت توقعاتنا. SNI تفهم حقاً تقنية المنزل الذكي.',
            "We feel much more secure and comfortable in our home thanks to SNI advanced solutions."
                => 'نشعر بأمان وراحة أكبر في منزلنا بفضل الحلول المتقدمة من SNI.',
            "SNI smart home system transformed our living experience. The integration is seamless, and the support is exceptional."
                => 'نظام المنزل الذكي من SNI حوّل تجربة معيشتنا. التكامل سلس والدعم استثنائي.',
        ];

        $rawReviews = DB::table('reviews')->get();
        foreach ($rawReviews as $raw) {
            $review = Review::find($raw->id);

            $en = $review->translateOrNew('en');
            $en->message = $raw->message;
            $en->save();

            $arMessage = $reviewMap[$raw->message] ?? null;
            if ($arMessage) {
                $ar = $review->translateOrNew('ar');
                $ar->message = $arMessage;
                $ar->save();
            }
        }

        $this->command->info('CategoryReviewTranslationSeeder: categories and reviews translated to AR.');
    }
}
