<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Seed 80 destinations across 4 categories (20 each).
     */
    public function run(): void
    {
        $destinations = [
            // ==========================================
            // 1. WATERFALL (20 DESTINASI)
            // ==========================================
            [
                'name' => 'Air Terjun Sekumpul',
                'category' => 'Waterfall',
                'description' => 'Gugusan air terjun kembar megah berketinggian 80m di lembah Buleleng.',
                'image' => 'images/sekumpul.jpg',
                'price' => 20000,
            ],
            [
                'name' => 'Air Terjun Tegenungan',
                'category' => 'Waterfall',
                'description' => 'Kolam alami segar di lembah Gianyar dengan akses mudah dekat Ubud.',
                'image' => 'images/tegenungan.jpg',
                'price' => 15000,
            ],
            [
                'name' => 'Air Terjun Gitgit',
                'category' => 'Waterfall',
                'description' => 'Air terjun legendaris dengan ketinggian 35 meter di Singaraja.',
                'image' => 'images/gitgit.jpg',
                'price' => 10000,
            ],
            [
                'name' => 'Air Terjun Aling-Aling',
                'category' => 'Waterfall',
                'description' => 'Sensasi seluncur alami dan cliff jumping yang menantang di Sambangan.',
                'image' => 'images/aling_aling.jpg',
                'price' => 20000,
            ],
            [
                'name' => 'Air Terjun Banyumala Twin',
                'category' => 'Waterfall',
                'description' => 'Pesona air terjun kembar tersembunyi dengan kolam jernih di Wanagiri.',
                'image' => 'images/waterfall.jpg',
                'price' => 30000,
            ],
            [
                'name' => 'Air Terjun Tibumana',
                'category' => 'Waterfall',
                'description' => 'Air terjun berarus tenang dengan suasana damai nan asri di Bangli.',
                'image' => 'images/waterfall.jpg',
                'price' => 20000,
            ],
            [
                'name' => 'Air Terjun Kanto Lampo',
                'category' => 'Waterfall',
                'description' => 'Undakan batu alam eksotis dengan aliran air bertingkat di Gianyar.',
                'image' => 'images/waterfall.jpg',
                'price' => 20000,
            ],
            [
                'name' => 'Air Terjun Tukad Cepung',
                'category' => 'Waterfall',
                'description' => 'Fenomena sinar matahari menembus celah tebing gua dramatis di Bangli.',
                'image' => 'images/waterfall.jpg',
                'price' => 25000,
            ],
            [
                'name' => 'Air Terjun Nungnung',
                'category' => 'Waterfall',
                'description' => 'Air terjun megah bertenaga kuat di tengah perbukitan sejuk Petang Badung.',
                'image' => 'images/waterfall.jpg',
                'price' => 20000,
            ],
            [
                'name' => 'Air Terjun Munduk',
                'category' => 'Waterfall',
                'description' => 'Dikelilingi perkebunan kopi dan cengkeh dengan udara pegunungan segar.',
                'image' => 'images/waterfall.jpg',
                'price' => 20000,
            ],
            [
                'name' => 'Air Terjun Leke Leke',
                'category' => 'Waterfall',
                'description' => 'Jalur setapak rimbun membawa ke ceruk air terjun anggun di Tabanan.',
                'image' => 'images/waterfall.jpg',
                'price' => 25000,
            ],
            [
                'name' => 'Air Terjun Kroya',
                'category' => 'Waterfall',
                'description' => 'Titik seluncur tebing alami setinggi 5 meter di kawasan Sambangan.',
                'image' => 'images/waterfall.jpg',
                'price' => 20000,
            ],
            [
                'name' => 'Air Terjun Goa Rang Reng',
                'category' => 'Waterfall',
                'description' => 'Air terjun landai bertingkat di atas formasi batu gua alami Gianyar.',
                'image' => 'images/waterfall.jpg',
                'price' => 20000,
            ],
            [
                'name' => 'Air Terjun Yeh Hoo',
                'category' => 'Waterfall',
                'description' => 'Tersembunyi di dekat lanskap sawah terasering warisan dunia Jatiluwih.',
                'image' => 'images/waterfall.jpg',
                'price' => 15000,
            ],
            [
                'name' => 'Air Terjun Pengibul',
                'category' => 'Waterfall',
                'description' => 'Air terjun dua tingkat yang sunyi dan tenang di pedalaman Bangli.',
                'image' => 'images/waterfall.jpg',
                'price' => 15000,
            ],
            [
                'name' => 'Air Terjun Melanting',
                'category' => 'Waterfall',
                'description' => 'Salah satu air terjun tertinggi di Munduk dengan gemuruh menawan.',
                'image' => 'images/waterfall.jpg',
                'price' => 20000,
            ],
            [
                'name' => 'Air Terjun Suwat',
                'category' => 'Waterfall',
                'description' => 'Kolam air terjun alami dengan rakit bambu khas di pedesaan Gianyar.',
                'image' => 'images/waterfall.jpg',
                'price' => 25000,
            ],
            [
                'name' => 'Air Terjun Golden Valley',
                'category' => 'Waterfall',
                'description' => 'Tersembunyi di lembah hijau Munduk dengan panorama kafe alam.',
                'image' => 'images/waterfall.jpg',
                'price' => 15000,
            ],
            [
                'name' => 'Air Terjun Blemantung',
                'category' => 'Waterfall',
                'description' => 'Air terjun menjulang di tengah aroma semerbak perkebunan kopi Pupuan.',
                'image' => 'images/waterfall.jpg',
                'price' => 10000,
            ],
            [
                'name' => 'Air Terjun Jembong',
                'category' => 'Waterfall',
                'description' => 'Aliran air jernih bertingkat melintasi bebatuan di Sukasada Buleleng.',
                'image' => 'images/waterfall.jpg',
                'price' => 10000,
            ],

            // ==========================================
            // 2. SUNSET BEACH (20 DESTINASI)
            // ==========================================
            [
                'name' => 'Pantai Kuta',
                'category' => 'Sunset Beach',
                'description' => 'Pantai ikonik Bali yang terkenal dengan hamparan pasir putih dan pemandangan matahari terbenam.',
                'image' => 'images/kuta.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Jimbaran',
                'category' => 'Sunset Beach',
                'description' => 'Destinasi populer menikmati kuliner seafood bakar di tepi pantai saat senja.',
                'image' => 'images/jimbaran.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Seminyak',
                'category' => 'Sunset Beach',
                'description' => 'Suasana senja trendi dengan deretan beach club dan lounge tepi pantai.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Echo Beach',
                'category' => 'Sunset Beach',
                'description' => 'Spot favorit peselancar internasional dengan siluet pura dan senja keemasan.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Batu Bolong',
                'category' => 'Sunset Beach',
                'description' => 'Titik kumpul komunitas selancar Canggu dengan latar lubang batu karang ikonik.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Suluban',
                'category' => 'Sunset Beach',
                'description' => 'Gua tebing karang megah dengan akses selancar kelas dunia di Uluwatu.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Padang Padang',
                'category' => 'Sunset Beach',
                'description' => 'Pantai teluk berpasir putih di celah tebing karang eksotis Uluwatu.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 15000,
            ],
            [
                'name' => 'Pantai Balangan',
                'category' => 'Sunset Beach',
                'description' => 'Hamparan pasir keemasan dan tebing tinggi panorama senja Samudera Hindia.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Bingin',
                'category' => 'Sunset Beach',
                'description' => 'Pantai bohemian berombak sempurna di bawah tebing kapur Pecatu.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Melasti',
                'category' => 'Sunset Beach',
                'description' => 'Jalan aspal membelah tebing kapur putih megah menuju pesisir Ungasan.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 10000,
            ],
            [
                'name' => 'Pantai Dreamland',
                'category' => 'Sunset Beach',
                'description' => 'Pasir putih lembut dikelilingi tebing terjal dan ombak atraktif di Pecatu.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Kedonganan',
                'category' => 'Sunset Beach',
                'description' => 'Pusat perahu nelayan tradisional dan pemandangan senja teluk Jimbaran.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Kelan',
                'category' => 'Sunset Beach',
                'description' => 'Pemandangan matahari terbenam unik berdampingan dengan landasan pacu bandara.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Berawa',
                'category' => 'Sunset Beach',
                'description' => 'Garis pantai luas dengan suasana sunset santai di perbatasan Seminyak Canggu.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Pererenan',
                'category' => 'Sunset Beach',
                'description' => 'Pasir vulkanik berkilau dengan patung Gajah Mina dan ombak selancar menantang.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Mengening',
                'category' => 'Sunset Beach',
                'description' => 'Pesisir karang eksotis dengan siluet pura laut sakral di Cemagi.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Tanah Lot',
                'category' => 'Sunset Beach',
                'description' => 'Ikon panorama matahari terbenam Bali dengan pura agung di atas batu karang laut.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 30000,
            ],
            [
                'name' => 'Pantai Nyanyi',
                'category' => 'Sunset Beach',
                'description' => 'Hamparan pasir hitam berkilau yang tenang dan damai untuk menyendiri saat senja.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Batu Belig',
                'category' => 'Sunset Beach',
                'description' => 'Pantai senja luas yang cocok untuk jogging sore dan jalan santai.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Jerman',
                'category' => 'Sunset Beach',
                'description' => 'Pesisir tenang dekat muara kapal dengan dermaga kayu panjang untuk menikmati sunset.',
                'image' => 'images/sunset-beach.jpg',
                'price' => 0,
            ],

            // ==========================================
            // 3. SUNRISE BEACH (20 DESTINASI)
            // ==========================================
            [
                'name' => 'Pantai Sanur',
                'category' => 'Sunrise Beach',
                'description' => 'Pantai sunrise tertua di Bali dengan ombak tenang dan jalur bersepeda tepi laut.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Karang Sanur',
                'category' => 'Sunrise Beach',
                'description' => 'Gazebo tradisional di atas karang laut untuk menyambut fajar pertama Bali.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Sindhu',
                'category' => 'Sunrise Beach',
                'description' => 'Deretan perahu jukung warna-warni berlatar siluet megah Gunung Agung di pagi hari.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Matahari Terbit',
                'category' => 'Sunrise Beach',
                'description' => 'Dermaga penyeberangan utama Nusa Penida dengan panorama sunrise spektakuler.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Segara Ayu',
                'category' => 'Sunrise Beach',
                'description' => 'Suasana tenang pagi hari diiringi semilir angin laut dan aroma kopi pesisir.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Mertasari',
                'category' => 'Sunrise Beach',
                'description' => 'Ujung selatan Sanur dengan area terbuka luas untuk melihat sunrise dan festival layang-layang.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Nusa Dua',
                'category' => 'Sunrise Beach',
                'description' => 'Pesisir pantai resor terpadu dengan pasir putih halus dan air laut sebening kristal.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Geger',
                'category' => 'Sunrise Beach',
                'description' => 'Surga perairan tenang terlindung karang dengan pemandangan fajar teduh.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 5000,
            ],
            [
                'name' => 'Pantai Mengiat',
                'category' => 'Sunrise Beach',
                'description' => 'Garis pantai pasir putih terpanjang di Nusa Dua dengan karang penghalang ombak.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Pandawa',
                'category' => 'Sunrise Beach',
                'description' => 'Pantai bertebing kapur terbelah dengan patung lima ksatria Pandawa menghadap timur.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 15000,
            ],
            [
                'name' => 'Pantai Kusamba',
                'category' => 'Sunrise Beach',
                'description' => 'Pesisir pasir hitam dengan aktivitas petani garam tradisional saat fajar menyingsing.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Bias Tugel',
                'category' => 'Sunrise Beach',
                'description' => 'Teluk pasir putih tersembunyi dengan kolam karang waterblow di Padangbai.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 10000,
            ],
            [
                'name' => 'Pantai Padangbai',
                'category' => 'Sunrise Beach',
                'description' => 'Pelabuhan alami di teluk tenang berpagar bukit hijau cerah di pagi hari.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Pasir Putih Virgin Beach',
                'category' => 'Sunrise Beach',
                'description' => 'Pantai terpencil berpasir putih bersih diapit dua bukit Karangasem.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 15000,
            ],
            [
                'name' => 'Pantai Amed',
                'category' => 'Sunrise Beach',
                'description' => 'Pesisir timur dengan siluet jukung nelayan berlatar kemegahan Gunung Agung.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Lovina',
                'category' => 'Sunrise Beach',
                'description' => 'Perairan tenang Bali Utara untuk melihat lumba-lumba berenang bebas di waktu subuh.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Candidasa',
                'category' => 'Sunrise Beach',
                'description' => 'Kawasan pantai timur dengan kolam teratai raksasa menyambut fajar dari balik pulau.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Lebih',
                'category' => 'Sunrise Beach',
                'description' => 'Pesisir kuliner sate lilit ikan laut dengan panorama deburan ombak pagi hari.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Keramas',
                'category' => 'Sunrise Beach',
                'description' => 'Pantai pasir hitam dengan spot selancar ombak kanan terbaik saat matahari terbit.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Pantai Jasri',
                'category' => 'Sunrise Beach',
                'description' => 'Pantai berbatu karang eksotis lokasi favorit tradisi melasti dan sunrise di Karangasem.',
                'image' => 'images/sunrise-beach.jpg',
                'price' => 0,
            ],

            // ==========================================
            // 4. MOUNTAIN (20 DESTINASI)
            // ==========================================
            [
                'name' => 'Gunung Batur',
                'category' => 'Mountain',
                'description' => 'Gunung berapi aktif favorit pendaki untuk menikmati pemandangan matahari terbit di atas awan.',
                'image' => 'images/batur.jpg',
                'price' => 100000,
            ],
            [
                'name' => 'Gunung Agung',
                'category' => 'Mountain',
                'description' => 'Gunung tertinggi dan paling disucikan di Bali dengan panorama sakral tak tertandingi.',
                'image' => 'images/mountain.jpg',
                'price' => 150000,
            ],
            [
                'name' => 'Gunung Batukaru',
                'category' => 'Mountain',
                'description' => 'Puncak tertinggi kedua di Bali yang diselimuti hutan hujan tropis lebat dan asri.',
                'image' => 'images/mountain.jpg',
                'price' => 75000,
            ],
            [
                'name' => 'Gunung Abang',
                'category' => 'Mountain',
                'description' => 'Jalur pendakian rimba menghadap langsung kaldera dan danau Batur Kintamani.',
                'image' => 'images/mountain.jpg',
                'price' => 50000,
            ],
            [
                'name' => 'Gunung Catur',
                'category' => 'Mountain',
                'description' => 'Puncak suci Pura Pucak Mangu di atas Danau Beratan Bedugul.',
                'image' => 'images/mountain.jpg',
                'price' => 40000,
            ],
            [
                'name' => 'Gunung Adeng',
                'category' => 'Mountain',
                'description' => 'Formasi gunung vulkanik purba yang tenang dan hijau di kawasan Tabanan.',
                'image' => 'images/mountain.jpg',
                'price' => 30000,
            ],
            [
                'name' => 'Gunung Lesung',
                'category' => 'Mountain',
                'description' => 'Menyajikan panorama Danau Tamblingan dan gua suci di puncak kaldera.',
                'image' => 'images/mountain.jpg',
                'price' => 35000,
            ],
            [
                'name' => 'Gunung Pohen',
                'category' => 'Mountain',
                'description' => 'Jalur trek sejuk di kawasan konservasi hutan lindung cagar alam Batukahu.',
                'image' => 'images/mountain.jpg',
                'price' => 30000,
            ],
            [
                'name' => 'Gunung Sanghyang',
                'category' => 'Mountain',
                'description' => 'Puncak gunung berkabut mistis diapit hutan rimbun Tabanan dan Buleleng.',
                'image' => 'images/mountain.jpg',
                'price' => 35000,
            ],
            [
                'name' => 'Bukit Campuhan Ridge Walk',
                'category' => 'Mountain',
                'description' => 'Jalur trekking punggungan bukit hijau ikonik di antara dua lembah sungai Ubud.',
                'image' => 'images/mountain.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Bukit Asah Bugbug',
                'category' => 'Mountain',
                'description' => 'Tebing perbukitan hijau menghadap langsung laut lepas dan pulau karang Karangasem.',
                'image' => 'images/mountain.jpg',
                'price' => 15000,
            ],
            [
                'name' => 'Bukit Cinta Pinggan',
                'category' => 'Mountain',
                'description' => 'Pemandangan magis kabut pagi menyelimuti pedesaan dengan latar Gunung Batur.',
                'image' => 'images/mountain.jpg',
                'price' => 0,
            ],
            [
                'name' => 'Kintamani Highlands',
                'category' => 'Mountain',
                'description' => 'Dataran tinggi sejuk dengan panorama spektakuler kaldera dan danau purba.',
                'image' => 'images/mountain.jpg',
                'price' => 25000,
            ],
            [
                'name' => 'Puncak Wanagiri Hidden Hills',
                'category' => 'Mountain',
                'description' => 'Gardu pandang perbukitan tinggi menghadap kembar danau Buyan dan Tamblingan.',
                'image' => 'images/mountain.jpg',
                'price' => 20000,
            ],
            [
                'name' => 'Bukit Trunyan',
                'category' => 'Mountain',
                'description' => 'Puncak bukit kaldera timur Batur dengan pemandangan langsung ke desa kuno Trunyan.',
                'image' => 'images/mountain.jpg',
                'price' => 25000,
            ],
            [
                'name' => 'Puncak Karang Boma',
                'category' => 'Mountain',
                'description' => 'Tebing tebing karang menjulang 100 meter di atas deburan ombak Uluwatu.',
                'image' => 'images/mountain.jpg',
                'price' => 10000,
            ],
            [
                'name' => 'Bukit Guungan Candidasa',
                'category' => 'Mountain',
                'description' => 'Bukit hijau tepi laut dengan tangga pendakian menuju pemandangan teluk Candidasa.',
                'image' => 'images/mountain.jpg',
                'price' => 10000,
            ],
            [
                'name' => 'Bukit Putung',
                'category' => 'Mountain',
                'description' => 'Pemandangan lembah hijau sawah terasering berpadu laut biru Karangasem dari ketinggian.',
                'image' => 'images/mountain.jpg',
                'price' => 10000,
            ],
            [
                'name' => 'Puncak Gunung Silangjana',
                'category' => 'Mountain',
                'description' => 'Trek perbukitan asri Bali Utara dengan panorama kota Singaraja dari atas.',
                'image' => 'images/mountain.jpg',
                'price' => 15000,
            ],
            [
                'name' => 'Lembah Sukawana Kintamani',
                'category' => 'Mountain',
                'description' => 'Lembah berkabut sejuk dengan lanskap kebun jeruk dan rumah tradisional pegunungan.',
                'image' => 'images/mountain.jpg',
                'price' => 15000,
            ],
        ];

        foreach ($destinations as $dest) {
            Destination::updateOrCreate(
                ['name' => $dest['name']],
                [
                    'category' => $dest['category'],
                    'description' => $dest['description'],
                    'image' => $dest['image'],
                    'price' => $dest['price'],
                    'status' => 'post',
                ]
            );
        }

        // Recalculate rating and reviews_count for all destinations based on comments
        foreach (Destination::all() as $destination) {
            $destination->recalculateRating();
        }
    }
}
