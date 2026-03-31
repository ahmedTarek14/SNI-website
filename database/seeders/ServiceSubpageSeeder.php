<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Service\Models\ServiceFeature;
use Modules\Service\Models\ServiceFeatureTranslation;
use Modules\Service\Models\ServiceProcess;
use Modules\Service\Models\ServiceProcessTranslation;
use Modules\Service\Models\Service;

class ServiceSubpageSeeder extends Seeder
{
    private array $features = [
        'enterprise-security' => [
            ['icon' => '/assets/icons/security.png', 'en' => ['title' => 'Threat Detection & Response',   'description' => 'AI-powered real-time monitoring that identifies and neutralizes attacks before they escalate. Average detection time under 15 minutes.'], 'ar' => ['title' => 'كشف التهديدات والاستجابة',       'description' => 'مراقبة فورية مدعومة بالذكاء الاصطناعي تحدد الهجمات وتحيّدها قبل أن تتصاعد. متوسط وقت الكشف أقل من 15 دقيقة.']],
            ['icon' => '/assets/icons/Enterprise.png','en' => ['title' => 'Next-Gen Firewall',             'description' => 'Deep packet inspection, application-layer filtering, and automated policy enforcement guarding every entry point.'],               'ar' => ['title' => 'جدار الحماية من الجيل التالي',   'description' => 'فحص عميق للحزم وتصفية على مستوى التطبيق وتطبيق تلقائي للسياسات يحرس كل نقطة دخول.']],
            ['icon' => '/assets/icons/CLOUD.png',     'en' => ['title' => 'Endpoint Protection',           'description' => 'Zero-trust security for every device on your network — laptops, servers, IoT, and mobile endpoints.'],                           'ar' => ['title' => 'حماية نقاط النهاية',              'description' => 'أمن صفري الثقة لكل جهاز على شبكتك — أجهزة كمبيوتر محمولة وخوادم وإنترنت الأشياء والأجهزة المحمولة.']],
            ['icon' => '/assets/icons/Network.png',   'en' => ['title' => 'SIEM & Log Management',         'description' => 'Centralized security event correlation with real-time alerting, dashboards, and forensic-grade audit trails.'],                 'ar' => ['title' => 'SIEM وإدارة السجلات',             'description' => 'ربط مركزي لأحداث الأمن مع تنبيه فوري ولوحات تحكم ومسارات تدقيق بجودة جنائية.']],
            ['icon' => '/assets/icons/security.png',  'en' => ['title' => 'Penetration Testing',           'description' => 'Controlled ethical hacking that exposes vulnerabilities in your systems before real attackers can find them.'],                 'ar' => ['title' => 'اختبار الاختراق',                 'description' => 'قرصنة أخلاقية خاضعة للسيطرة تكشف الثغرات في أنظمتك قبل أن يجدها المهاجمون الحقيقيون.']],
            ['icon' => '/assets/icons/Enterprise.png','en' => ['title' => 'Compliance & Auditing',         'description' => 'Full support for ISO 27001, GDPR, HIPAA, PCI-DSS, and SOC 2 audits — documentation included.'],                               'ar' => ['title' => 'الامتثال والتدقيق',               'description' => 'دعم كامل لتدقيقات ISO 27001 وGDPR وHIPAA وPCI-DSS وSOC 2 — مع التوثيق.']],
        ],
        'network-infrastructure' => [
            ['icon' => '/assets/icons/Network.png',   'en' => ['title' => 'Network Design & Architecture', 'description' => 'Custom LAN/WAN topology designed around your business workflows, traffic patterns, and redundancy requirements.'],               'ar' => ['title' => 'تصميم الشبكة والهندسة المعمارية', 'description' => 'طوبولوجيا LAN/WAN مخصصة مصممة حول سير عمل أعمالك وأنماط حركة المرور ومتطلبات التكرار.']],
            ['icon' => '/assets/icons/CLOUD.png',     'en' => ['title' => 'SD-WAN Deployment',             'description' => 'Software-defined networking that intelligently routes traffic, reduces WAN costs, and improves application performance.'],       'ar' => ['title' => 'نشر SD-WAN',                      'description' => 'شبكة معرّفة بالبرمجيات توجه حركة المرور بذكاء وتقلل تكاليف WAN وتحسن أداء التطبيقات.']],
            ['icon' => '/assets/icons/security.png',  'en' => ['title' => 'Network Security Integration',  'description' => 'VLAN segmentation, access control lists, and zero-trust microsegmentation baked into every design.'],                          'ar' => ['title' => 'تكامل أمن الشبكة',                'description' => 'تجزئة VLAN وقوائم التحكم في الوصول وتجزئة دقيقة بدون ثقة مدمجة في كل تصميم.']],
            ['icon' => '/assets/icons/Enterprise.png','en' => ['title' => '24/7 Network Monitoring',       'description' => 'Proactive NOC monitoring that detects and resolves issues — often before users even notice them.'],                              'ar' => ['title' => 'مراقبة الشبكة على مدار الساعة',   'description' => 'مراقبة استباقية لمركز عمليات الشبكة تكتشف المشاكل وتحلها — غالباً قبل أن يلاحظها المستخدمون.']],
            ['icon' => '/assets/icons/Network.png',   'en' => ['title' => 'Bandwidth Optimization',        'description' => 'QoS policies and traffic shaping that prioritize critical applications and eliminate congestion.'],                             'ar' => ['title' => 'تحسين عرض النطاق الترددي',        'description' => 'سياسات جودة الخدمة وتشكيل حركة المرور التي تعطي الأولوية للتطبيقات الحرجة وتزيل الاختناقات.']],
            ['icon' => '/assets/icons/CLOUD.png',     'en' => ['title' => 'Disaster Recovery & Redundancy','description' => 'Failover designs, redundant links, and tested DR plans that keep you online when hardware fails.'],                             'ar' => ['title' => 'التعافي من الكوارث والتكرار',     'description' => 'تصاميم تجاوز الفشل والروابط المتكررة وخطط DR المختبرة التي تبقيك متصلاً عند فشل الأجهزة.']],
        ],
        'cloud-solutions' => [
            ['icon' => '/assets/icons/CLOUD.png',     'en' => ['title' => 'Cloud Migration',          'description' => 'Lift-and-shift or full re-architecting — we plan and execute migrations with zero data loss and minimal downtime.'],      'ar' => ['title' => 'هجرة السحابة',            'description' => 'رفع ونقل أو إعادة هندسة كاملة — نخطط ونفذ عمليات الهجرة بدون فقدان بيانات وأقل توقف.']],
            ['icon' => '/assets/icons/Enterprise.png','en' => ['title' => 'Multi-Cloud Management',   'description' => 'Unified management across AWS, Azure, and GCP with cost allocation, governance, and performance dashboards.'],            'ar' => ['title' => 'إدارة السحابة المتعددة',  'description' => 'إدارة موحدة عبر AWS وAzure وGCP مع توزيع التكاليف والحوكمة ولوحات الأداء.']],
            ['icon' => '/assets/icons/security.png',  'en' => ['title' => 'Cloud Security',           'description' => 'Identity management, encryption-at-rest, secrets management, and continuous compliance monitoring.'],                    'ar' => ['title' => 'أمن السحابة',             'description' => 'إدارة الهوية والتشفير في حالة السكون وإدارة الأسرار ومراقبة الامتثال المستمرة.']],
            ['icon' => '/assets/icons/CLOUD.png',     'en' => ['title' => 'Cost Optimization',        'description' => 'Right-sizing, reserved instance planning, and automated scaling that can cut your cloud bill by 20–35%.'],               'ar' => ['title' => 'تحسين التكاليف',          'description' => 'تحجيم صحيح وتخطيط المثيلات المحجوزة والتوسع التلقائي الذي يمكنه خفض فاتورة السحابة بنسبة 20-35%.']],
            ['icon' => '/assets/icons/Network.png',   'en' => ['title' => 'Hybrid Cloud Architecture','description' => 'Seamlessly connect on-premises systems to cloud workloads with secure, low-latency connectivity.'],                      'ar' => ['title' => 'بنية السحابة الهجينة',    'description' => 'توصيل سلس للأنظمة المحلية بأحمال العمل السحابية مع اتصال آمن وذو تأخير منخفض.']],
            ['icon' => '/assets/icons/Enterprise.png','en' => ['title' => 'Managed Cloud Services',   'description' => 'Full managed operations: patching, backups, monitoring, incident response, and monthly reporting.'],                     'ar' => ['title' => 'خدمات السحابة المُدارة',  'description' => 'عمليات مُدارة بالكامل: التصحيح والنسخ الاحتياطي والمراقبة والاستجابة للحوادث والتقارير الشهرية.']],
        ],
        'it-consulting' => [
            ['icon' => '/assets/icons/Enterprise.png','en' => ['title' => 'Digital Transformation',    'description' => 'End-to-end transformation programs that modernize operations, eliminate manual processes, and create measurable competitive advantage.'], 'ar' => ['title' => 'التحول الرقمي',                             'description' => 'برامج تحول شاملة تحدّث العمليات وتزيل العمليات اليدوية وتخلق ميزة تنافسية قابلة للقياس.']],
            ['icon' => '/assets/icons/Network.png',   'en' => ['title' => 'Technology Roadmapping',    'description' => '12–36 month IT roadmaps with prioritized initiatives, budget forecasts, and milestone tracking.'],                                       'ar' => ['title' => 'رسم خارطة طريق التكنولوجيا',               'description' => 'خرائط طريق لتكنولوجيا المعلومات من 12 إلى 36 شهراً مع مبادرات ذات أولوية وتوقعات الميزانية وتتبع المعالم.']],
            ['icon' => '/assets/icons/CLOUD.png',     'en' => ['title' => 'IT Strategy & Governance',  'description' => 'Formal IT governance frameworks, policy documentation, and steering committee support for growing organizations.'],                     'ar' => ['title' => 'استراتيجية تكنولوجيا المعلومات والحوكمة', 'description' => 'أطر حوكمة رسمية لتكنولوجيا المعلومات وتوثيق السياسات ودعم لجان التوجيه للمؤسسات النامية.']],
            ['icon' => '/assets/icons/security.png',  'en' => ['title' => 'Vendor Management',         'description' => 'Vendor selection, contract negotiation, SLA management, and ongoing performance reviews.'],                                             'ar' => ['title' => 'إدارة الموردين',                           'description' => 'اختيار الموردين والتفاوض على العقود وإدارة اتفاقيات مستوى الخدمة ومراجعات الأداء الدورية.']],
            ['icon' => '/assets/icons/Enterprise.png','en' => ['title' => 'Risk Assessment',           'description' => 'Comprehensive IT risk assessments with remediation priorities and executive-ready reporting.'],                                          'ar' => ['title' => 'تقييم المخاطر',                            'description' => 'تقييمات شاملة لمخاطر تكنولوجيا المعلومات مع أولويات المعالجة وتقارير جاهزة للمديرين التنفيذيين.']],
            ['icon' => '/assets/icons/Network.png',   'en' => ['title' => 'Compliance Consulting',     'description' => 'Gap analysis and remediation planning for ISO 27001, SOC 2, HIPAA, PCI-DSS, and GDPR.'],                                               'ar' => ['title' => 'استشارات الامتثال',                        'description' => 'تحليل الفجوات وتخطيط المعالجة لـ ISO 27001 وSOC 2 وHIPAA وPCI-DSS وGDPR.']],
        ],
        'data-management' => [
            ['icon' => '/assets/icons/CLOUD.png',     'en' => ['title' => 'Data Architecture & Integration',   'description' => 'Modern data platforms — data lakes, warehouses, and lakehouses — with reliable ETL pipelines that consolidate all your sources.'], 'ar' => ['title' => 'هندسة البيانات والتكامل',         'description' => 'منصات بيانات حديثة — بحيرات بيانات ومستودعات وlakehouses — مع خطوط أنابيب ETL موثوقة تدمج جميع مصادرك.']],
            ['icon' => '/assets/icons/Enterprise.png','en' => ['title' => 'Business Intelligence & Analytics', 'description' => 'Interactive dashboards and self-serve analytics that give every team access to the metrics that matter.'],                          'ar' => ['title' => 'ذكاء الأعمال والتحليلات',         'description' => 'لوحات معلومات تفاعلية وتحليلات ذاتية الخدمة تمنح كل فريق وصولاً للمقاييس المهمة.']],
            ['icon' => '/assets/icons/security.png',  'en' => ['title' => 'Data Governance',                  'description' => 'Policies, ownership frameworks, and quality controls that ensure your data is accurate, consistent, and trusted.'],               'ar' => ['title' => 'حوكمة البيانات',                  'description' => 'سياسات وأطر الملكية وضوابط الجودة التي تضمن دقة بياناتك واتساقها والوثوق بها.']],
            ['icon' => '/assets/icons/Network.png',   'en' => ['title' => 'Database Administration',          'description' => 'Managed DBA services for SQL, NoSQL, and cloud-native databases — performance tuning, indexing, and capacity planning.'],         'ar' => ['title' => 'إدارة قواعد البيانات',            'description' => 'خدمات DBA مُدارة لقواعد بيانات SQL وNoSQL والسحابة الأصلية — ضبط الأداء والفهرسة وتخطيط السعة.']],
            ['icon' => '/assets/icons/CLOUD.png',     'en' => ['title' => 'Backup & Disaster Recovery',       'description' => 'Automated backup strategies with tested recovery procedures and RPO/RTO SLAs that protect your critical data.'],                    'ar' => ['title' => 'النسخ الاحتياطي والتعافي من الكوارث', 'description' => 'استراتيجيات نسخ احتياطي تلقائي مع إجراءات استرداد مختبرة واتفاقيات مستوى خدمة RPO/RTO تحمي بياناتك الحرجة.']],
            ['icon' => '/assets/icons/Enterprise.png','en' => ['title' => 'Data Security & Compliance',       'description' => 'Encryption, masking, access controls, and audit logging to meet GDPR, HIPAA, and SOC 2 data requirements.'],                       'ar' => ['title' => 'أمن البيانات والامتثال',          'description' => 'التشفير والإخفاء وضوابط الوصول وتسجيل التدقيق لتلبية متطلبات بيانات GDPR وHIPAA وSOC 2.']],
        ],
        'smart-home-integration' => [
            ['icon' => '/assets/icons/Lighting.png',      'en' => ['title' => 'Intelligent Lighting',    'description' => 'Scene-based lighting control, circadian rhythm automation, and voice/app control for every fixture in your home.'],                'ar' => ['title' => 'الإضاءة الذكية',       'description' => 'تحكم بالإضاءة قائم على المشاهد وأتمتة الإيقاع اليومي والتحكم الصوتي/عبر التطبيق لكل تجهيز في منزلك.']],
            ['icon' => '/assets/icons/Climate.png',       'en' => ['title' => 'Climate Control',         'description' => 'Smart thermostats and zoned HVAC management that learn your schedule and optimize comfort and energy use.'],                        'ar' => ['title' => 'التحكم في المناخ',      'description' => 'منظمات حرارة ذكية وإدارة HVAC منطقية تتعلم جدولك وتحسن الراحة واستخدام الطاقة.']],
            ['icon' => '/assets/icons/security.png',      'en' => ['title' => 'Security & Access',       'description' => 'Smart locks, facial recognition cameras, motion sensors, and 24/7 monitoring integrated into one platform.'],                      'ar' => ['title' => 'الأمن والدخول',         'description' => 'أقفال ذكية وكاميرات بتعرف الوجه وأجهزة استشعار الحركة ومراقبة على مدار الساعة مدمجة في منصة واحدة.']],
            ['icon' => '/assets/icons/entertainment.png', 'en' => ['title' => 'Home Entertainment',      'description' => 'Multi-room audio/video systems, home theaters, and streaming integrations — all controllable from a single app.'],                 'ar' => ['title' => 'الترفيه المنزلي',       'description' => 'أنظمة صوت/فيديو متعددة الغرف ومسارح منزلية وتكاملات البث — كلها قابلة للتحكم من تطبيق واحد.']],
            ['icon' => '/assets/icons/Enterprise.png',    'en' => ['title' => 'Energy Management',       'description' => 'Real-time energy monitoring, solar integration, and automated schedules that can cut energy bills by up to 40%.'],                  'ar' => ['title' => 'إدارة الطاقة',          'description' => 'مراقبة الطاقة في الوقت الحقيقي وتكامل الطاقة الشمسية والجداول الآلية التي يمكنها خفض فواتير الطاقة بنسبة 40%.']],
            ['icon' => '/assets/icons/Network.png',       'en' => ['title' => 'Whole-Home Networking',   'description' => 'Enterprise-grade Wi-Fi 6 mesh networks designed specifically for high-device-count smart homes.'],                                  'ar' => ['title' => 'الشبكة المنزلية الشاملة', 'description' => 'شبكات Wi-Fi 6 mesh بمستوى مؤسسي مصممة خصيصاً للمنازل الذكية ذات الأجهزة الكثيرة.']],
        ],
    ];

    private array $processes = [
        'enterprise-security' => [
            ['num' => '01', 'en' => ['title' => 'Security Audit',    'description' => 'We assess your current posture, map attack surfaces, and identify critical vulnerabilities.'],                                              'ar' => ['title' => 'تدقيق الأمن',             'description' => 'نقيّم وضعك الحالي ونرسم خرائط سطح الهجوم ونحدد الثغرات الحرجة.']],
            ['num' => '02', 'en' => ['title' => 'Strategy Design',   'description' => 'We architect a custom security framework aligned to your industry, size, and risk tolerance.'],                                            'ar' => ['title' => 'تصميم الاستراتيجية',      'description' => 'نبني إطار أمني مخصصاً يتوافق مع قطاعك وحجمك وتحملك للمخاطر.']],
            ['num' => '03', 'en' => ['title' => 'Implementation',    'description' => 'Our team deploys, configures, and integrates every security layer across your infrastructure.'],                                           'ar' => ['title' => 'التنفيذ',                  'description' => 'ينشر فريقنا ويضبط ويدمج كل طبقة أمنية عبر بنيتك التحتية.']],
            ['num' => '04', 'en' => ['title' => '24/7 Monitoring',   'description' => 'Round-the-clock SOC coverage with monthly reporting, patch management, and incident response.'],                                          'ar' => ['title' => 'المراقبة على مدار الساعة', 'description' => 'تغطية مركز العمليات الأمنية على مدار الساعة مع تقارير شهرية وإدارة التصحيحات والاستجابة للحوادث.']],
        ],
        'network-infrastructure' => [
            ['num' => '01', 'en' => ['title' => 'Discovery & Assessment', 'description' => 'We audit your current network, map traffic flows, and identify performance bottlenecks.'],                                            'ar' => ['title' => 'الاكتشاف والتقييم',       'description' => 'نراجع شبكتك الحالية ونرسم خرائط تدفق حركة المرور ونحدد اختناقات الأداء.']],
            ['num' => '02', 'en' => ['title' => 'Architecture Design',    'description' => 'We deliver a detailed network design with hardware specs, topology diagrams, and cost breakdown.'],                                   'ar' => ['title' => 'تصميم البنية المعمارية',   'description' => 'نقدم تصميم شبكة مفصلاً مع مواصفات الأجهزة ومخططات الطوبولوجيا وتفاصيل التكاليف.']],
            ['num' => '03', 'en' => ['title' => 'Deployment',             'description' => 'Our certified engineers install, configure, and test every component with zero-downtime strategies.'],                               'ar' => ['title' => 'النشر',                    'description' => 'يثبت مهندسونا المعتمدون ويضبطون ويختبرون كل مكون باستراتيجيات توقف صفري.']],
            ['num' => '04', 'en' => ['title' => 'Managed Operations',     'description' => 'Ongoing NOC monitoring, firmware updates, and capacity planning to keep the network optimized.'],                                    'ar' => ['title' => 'العمليات المُدارة',         'description' => 'مراقبة مستمرة لمركز عمليات الشبكة وتحديثات البرامج الثابتة وتخطيط السعة للحفاظ على تحسين الشبكة.']],
        ],
        'cloud-solutions' => [
            ['num' => '01', 'en' => ['title' => 'Cloud Readiness Assessment', 'description' => 'We evaluate your workloads, dependencies, and constraints to build an optimized migration strategy.'],                           'ar' => ['title' => 'تقييم جاهزية السحابة',    'description' => 'نقيّم أحمال عملك وتبعياتك وقيودك لبناء استراتيجية هجرة محسّنة.']],
            ['num' => '02', 'en' => ['title' => 'Architecture & Planning',    'description' => 'We design your target cloud architecture with security, scalability, and cost-efficiency as first principles.'],                 'ar' => ['title' => 'البنية المعمارية والتخطيط', 'description' => 'نصمم بنيتك السحابية المستهدفة مع الأمن والقابلية للتوسع وكفاءة التكلفة كمبادئ أساسية.']],
            ['num' => '03', 'en' => ['title' => 'Migration & Deployment',     'description' => 'Phased migration execution with parallel testing, rollback plans, and zero-disruption cutover.'],                               'ar' => ['title' => 'الهجرة والنشر',            'description' => 'تنفيذ هجرة مرحلية مع اختبار متوازٍ وخطط التراجع وانتقال بدون انقطاع.']],
            ['num' => '04', 'en' => ['title' => 'Managed Operations',         'description' => 'Ongoing cloud management, cost reporting, security audits, and continuous optimization.'],                                       'ar' => ['title' => 'العمليات المُدارة',          'description' => 'إدارة سحابية مستمرة وتقارير التكاليف وعمليات تدقيق الأمن والتحسين المستمر.']],
        ],
        'it-consulting' => [
            ['num' => '01', 'en' => ['title' => 'Business Discovery',           'description' => 'We interview stakeholders, review your current systems, and understand your goals and pain points.'],                          'ar' => ['title' => 'اكتشاف الأعمال',           'description' => 'نجري مقابلات مع أصحاب المصلحة ونراجع أنظمتك الحالية ونفهم أهدافك ونقاط ألمك.']],
            ['num' => '02', 'en' => ['title' => 'Analysis & Benchmarking',      'description' => 'We benchmark your IT maturity against industry standards and identify the highest-impact opportunities.'],                      'ar' => ['title' => 'التحليل والمعايرة',         'description' => 'نقيس نضج تكنولوجيا المعلومات لديك مقابل معايير الصناعة ونحدد أعلى الفرص تأثيراً.']],
            ['num' => '03', 'en' => ['title' => 'Roadmap Delivery',             'description' => 'We present a prioritized, costed roadmap with quick wins and long-term strategic initiatives.'],                               'ar' => ['title' => 'تسليم خارطة الطريق',       'description' => 'نقدم خارطة طريق ذات أولويات وتكاليف مع مكاسب سريعة ومبادرات استراتيجية طويلة المدى.']],
            ['num' => '04', 'en' => ['title' => 'Advisory & Execution Support', 'description' => 'Ongoing advisory retainers available to guide implementation, manage vendors, and adapt the strategy.'],                      'ar' => ['title' => 'الدعم الاستشاري والتنفيذي', 'description' => 'استشارات متكررة متاحة لتوجيه التنفيذ وإدارة الموردين وتكييف الاستراتيجية.']],
        ],
        'data-management' => [
            ['num' => '01', 'en' => ['title' => 'Data Audit',         'description' => 'We catalog your existing data sources, assess data quality, and map dependencies across systems.'],                                      'ar' => ['title' => 'تدقيق البيانات',           'description' => 'نفهرس مصادر بياناتك الموجودة ونقيّم جودة البيانات ونرسم خرائط التبعيات عبر الأنظمة.']],
            ['num' => '02', 'en' => ['title' => 'Architecture Design','description' => 'We design a scalable data platform tailored to your reporting needs, tools, and team capabilities.'],                                    'ar' => ['title' => 'تصميم البنية المعمارية',    'description' => 'نصمم منصة بيانات قابلة للتوسع مخصصة لاحتياجات إعداد التقارير والأدوات وقدرات الفريق.']],
            ['num' => '03', 'en' => ['title' => 'Build & Integrate',  'description' => 'We build your data pipelines, warehouse, and BI layer — integrating with your existing applications.'],                                  'ar' => ['title' => 'البناء والتكامل',           'description' => 'نبني خطوط أنابيب البيانات والمستودع وطبقة BI — مع التكامل مع تطبيقاتك الموجودة.']],
            ['num' => '04', 'en' => ['title' => 'Govern & Optimize',  'description' => 'We implement data governance policies, train your team, and provide ongoing optimization support.'],                                     'ar' => ['title' => 'الحوكمة والتحسين',          'description' => 'ننفذ سياسات حوكمة البيانات وندرب فريقك ونوفر دعم التحسين المستمر.']],
        ],
        'smart-home-integration' => [
            ['num' => '01', 'en' => ['title' => 'Home Consultation',        'description' => 'We visit your property, understand your lifestyle goals, and assess the existing infrastructure.'],                                 'ar' => ['title' => 'استشارة منزلية',        'description' => 'نزور عقارك ونفهم أهداف أسلوب حياتك ونقيّم البنية التحتية الموجودة.']],
            ['num' => '02', 'en' => ['title' => 'System Design',            'description' => 'We design a complete automation blueprint — device selection, network layout, and control hierarchy.'],                            'ar' => ['title' => 'تصميم النظام',          'description' => 'نصمم مخططاً كاملاً للأتمتة — اختيار الأجهزة وتخطيط الشبكة وتسلسل التحكم.']],
            ['num' => '03', 'en' => ['title' => 'Professional Installation','description' => 'Our certified installers deploy and configure every system with clean, concealed cabling and zero damage.'],                     'ar' => ['title' => 'التركيب الاحترافي',     'description' => 'يثبت ويضبط مثبتونا المعتمدون كل نظام بأسلاك نظيفة ومخفية وبدون أي ضرر.']],
            ['num' => '04', 'en' => ['title' => 'Training & Support',       'description' => 'We walk you through the system until you are confident, then stay available for updates and expansions.'],                         'ar' => ['title' => 'التدريب والدعم',        'description' => 'نشرح لك النظام حتى تكون واثقاً، ثم نبقى متاحين للتحديثات والتوسعات.']],
        ],
    ];

    public function run(): void
    {
        $slugMap = Service::pluck('id', 'slug')->toArray();

        foreach ($this->features as $slug => $featureList) {
            $serviceId = $slugMap[$slug] ?? null;
            if (!$serviceId) continue;

            foreach ($featureList as $order => $f) {
                $feature = ServiceFeature::create([
                    'service_id' => $serviceId,
                    'icon'       => $f['icon'],
                    'sort_order' => $order,
                ]);
                ServiceFeatureTranslation::create(array_merge($f['en'], ['service_feature_id' => $feature->id, 'locale' => 'en']));
                ServiceFeatureTranslation::create(array_merge($f['ar'], ['service_feature_id' => $feature->id, 'locale' => 'ar']));
            }
        }

        foreach ($this->processes as $slug => $processList) {
            $serviceId = $slugMap[$slug] ?? null;
            if (!$serviceId) continue;

            foreach ($processList as $order => $p) {
                $process = ServiceProcess::create([
                    'service_id' => $serviceId,
                    'num'        => $p['num'],
                    'sort_order' => $order,
                ]);
                ServiceProcessTranslation::create(array_merge($p['en'], ['service_process_id' => $process->id, 'locale' => 'en']));
                ServiceProcessTranslation::create(array_merge($p['ar'], ['service_process_id' => $process->id, 'locale' => 'ar']));
            }
        }

        $this->command->info('ServiceSubpageSeeder: seeded features and processes for 6 services.');
    }
}
