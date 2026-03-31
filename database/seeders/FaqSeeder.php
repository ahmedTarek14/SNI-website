<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What services does SNI offer?',
                'answer'   => 'SNI offers Enterprise Security, Network Infrastructure, Cloud Solutions, IT Consulting, Data Management, Smart Home Integration, and App & Web Development.',
            ],
            [
                'question' => 'Do you provide 24/7 support?',
                'answer'   => 'Yes, we provide round-the-clock support for all our enterprise clients with dedicated support teams.',
            ],
            [
                'question' => 'How long does a typical project take?',
                'answer'   => 'Project timelines vary based on scope and complexity. Most projects range from 4-12 weeks.',
            ],
            [
                'question' => 'Do you offer free consultations?',
                'answer'   => 'Yes, we offer free initial consultations to understand your needs and provide tailored recommendations.',
            ],
        ];

        foreach ($faqs as $faqData) {
            $faqId = DB::table('faqs')->insertGetId([
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach (['en', 'ar'] as $locale) {
                DB::table('faq_translations')->insert([
                    'faq_id'     => $faqId,
                    'locale'     => $locale,
                    'question'   => $faqData['question'],
                    'answer'     => $faqData['answer'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
