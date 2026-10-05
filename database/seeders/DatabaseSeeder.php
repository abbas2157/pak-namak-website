<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@paknamak.pk'],
            ['name' => 'Admin', 'password' => Hash::make('password')]
        );

        Setting::put([
            'site_name' => 'Pak Namak & Masala Jaat (PVT) Limited',
            'tagline_ur' => 'خالص نمک، خالص زندگی',
            'phone' => '+92 307 8479818',
            'whatsapp' => '923078479818',
            'email' => 'info@paknamak.pk',
            'address' => 'بستی ڈھورے والا اسٹاپ نزد اڈا بہاولواہ میلسی ملتان روڈ, 61180',
            'map_url' => 'https://www.google.com/maps/place/PAK+NAMAK+AND+MASALA+JAAT+(PVT)+LIMITED/@29.9171363,71.9900305,17z',
            'facebook' => 'https://www.facebook.com/profile.php?id=61579347516350',
            'instagram' => '',
            'youtube' => 'https://www.youtube.com/@PAKNAMAK',
            'tiktok' => 'https://www.tiktok.com/@paknamak',
            'whatsapp_link' => 'https://wa.link/2jvn0s',
            'hero_text_ur' => "پاک نمک اینڈ مصالحہ جات معیاری نمک کی خریداری اور صفائی سے پسائی کے ذریعے خالص اور بہترین مصنوعات فراہم کرتا ہے۔\nہم دلا نمک، کھلا نمک، پیک شدہ نمک اور ہر قسم کے اعلیٰ معیار کے مصالحہ جات فراہم کرتے ہیں۔\nہماری ترجیح تازگی، معیار اور مناسب قیمت پر بہترین سروس دینا ہے",
            'founded_year' => '2024',
            'order_url' => 'https://admin.paknamak.pk/order',
        ]);

        $thaila = Category::updateOrCreate(['slug' => 'salt-in-thaila'], [
            'name' => 'Salt in Thaila', 'name_ur' => 'تھیلا نمک – کھلا اور اقتصادی آپشن', 'sort_order' => 1,
        ]);
        $packed = Category::updateOrCreate(['slug' => 'packed-salt'], [
            'name' => 'Packed Salt', 'name_ur' => 'پیکٹ نمک – پیک شدہ گھریلو استعمال کے لیے', 'sort_order' => 2,
        ]);
        Category::updateOrCreate(['slug' => 'dalla-namak'], [
            'name' => 'Dalla Namak', 'name_ur' => 'ڈلا نمک', 'sort_order' => 3,
        ]);

        $products = [
            [$thaila, '50 KG Bags', 'کلو بوری50', 'تھوک خریداروں اور تجارتی استعمال کے لیے موزوں', 'images/salt-50kg.jpeg'],
            [$thaila, '10 KG Packs', '10کلو پیک', 'درمیانے درجے کی دکانوں اور ڈسٹری بیوٹرز کے لیے بہترین', 'images/salt-10kg.jpeg'],
            [$thaila, '5 KG Packs', '5کلو پیک', 'عام صارفین کے لیے مناسب', 'images/salt-5kg.jpeg'],
            [$packed, '700G ( گرام ) (10 Packets)', null, null, 'images/packet-salt.jpeg'],
            [$packed, '600G ( گرام ) (20 Packets)', null, null, 'images/packet-salt.jpeg'],
            [$packed, '500G ( گرام ) (10 Packets)', null, null, 'images/packet-salt.jpeg'],
            [$packed, '400G ( گرام ) (10 Packets)', null, null, 'images/packet-salt.jpeg'],
            [$packed, '300G ( گرام ) (20 Packets)', null, null, 'images/packet-salt.jpeg'],
            [$packed, '250G ( گرام ) (20 Packets)', null, null, 'images/packet-salt.jpeg'],
        ];
        foreach ($products as $i => [$cat, $name, $nameUr, $desc, $img]) {
            Product::updateOrCreate(['slug' => Str::slug($name)], [
                'category_id' => $cat->id, 'name' => $name, 'name_ur' => $nameUr,
                'description' => $desc, 'image' => $img, 'sort_order' => $i + 1,
            ]);
        }

        $team = [
            ['Ghazanfar Abbas', 'Chief Financial Officer (CFO)', 'Responsible for financial planning, budgeting, accounting oversight, and maintaining financial stability of the organization.', 'مالی معاملات، بجٹ سازی، اکاؤنٹس اور ادارے کے مالی استحکام کی نگرانی کرتے ہیں۔', 'images/team-ghazanfar.jpg',
                ['facebook' => 'https://www.facebook.com/ghazanfar.abbas.5076']],
            ['Safdar Jabbar', 'Chief Operating Officer (COO)', 'Oversees day-to-day operations, production management, supply chain coordination, and operational efficiency.', 'روزمرہ امور، پیداوار، سپلائی چین اور آپریشنز کی نگرانی کرتے ہیں تاکہ نظام مؤثر اور منظم طریقے سے چلتا رہے۔', 'images/team-safdar.jpg',
                ['facebook' => 'https://www.facebook.com/chita.jutt.9', 'tiktok' => 'https://www.tiktok.com/@chitta.g91', 'whatsapp' => 'https://wa.link/2jvn0s']],
            ['Mudassar Abbas', 'Chief Executive Officer (CEO)', 'Overall leader and primary decision-maker responsible for strategic planning, business development, and organizational direction.', 'ادارے کے مجموعی سربراہ اور اہم فیصلوں کے ذمہ دار۔ کاروباری حکمتِ عملی، منصوبہ بندی اور مستقبل کی سمت کا تعین کرتے ہیں۔', 'images/team-mudassar.jpg',
                ['facebook' => 'https://www.facebook.com/mudassar.abbas.9277/', 'tiktok' => 'https://www.tiktok.com/@mudassarabbas77', 'linkedin' => 'https://www.linkedin.com/in/mudassar-abbas-8267b8113/', 'twitter' => 'https://x.com/abbas8156']],
        ];
        foreach ($team as $i => [$name, $title, $bio, $bioUr, $photo, $socials]) {
            TeamMember::updateOrCreate(['name' => $name], [
                'title' => $title, 'bio' => $bio, 'bio_ur' => $bioUr, 'photo' => $photo, 'sort_order' => $i + 1,
            ] + $socials);
        }

        $faqs = [
            ['What types of salt do you offer?', 'آپ کون کون سی اقسام کا نمک فراہم کرتے ہیں؟',
                'We supply loose salt (Khulla/Thaila Namak), Dalla Namak, and hygienically packed salt. Bulk sizes are 50 kg bags, 10 kg packs and 5 kg packs. Retail packets come in 250g, 300g, 400g, 500g, 600g and 700g. We also supply a complete range of masala jaat.',
                'ہم کھلا نمک (تھیلا نمک)، ڈلا نمک اور صفائی کے ساتھ پیک شدہ نمک فراہم کرتے ہیں۔ تھوک کے لیے 50 کلو بوری، 10 کلو پیک اور 5 کلو پیک دستیاب ہیں، جبکہ ریٹیل پیکٹ 250 گرام، 300 گرام، 400 گرام، 500 گرام، 600 گرام اور 700 گرام میں دستیاب ہیں۔ اس کے علاوہ ہم ہر قسم کے اعلیٰ معیار کے مصالحہ جات بھی فراہم کرتے ہیں۔'],
            ['How many packets are in one carton?', 'ایک کارٹن میں کتنے پیکٹ ہوتے ہیں؟',
                '700g, 500g and 400g packets are supplied 10 packets per carton. 600g, 300g and 250g packets are supplied 20 packets per carton.',
                '700 گرام، 500 گرام اور 400 گرام کے پیکٹ ایک کارٹن میں 10 عدد ہوتے ہیں، جبکہ 600 گرام، 300 گرام اور 250 گرام کے پیکٹ ایک کارٹن میں 20 عدد ہوتے ہیں۔'],
            ['What is Dalla Namak, and how is it different from ground salt?', 'ڈلا نمک کیا ہے اور یہ پسے ہوئے نمک سے کیسے مختلف ہے؟',
                'Dalla Namak is rock salt supplied in its natural lump form, before grinding. It is popular with customers who grind at home or process it further themselves. Our ground salt is the same rock salt after cleaning, drying and fine grinding.',
                'ڈلا نمک قدرتی ڈلوں کی شکل میں ہوتا ہے، یعنی پسائی سے پہلے۔ یہ اُن گاہکوں میں مقبول ہے جو خود گھر یا فیکٹری میں پسائی کرتے ہیں۔ ہمارا پسا ہوا نمک اِسی ڈلا نمک کو صاف کر کے، خشک کر کے اور باریک پیس کر تیار کیا جاتا ہے۔'],
            ['Do you also supply masala jaat?', 'کیا آپ مصالحہ جات بھی فراہم کرتے ہیں؟',
                'Yes. Alongside salt we supply a full range of everyday masala jaat for retail shops, restaurants and wholesale buyers. Contact us for the current item list and rates.',
                'جی ہاں۔ نمک کے ساتھ ساتھ ہم ریٹیل دکانوں، ریسٹورنٹس اور تھوک خریداروں کے لیے روزمرہ استعمال کے تمام مصالحہ جات فراہم کرتے ہیں۔ موجودہ فہرست اور ریٹ کے لیے ہم سے رابطہ کریں۔'],
            ['What is the wholesale rate for salt?', 'نمک کا تھوک ریٹ کیا ہے؟',
                "Wholesale rates depend on quantity, pack size and current market rates, so we quote per order. Send us your required quantity on WhatsApp at +92 307 8479818 and we will share today's rate the same day.",
                'تھوک ریٹ مقدار، پیک سائز اور مارکیٹ کی موجودہ صورتحال پر منحصر ہوتا ہے، اس لیے ہم ہر آرڈر کے مطابق قیمت بتاتے ہیں۔ اپنی مطلوبہ مقدار واٹس ایپ نمبر 03078479818 پر بھیجیں، ہم اسی دن آج کا ریٹ فراہم کر دیں گے۔'],
            ['What is your minimum order quantity for wholesale?', 'تھوک آرڈر کے لیے کم از کم مقدار کتنی ہے؟',
                'Our minimum wholesale order is [confirm — e.g. 10 bags of 50kg / 20 cartons]. Smaller quantities are available for retail shops and household customers.',
                'تھوک آرڈر کے لیے کم از کم مقدار [ — e.g. 10 bags of 50kg / 20 cartons] ہے۔ ریٹیل دکانداروں اور گھریلو صارفین کے لیے اس سے کم مقدار میں بھی آرڈر دستیاب ہے۔'],
            ['Can I order a custom quantity or custom packing?', 'کیا میں اپنی مرضی کی مقدار یا پیکنگ میں آرڈر دے سکتا ہوں؟',
                'Yes. We can arrange custom quantities subject to availability, and we also offer packing under your own brand name for regular bulk buyers. Contact us to discuss requirements and minimums.',
                'جی ہاں۔ دستیابی کے مطابق ہم کسٹم مقدار فراہم کر سکتے ہیں، اور مستقل تھوک خریداروں کے لیے اُن کے اپنے برانڈ نام کے تحت پیکنگ کی سہولت بھی موجود ہے۔ تفصیلات کے لیے ہم سے رابطہ کریں۔'],
            ['How can I place an order?', 'آرڈر کیسے دیا جا سکتا ہے؟',
                'You can order three ways: call or WhatsApp us on +92 307 8479818, fill in the enquiry form on our Contact page, or use the online order system on our website. We confirm every order by phone before dispatch.',
                'آپ تین طریقوں سے آرڈر دے سکتے ہیں: 03078479818 پر کال یا واٹس ایپ کریں، ہمارے رابطہ صفحے پر فارم پُر کریں، یا ویب سائٹ پر آن لائن آرڈر سسٹم استعمال کریں۔ ہر آرڈر روانگی سے پہلے فون پر تصدیق کیا جاتا ہے۔'],
            ['What payment methods do you accept?', 'آپ کون سے طریقۂ ادائیگی قبول کرتے ہیں؟',
                'We accept [confirm — cash on delivery, bank transfer, Easypaisa, JazzCash]. For first-time bulk orders an advance may be required.',
                'ہم [cash on delivery, bank transfer, Easypaisa, JazzCash] کے ذریعے ادائیگی قبول کرتے ہیں۔ پہلی بار تھوک آرڈر کی صورت میں ایڈوانس درکار ہو سکتا ہے۔'],
            ['Do you deliver, and which areas do you cover?', 'کیا آپ ڈیلیوری کرتے ہیں اور کن علاقوں میں؟',
                'Yes. We deliver directly across Melsi, Vehari, Multan, Burewala and Khanewal, and we can arrange transport to other cities in Punjab and Sindh through goods carriers. Delivery charges depend on distance and order size. [confirm coverage]',
                'جی ہاں۔ ہم میلسی، وہاڑی، ملتان، بورے والا اور خانیوال میں براہِ راست ڈیلیوری کرتے ہیں، جبکہ پنجاب اور سندھ کے دیگر شہروں کے لیے گڈز ٹرانسپورٹ کے ذریعے ترسیل کا انتظام کر سکتے ہیں۔ ڈیلیوری چارجز فاصلے اور آرڈر کے حجم پر منحصر ہیں۔'],
            ['How long does delivery take?', 'ڈیلیوری میں کتنا وقت لگتا ہے؟',
                "Local orders are usually dispatched within [confirm — 24–48 hours] of confirmation. Out-of-city consignments depend on the transport company's schedule.",
                'مقامی آرڈرز عام طور پر تصدیق کے [24–48 hours] کے اندر روانہ کر دیے جاتے ہیں۔ دوسرے شہروں کی ترسیل ٹرانسپورٹ کمپنی کے شیڈول پر منحصر ہوتی ہے۔'],
            ['Is your salt properly cleaned and processed?', 'کیا آپ کا نمک صاف اور معیاری طریقے سے تیار کیا جاتا ہے؟',
                'Yes. We buy raw rock salt, clean it thoroughly, dry it, and grind it on our own machinery under supervised conditions. Every batch is checked before packing so that purity and grain consistency stay the same across orders.',
                'جی ہاں۔ ہم خام ڈلا نمک خریدتے ہیں، اسے اچھی طرح صاف اور خشک کرتے ہیں اور اپنی مشینری پر نگرانی میں پسائی کرتے ہیں۔ پیکنگ سے پہلے ہر بیچ کی جانچ کی جاتی ہے تاکہ خالص پن اور پسائی کا معیار ہر آرڈر میں یکساں رہے۔'],
            ['Does salt expire? How should it be stored?', 'کیا نمک خراب ہو جاتا ہے؟ اسے کیسے محفوظ رکھا جائے؟',
                'Salt does not spoil, but it absorbs moisture. Store bags and cartons in a dry, covered place away from damp floors and direct sunlight so the salt stays free-flowing and does not harden.',
                'نمک خراب نہیں ہوتا، البتہ یہ نمی جذب کر لیتا ہے۔ بوریوں اور کارٹنوں کو خشک، ڈھکی ہوئی جگہ پر رکھیں، گیلے فرش اور دھوپ سے دور، تاکہ نمک جمنے سے محفوظ رہے۔'],
            ['Where are you located?', 'آپ کہاں واقع ہیں؟',
                'Our facility is at Basti Dhore Wala Stop, near Adda Bahawalwah, Melsi–Multan Road, 61180. Buyers are welcome to visit and inspect the salt before ordering — please call ahead so we can receive you.',
                'ہماری فیکٹری بستی ڈھورے والا اسٹاپ، نزد اڈا بہاولواہ، میلسی ملتان روڈ، 61180 پر واقع ہے۔ خریدار آرڈر سے پہلے آ کر نمک خود دیکھ سکتے ہیں — براہِ کرم آنے سے پہلے کال کر لیں۔'],
            ['Can I become a dealer or distributor?', 'کیا میں ڈیلر یا ڈسٹری بیوٹر بن سکتا ہوں؟',
                'Yes, we are expanding our distribution network across South Punjab. If you run a wholesale or retail business and want dealership terms, contact us with your city and expected monthly volume.',
                'جی ہاں، ہم جنوبی پنجاب میں اپنا ڈسٹری بیوشن نیٹ ورک بڑھا رہے ہیں۔ اگر آپ تھوک یا پرچون کا کاروبار کرتے ہیں اور ڈیلرشپ لینا چاہتے ہیں تو اپنے شہر اور متوقع ماہانہ مقدار کے ساتھ ہم سے رابطہ کریں۔'],
        ];
        foreach ($faqs as $i => [$q, $qUr, $a, $aUr]) {
            Faq::updateOrCreate(['question' => $q], [
                'question_ur' => $qUr, 'answer' => $a, 'answer_ur' => $aUr, 'sort_order' => $i + 1,
            ]);
        }
    }
}
