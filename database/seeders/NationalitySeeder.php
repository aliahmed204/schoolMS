<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function (){
            DB::table('nationalities')->delete();
            $types = [
                [
                'en'=> 'Afghan',
                'ar'=> 'أفغانستاني'
                ],
                [
                    'en'=> 'Albanian',
                    'ar'=> 'ألباني'
                ],
                [
                    'en'=> 'Algerian',
                    'ar'=> 'جزائري'
                ],
                [

                    'en'=> 'Angolan',
                    'ar'=> 'أنقولي'
                ],
                [

                    'en'=> 'Anguillan',
                    'ar'=> 'أنغويلي'
                ],
                [

                    'en'=> 'Argentinian',
                    'ar'=> 'أرجنتيني'
                ],
                [

                    'en'=> 'Armenian',
                    'ar'=> 'أرميني'
                ],
                [

                    'en'=> 'Australian',
                    'ar'=> 'أسترالي'
                ],
                [

                    'en'=> 'Austrian',
                    'ar'=> 'نمساوي'
                ],
                [

                    'en'=> 'Bahraini',
                    'ar'=> 'بحريني'
                ],
                [

                    'en'=> 'Bangladeshi',
                    'ar'=> 'بنغلاديشي'
                ],
                [

                    'en'=> 'Barbadian',
                    'ar'=> 'بربادوسي'
                ],
                [

                    'en'=> 'Belarusian',
                    'ar'=> 'روسي'
                ],
                [

                    'en'=> 'Belgian',
                    'ar'=> 'بلجيكي'
                ],

                [

                    'en'=> 'Bolivian',
                    'ar'=> 'بوليفي'
                ],
                [

                    'en'=> 'Brazilian',
                    'ar'=> 'برازيلي'
                ],
                [

                    'en'=> 'Burkinabe',
                    'ar'=> 'بوركيني'
                ],
                [

                    'en'=> 'Cameroonian',
                    'ar'=> 'كاميروني'
                ],
                [

                    'en'=> 'Canadian',
                    'ar'=> 'كندي'
                ],
                [

                    'en'=> 'Central African',
                    'ar'=> 'أفريقي'
                ],
                [

                    'en'=> 'Chadian',
                    'ar'=> 'تشادي'
                ],
                [

                    'en'=> 'Chilean',
                    'ar'=> 'شيلي'
                ],
                [

                    'en'=> 'Chinese',
                    'ar'=> 'صيني'
                ],
                [

                    'en'=> 'Colombian',
                    'ar'=> 'كولومبي'
                ],
                [

                    'en'=> 'Comorian',
                    'ar'=> 'جزر القمر'
                ],
                [

                    'en'=> 'Congolese',
                    'ar'=> 'كونغي'
                ],
                [

                    'en'=> 'Costa Rican',
                    'ar'=> 'كوستاريكي'
                ],
                [

                    'en'=> 'Croatian',
                    'ar'=> 'كوراتي'
                ],
                [

                    'en'=> 'Cypriot',
                    'ar'=> 'قبرصي'
                ],
                [
                    'en'=> 'Czech',
                    'ar'=> 'تشيكي'
                ],
                [
                    'en'=> 'Danish',
                    'ar'=> 'دنماركي'
                ],
                [
                    'en'=> 'Djiboutian',
                    'ar'=> 'جيبوتي'
                ],
                [

                    'en'=> 'Ecuadorian',
                    'ar'=> 'إكوادوري'
                ],
                [

                    'en'=> 'Egyptian',
                    'ar'=> 'مصري'
                ],
                [
                    'en'=> 'Ethiopian',
                    'ar'=> 'أثيوبي'
                ],
                [

                    'en'=> 'Finnish',
                    'ar'=> 'فنلندي'
                ],
                [

                    'en'=> 'French',
                    'ar'=> 'فرنسي'
                ],
                [
                    'en'=> 'Georgian',
                    'ar'=> 'جيورجي'
                ],
                [
                    'en'=> 'German',
                    'ar'=> 'ألماني'
                ],
                [
                    'en'=> 'Gibraltar',
                    'ar'=> 'جبل طارق'
                ],
                [
                    'en'=> 'Greek',
                    'ar'=> 'يوناني'
                ],
                [
                    'en'=> 'Honduran',
                    'ar'=> 'هندوراسي'
                ],
                [
                    'en'=> 'Hongkongese',
                    'ar'=> 'هونغ كونغي'
                ],
                [
                    'en'=> 'Icelandic',
                    'ar'=> 'آيسلندي'
                ],
                [
                    'en'=> 'Indian',
                    'ar'=> 'هندي'
                ],
                [
                    'en'=> 'Manx',
                    'ar'=> 'ماني'
                ],
                [
                    'en'=> 'Indonesian',
                    'ar'=> 'أندونيسيي'
                ],
                [
                    'en'=> 'Iranian',
                    'ar'=> 'إيراني'
                ],
                [
                    'en'=> 'Iraqi',
                    'ar'=> 'عراقي'
                ],
                [
                    'en'=> 'Irish',
                    'ar'=> 'إيرلندي'
                ],
                [
                    'en'=> 'Italian',
                    'ar'=> 'إيطالي'
                ],

                [
                    'en'=> 'Japanese',
                    'ar'=> 'ياباني'
                ],
                [
                    'en'=> 'Jordanian',
                    'ar'=> 'أردني'
                ],
                [
                    'en'=> 'Kazakh',
                    'ar'=> 'كازاخستاني'
                ],
                [
                    'en'=> 'Kenyan',
                    'ar'=> 'كيني'
                ],
                [
                    'en'=> 'North Korean',
                    'ar'=> 'كوري'
                ],
                [

                    'en'=> 'South Korean',
                    'ar'=> 'كوري'
                ],
                [

                    'en'=> 'Kuwaiti',
                    'ar'=> 'كويتي'
                ],
                [
                    'en'=> 'Lebanese',
                    'ar'=> 'لبناني'
                ],
                [

                    'en'=> 'Libyan',
                    'ar'=> 'ليبي'
                ],
                [

                    'en'=> 'Liechtenstein',
                    'ar'=> 'ليختنشتيني'
                ],
                [

                    'en'=> 'Malagasy',
                    'ar'=> 'مدغشقري'
                ],
                [

                    'en'=> 'Malawian',
                    'ar'=> 'مالاوي'
                ],
                [

                    'en'=> 'Malaysian',
                    'ar'=> 'ماليزي'
                ],
                [

                    'en'=> 'Maldivian',
                    'ar'=> 'مالديفي'
                ],
                [

                    'en'=> 'Malian',
                    'ar'=> 'مالي'
                ],
                [

                    'en'=> 'Maltese',
                    'ar'=> 'مالطي'
                ],
                [

                    'en'=> 'Mauritanian',
                    'ar'=> 'موريتانيي'
                ],
                [

                    'en'=> 'Mexican',
                    'ar'=> 'مكسيكي'
                ],
                [
                    'en'=> 'Mongolian',
                    'ar'=> 'منغولي'
                ],
                [
                    'en'=> 'Moroccan',
                    'ar'=> 'مغربي'
                ],
                [

                    'en'=> 'Mozambican',
                    'ar'=> 'موزمبيقي'
                ],
                [
                    'en'=> 'Dutch',
                    'ar'=> 'هولندي'
                ],
                [
                    'en'=> 'New Zealander',
                    'ar'=> 'نيوزيلندي'
                ],
                [
                    'en'=> 'Nigerian',
                    'ar'=> 'نيجيري'
                ],
                [
                    'en'=> 'Norwegian',
                    'ar'=> 'نرويجي'
                ],
                [

                    'en'=> 'Omani',
                    'ar'=> 'عماني'
                ],
                [
                    'en'=> 'Pakistani',
                    'ar'=> 'باكستاني'
                ],
                [

                    'en'=> 'Palestinian',
                    'ar'=> 'فلسطيني'
                ],
                [

                    'en'=> 'Peruvian',
                    'ar'=> 'بيري'
                ],
                [

                    'en'=> 'Filipino',
                    'ar'=> 'فلبيني'
                ],
                [

                    'en'=> 'Pitcairn Islander',
                    'ar'=> 'بيتكيرني'
                ],
                [

                    'en'=> 'Polish',
                    'ar'=> 'بوليني'
                ],
                [

                    'en'=> 'Portuguese',
                    'ar'=> 'برتغالي'
                ],
                [

                    'en'=> 'Puerto Rican',
                    'ar'=> 'بورتي'
                ],
                [

                    'en'=> 'Qatari',
                    'ar'=> 'قطري'
                ],
                [

                    'en'=> 'Reunionese',
                    'ar'=> 'ريونيوني'
                ],
                [

                    'en'=> 'Romanian',
                    'ar'=> 'روماني'
                ],
                [

                    'en'=> 'Russian',
                    'ar'=> 'روسي'
                ],
                [

                    'en'=> 'Rwandan',
                    'ar'=> 'رواندا'
                ],
                [

                    'en'=> 'Serbian',
                    'ar'=> 'صربي'
                ],
                [

                    'en'=> 'Singaporean',
                    'ar'=> 'سنغافوري'
                ],
                [

                    'en'=> 'Slovak',
                    'ar'=> 'سولفاكي'
                ],
                [

                    'en'=> 'Somali',
                    'ar'=> 'صومالي'
                ],
                [

                    'en'=> 'South African',
                    'ar'=> 'أفريقي'
                ],
                [

                    'en'=> 'South Sudanese',
                    'ar'=> 'سوادني جنوبي'
                ],
                [

                    'en'=> 'Spanish',
                    'ar'=> 'إسباني'
                ],
                [

                    'en'=> 'Sudanese',
                    'ar'=> 'سوداني'
                ],
                [

                    'en'=> 'Surinamese',
                    'ar'=> 'سورينامي'
                ],
                [

                    'en'=> 'Swedish',
                    'ar'=> 'سويدي'
                ],
                [

                    'en'=> 'Swiss',
                    'ar'=> 'سويسري'
                ],
                [

                    'en'=> 'Syrian',
                    'ar'=> 'سوري'
                ],
                [

                    'en'=> 'Taiwanese',
                    'ar'=> 'تايواني'
                ],
                [

                    'en'=> 'Tanzanian',
                    'ar'=> 'تنزانيي'
                ],
                [

                    'en'=> 'Thai',
                    'ar'=> 'تايلندي'
                ],
                [

                    'en'=> 'Timor-Lestian',
                    'ar'=> 'تيموري'
                ],
                [

                    'en'=> 'Togolese',
                    'ar'=> 'توغي'
                ],
                [

                    'en'=> 'Tokelaian',
                    'ar'=> 'توكيلاوي'
                ],
                [

                    'en'=> 'Tunisian',
                    'ar'=> 'تونسي'
                ],
                [

                    'en'=> 'Turkish',
                    'ar'=> 'تركي'
                ],
                [

                    'en'=> 'Turkmen',
                    'ar'=> 'تركمانستاني'
                ],
                [

                    'en'=> 'Tuvaluan',
                    'ar'=> 'توفالي'
                ],
                [

                    'en'=> 'Ugandan',
                    'ar'=> 'أوغندي'
                ],
                [

                    'en'=> 'Ukrainian',
                    'ar'=> 'أوكراني'
                ],
                [

                    'en'=> 'Emirati',
                    'ar'=> 'إماراتي'
                ],
                [

                    'en'=> 'British',
                    'ar'=> 'بريطاني'
                ],
                [

                    'en'=> 'American',
                    'ar'=> 'أمريكي'
                ],
                [

                    'en'=> 'US Minor Outlying Islander',
                    'ar'=> 'أمريكي'
                ],
                [

                    'en'=> 'Uruguayan',
                    'ar'=> 'أورغواي'
                ],
                [

                    'en'=> 'Uzbek',
                    'ar'=> 'أوزباكستاني'
                ],
                [

                    'en'=> 'Vanuatuan',
                    'ar'=> 'فانواتي'
                ],
                [

                    'en'=> 'Venezuelan',
                    'ar'=> 'فنزويلي'
                ],
                [

                    'en'=> 'Vietnamese',
                    'ar'=> 'فيتنامي'
                ],
                [

                    'en'=> 'American Virgin Islander',
                    'ar'=> 'أمريكي'
                ],
                [

                    'en'=> 'Vatican',
                    'ar'=> 'فاتيكاني'
                ],
                [

                    'en'=> 'Wallisian/Futunan',
                    'ar'=> 'فوتوني'
                ],
                [

                    'en'=> 'Sahrawian',
                    'ar'=> 'صحراوي'
                ],
                [

                    'en'=> 'Yemeni',
                    'ar'=> 'يمني'
                ],
                [

                    'en'=> 'Zambian',
                    'ar'=> 'زامبياني'
                ],
                [

                    'en'=> 'Zimbabwean',
                    'ar'=> 'زمبابوي'
                ]
            ];

            foreach ($types as $type){
                Nationality::create(['name'=> $type]);
            }
        });
    }
}
