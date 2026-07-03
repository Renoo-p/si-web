<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        Recipe::query()->delete();
        $recipes = [
            // ====== 1. CEMILAN (7 RESEP) ======
            [
                'title' => 'Bakwan Sayur Garing', 'category' => 'Cemilan', 'category_time' => 'Cepat',
                'image_url' => 'https://i.pinimg.com/1200x/dc/7b/81/dc7b81e39e5f7275a73c34707c8d2941.jpg',
                'ingredients' => ['Kol diiris tipis', 'Wortel iris korek api', 'Tepung terigu 200g', 'Air secukupnya'],
                'steps' => ['Campur semua sayuran dan tepung.', 'Goreng di minyak panas sampai kuning keemasan.'], 'source_url' => 'https://cookpad.com/id/cari/bakwan%20sayur%20garing'
            ],
            [
                'title' => 'Cireng Rujak Pedas', 'category' => 'Cemilan', 'category_time' => 'Cepat',
                'image_url' => 'https://i.pinimg.com/1200x/f7/7d/e7/f77de7a2e1f9845ac78630c22aeb0463.jpg',
                'ingredients' => ['Tepung tapioka 250g', 'Daun bawang', 'Gula merah & cabai rawit'],
                'steps' => ['Buat adonan biang, campur tapioka kering, lalu goreng.', 'Sajikan dengan bumbu rujak cair.'], 'source_url' => 'https://cookpad.com/id/cari/cireng%20rujak%20pedas'
            ],
            [
                'title' => 'Tempe Mendoan Purwokerto', 'category' => 'Cemilan', 'category_time' => 'Cepat',
                'image_url' => 'https://dapurpintar.id/images/resep/tempe-mendoan-purwokerto.webp',
                'ingredients' => ['Tempe daun tipis', 'Tepung terigu & beras', 'Daun kucai iris'],
                'steps' => ['Celup tempe ke adonan tepung berbumbu.', 'Goreng setengah matang (lembek garing).'], 'source_url' => 'https://cookpad.com/id/cari/tempe%20mendoan%20purwokerto'
            ],
            [
                'title' => 'Pisang Goreng Pasir', 'category' => 'Cemilan', 'category_time' => 'Cepat',
                'image_url' => 'https://i.pinimg.com/736x/5d/0e/39/5d0e39e49662d288648ff8a8f33c6c4e.jpg',
                'ingredients' => ['Pisang kepok', 'Tepung terigu', 'Tepung panir/pasir'],
                'steps' => ['Celup pisang ke terigu cair, balur tepung panir.', 'Goreng hingga krispi.'], 'source_url' => 'https://cookpad.com/id/cari/pisang%20goreng%20pasir'
            ],
            [
                'title' => 'Jasuke Manis', 'category' => 'Cemilan', 'category_time' => 'Cepat',
                'image_url' => 'https://i.pinimg.com/736x/18/60/fc/1860fc6faf0fcd91e827fd75ad3095b5.jpg',
                'ingredients' => ['Jagung manis pipil', 'Margarin', 'Susu kental manis', 'Keju parut'],
                'steps' => ['Kukus jagung hingga matang.', 'Campur margarin, susu, dan taburi keju.'], 'source_url' => 'https://cookpad.com/id/cari/jagung%20susu%20keju%20manis'
            ],
            [
                'title' => 'Cilok Bumbu Kacang', 'category' => 'Cemilan', 'category_time' => 'Cepat',
                'image_url' => 'https://i.pinimg.com/736x/2c/4e/70/2c4e7024a57be1d4d8bd8a4d4edd9de1.jpg',
                'ingredients' => ['Tepung terigu & tapioka', 'Bawang putih', 'Bumbu kacang siap pakai'],
                'steps' => ['Campur tepung, bentuk bulat, lalu rebus.', 'Siram dengan saus bumbu kacang hangat.'], 'source_url' => 'https://cookpad.com/id/cari/cilok%20bumbu%20kacang'
            ],
            [
                'title' => 'Batagor Bandung Asli', 'category' => 'Cemilan', 'category_time' => 'Cepat',
                'image_url' => 'https://i.pinimg.com/736x/08/99/68/089968f6feab64fa54cd68271af2f9b1.jpg',
                'ingredients' => ['Tahu putih', 'Adonan ikan tenggiri', 'Kulit pangsit', 'Saus kacang'],
                'steps' => ['Isi tahu & pangsit dengan adonan ikan.', 'Goreng kering lalu potong-potong, siram saus.'], 'source_url' => 'https://i.pinimg.com/736x/08/99/68/089968f6feab64fa54cd68271af2f9b1.jpg'
            ],

            // ====== 2. MINUMAN (7 RESEP) ======
            [
                'title' => 'Es Teh Manis Lemon', 'category' => 'Minuman', 'category_time' => 'Sehat',
                'image_url' => 'https://i.pinimg.com/736x/fd/0b/34/fd0b347a94a16150a88f9f457969cf34.jpg',
                'ingredients' => ['Teh celup', 'Gula pasir', 'Jeruk lemon', 'Es batu'],
                'steps' => ['Seduh teh, larutkan gula.', 'Peras lemon dan tambahkan potongan es batu segar.'], 'source_url' => 'https://cookpad.com/id/cari/es%20teh%20%20lemon'
            ],
            [
                'title' => 'Es Teler Kelapa Muda', 'category' => 'Minuman', 'category_time' => 'Siang',
                'image_url' => 'https://i.pinimg.com/736x/b3/3b/34/b33b34c37f7f79f2b93b8f29af946b77.jpg',
                'ingredients' => ['Alpukat', 'Nangka', 'Kelapa muda', 'Susu kental manis', 'Es serut'],
                'steps' => ['Tata buah di mangkok.', 'Beri es serut dan siram susu kental manis.'], 'source_url' => 'https://cookpad.com/id/cari/es%20teler%20kelapa%20muda'
            ],
            [
                'title' => 'Jus Alpukat Kocok', 'category' => 'Minuman', 'category_time' => 'Sehat',
                'image_url' => 'https://i.pinimg.com/736x/a2/b6/d8/a2b6d82939bcd5658398ad16d3bcfbde.jpg',
                'ingredients' => ['Alpukat matang', 'Susu cokelat', 'Es batu hancur'],
                'steps' => ['Hancurkan alpukat di gelas dengan sendok.', 'Beri es batu dan lumuri susu cokelat di pinggiran gelas.'], 'source_url' => 'https://cookpad.com/id/cari/alpukat%20kocok'
            ],
            [
                'title' => 'Wedang Jahe Susu Hangat', 'category' => 'Minuman', 'category_time' => 'Sehat',
                'image_url' => 'https://i.pinimg.com/736x/32/7d/12/327d12e796fcb87dc273dc946a890a68.jpg',
                'ingredients' => ['Jahe geprek', 'Gula merah', 'Susu kental manis', 'Air'],
                'steps' => ['Rebus jahe dan gula merah hingga mendidih.', 'Tuangkan ke gelas, campurkan susu hangat.'], 'source_url' => 'https://cookpad.com/id/cari/wedang%20jahe%20susu%20hangat'
            ],
            [
                'title' => 'Es Cappuccino Cincau', 'category' => 'Minuman', 'category_time' => 'Cepat',
                'image_url' => 'https://i.pinimg.com/736x/54/42/6c/54426c64f7f73aae5035578f66a49916.jpg',
                'ingredients' => ['Kopi cappuccino sachet', 'Cincau hitam serut', 'Es batu'],
                'steps' => ['Blender cappuccino dengan air dan es.', 'Tuang ke gelas berisi serutan cincau hitam.'], 'source_url' => 'https://cookpad.com/id/cari/es%20cappucino%20cincau?event=search.suggestion&order=recent'
            ],
            [
                'title' => 'Matcha Latte Ice', 'category' => 'Minuman', 'category_time' => 'Sehat',
                'image_url' => 'https://i.pinimg.com/736x/16/34/99/1634992bc0b0aaeaf5506135c4a4d40f.jpg',
                'ingredients' => ['Bubuk matcha murni', 'Susu cair UHT', 'Madu / Gula cair'],
                'steps' => ['Larutkan matcha dengan sedikit air hangat.', 'Campurkan susu, madu, dan es batu.'], 'source_url' => 'https://cookpad.com/id/cari/matcha%20latte%20ice'
            ],
            [
                'title' => 'Es Kuwut Khas Bali', 'category' => 'Minuman', 'category_time' => 'Sehat',
                'image_url' => 'https://i.pinimg.com/1200x/8f/27/ad/8f27ad7e560db7fc0b8b383ce87bee47.jpg',
                'ingredients' => ['Kelapa muda serut', 'Melon serut', 'Biji selasih', 'Sirup melon', 'Jeruk nipis'],
                'steps' => ['Campur kelapa, melon, dan selasih.', 'Beri es batu, air kelapa, sirup melon, dan perasan jeruk nipis.'], 'source_url' => 'https://cookpad.com/id/cari/es%20kuwut%20khas%20bali'
            ],

            // ====== 3. ROTI & KUE (7 RESEP) ======
            [
                'title' => 'Martabak Manis Mini', 'category' => 'Roti/Kue', 'category_time' => 'Malam',
                'image_url' => 'https://i.pinimg.com/1200x/5e/38/d5/5e38d5ab5aae6e199944d18e91bb917e.jpg',
                'ingredients' => ['Tepung terigu', 'Ragi & Baking powder', 'Meses / Keju topping'],
                'steps' => ['Buat adonan terigu, diamkan.', 'Panggang di cetakan kecil, beri topping margarin & meses.'], 'source_url' => 'https://cookpad.com/id/cari/martabak%20manis%20mini'
            ],
            [
                'title' => 'Brownies Kukus Cokelat', 'category' => 'Roti/Kue', 'category_time' => 'Malam',
                'image_url' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=500',
                'ingredients' => ['Tepung terigu', 'Cokelat bubuk & DCC', 'Telur & Gula pasir'],
                'steps' => ['Kocok telur & gula, masukkan tepung dan cokelat leleh.', 'Kukus adonan selama 30 menit.'], 'source_url' => 'https://cookpad.com/id/cari/brownies%20kukus%20coklat'
            ],
            [
                'title' => 'Bolu Panggang Pandan', 'category' => 'Roti/Kue', 'category_time' => 'Siang',
                'image_url' => 'https://i.pinimg.com/1200x/7b/4a/97/7b4a978251a48940d5089522f4c2e52d.jpg',
                'ingredients' => ['2 butir telur', '50 gram gula pasir', '1/4 sdt emulsifier', '1/4 sdt vanila pasta', '45 gram terigu protein sedang', '6 gram tepung maizena', '8 gram susu bubuk', '30 gram butter', '1/4 sdt pasta pandan' ],
                'steps' => ['Ayak tepung terigu, maizena dan susu bubuk, lalu sisihkan', 'Siapkan loyang yang sudah di beri baking paper, sisihkan', 'Lelehkan butter', 'Panaskan oven', 'Mixer dengan kecepatan paling tinggi untuk telur, gula, emulsifier dan vanila hingga mengembang, kental dan berjejak', 'Masukkan tepung, mixer dengan kecepatan paling rendah sebentar saja sampai rata', 'Masukkan butter leleh, dan pasta pandan, mixer dengan kecepatan paling rendah sebentar saja sampai rata', 'Aduk balik perlahan adonan dengan spatula sampai seluruh adonan benar benar tercampur rata', 'Tuang adonan ke dalam loyang, lalu panggang dengan suhu 150 derajat celsius selama 25-30 menit', 'Setelah bolu matang, angkat dan keluarkan dari loyang, dinginkan', 'Beri topping sesuai selera' ], 'source_url' => 'https://cookpad.com/id/cari/bolu%20panggang%20pandan'
            ],
            [
                'title' => 'Roti Bakar Bandung Premium', 'category' => 'Roti/Kue', 'category_time' => 'Malam',
                'image_url' => 'https://i.pinimg.com/736x/b5/b9/87/b5b987f94012b5d6dc40b3ecdc40137e.jpg',
                'ingredients' => ['Roti tumpuk bandung', 'Selai cokelat/stroberi', 'Mentega', 'Keju parut (untuk topping)','Mesis coklat (untuk topping)'],
                'steps' => ['Belah roti, oles selai dan mentega melimpah.', 'Panggang di atas wajan datar hingga kecokelatan.','Sajikan dengan topping sesuai selera'], 'source_url' => 'https://cookpad.com/id/cari/roti%20bakar%20bandung'
            ],
            [
                'title' => 'Roti Sobek Kasur Lembut', 'category' => 'Roti/Kue', 'category_time' => 'Pagi',
                'image_url' => 'https://i.pinimg.com/736x/25/0c/f7/250cf786a0dc2aa99f00df0abc95f6d8.jpg',
                'ingredients' => ['Tepung protein tinggi', 'Ragi instan', 'Susu cair', 'Isian cokelat'],
                'steps' => ['Uleni adonan hingga kalis, bagi menjadi bulatan berjejer.','Beri isian cokelat pada setiap bulatan dan rapatkan. ', 'Diamkan sampai mengembang, lalu oven.'], 'source_url' => 'https://cookpad.com/id/cari/roti%20sobek%20kasur%20lembut'
            ],
            [
                'title' => 'Klepon Gula Merah Melt', 'category' => 'Roti/Kue', 'category_time' => 'Cepat',
                'image_url' => 'https://i.pinimg.com/736x/a1/ac/9b/a1ac9b9af759d516b18780f7043ee9a9.jpg',
                'ingredients' => ['Tepung ketan', 'Air daun suji', 'Gula merah sisir', 'Kelapa parut kukus'],
                'steps' => ['Adoni tepung ketan, isi tengahnya dengan gula merah, bulatkan.', 'Rebus di air mendidih, gulingkan di kelapa parut.'], 'source_url' => 'https://cookpad.com/id/cari/klepon%20gula%20merah%20melt'
            ],
            [
                'title' => 'Kue Lumpur Kentang', 'category' => 'Roti/Kue', 'category_time' => 'Siang',
                'image_url' => 'https://i.pinimg.com/736x/5e/1c/2a/5e1c2a147053b952e9605fc2ee4e2215.jpg',
                'ingredients' => ['Kentang kukus halus', 'Tepung terigu', 'Santan', 'Kismis untuk hiasan'],
                'steps' => ['Blender kentang, terigu, santan, telur, gula.', 'Panggang di cetakan kue lumpur, beri kismis di atasnya.'], 'source_url' => 'https://cookpad.com/id/cari/kue%20lumpur%20kentang'
            ],

            // ====== 4. MAKANAN BERAT (9 RESEP) ======
            [
                'title' => 'Nasi Goreng Kampung', 'category' => 'Makanan Berat', 'category_time' => 'Pagi',
                'image_url' => 'https://i.pinimg.com/736x/48/7f/2d/487f2d664ab0a17471c0229f39cee0b9.jpg',
                'ingredients' => ['Nasi putih', 'Bawang merah & putih', 'Cabai rawit', 'Telur'],
                'steps' => ['Tumis bumbu halus, masukkan telur orak-arik.', 'Masukkan nasi, aduk rata dengan garam.'], 'source_url' => 'https://cookpad.com/id/cari/nasi%20goreng%20kampung'
            ],
            [
                'title' => 'Rendang Daging Sapi Minang', 'category' => 'Makanan Berat', 'category_time' => 'Siang',
                'image_url' => 'https://i.pinimg.com/736x/cf/3d/b3/cf3db3f294804090c83eb546c88da565.jpg',
                'ingredients' => ['Daging sapi', 'Santan kental asli', 'Bumbu rendang komplit'],
                'steps' => ['Masak santan dan bumbu halus sampai berminyak.', 'Masukkan daging, masak dengan api kecil sampai menghitam.'], 'source_url' => 'https://cookpad.com/id/cari/rendang%20daging%20sapi%20minang'
            ],
            [
                'title' => 'Ayam Goreng Lengkuas', 'category' => 'Makanan Berat', 'category_time' => 'Siang',
                'image_url' => 'https://i.pinimg.com/736x/9c/1b/2c/9c1b2c9d73718c43900c6b7d47438f54.jpg',
                'ingredients' => ['Ayam potong', 'Lengkuas parut banyak', 'Bumbu kuning ungkep'],
                'steps' => ['Ungkep ayam bersama bumbu kuning dan parutan lengkuas.', 'Goreng ayam beserta remahan lengkuasnya hingga garing.'], 'source_url' => 'https://cookpad.com/id/cari/ayam%20goreng%20lengkuas'
            ],
            [
                'title' => 'Sate Ayam Madura', 'category' => 'Makanan Berat', 'category_time' => 'Malam',
                'image_url' => 'https://i.pinimg.com/736x/6b/0e/49/6b0e4913e0ad120776bb65757180ad84.jpg',
                'ingredients' => ['Fillet dada ayam', 'Saus kacang kental', 'Kecap manis', 'Bawang merah iris'],
                'steps' => ['Potong kotak ayam, tusuk ke lidi, bakar sambil dioles kecap.', 'Sajikan dengan siraman saus kacang dan bawang merah.'], 'source_url' => 'https://cookpad.com/id/cari/sate%20ayam%20madura'
            ],
            [
                'title' => 'Soto Ayam Lamongan Koya', 'category' => 'Makanan Berat', 'category_time' => 'Pagi',
                'image_url' => 'https://i.pinimg.com/736x/39/9d/33/399d330dbf33d5510c0f2c785e2343da.jpg',
                'ingredients' => ['Ayam bumbu kuah soto', 'Soun & Kol', 'Kerupuk udang + bawang putih (untuk koya)','Telur rebus'],
                'steps' => ['Buat kuah soto ayam gurih.', 'Sajikan isi soto di mangkok, siram kuah panas, taburi bubuk koya, beri telur rebus.'], 'source_url' => 'https://cookpad.com/id/cari/soto%20ayam%20lamongan%20koya'
            ],
            [
                'title' => 'Gado-Gado Betawi', 'category' => 'Makanan Berat', 'category_time' => 'Sehat',
                'image_url' => 'https://i.pinimg.com/736x/96/7a/e3/967ae37713b866aacf3c90ba48dc73b9.jpg',
                'ingredients' => ['Kacang panjang, tauge, kol rebus', 'Tahu & Tempe goreng', 'Bumbu kacang ulek'],
                'steps' => ['Ulek bumbu kacang bersama jeruk limau.', 'Potong tahu tempe dan sayuran, campur merata ke bumbu.'], 'source_url' => 'https://cookpad.com/id/cari/gado%20gado%20betawi'
            ],
            [
                'title' => 'Bakso Sapi Kuah Gurih', 'category' => 'Makanan Berat', 'category_time' => 'Malam',
                'image_url' => 'https://i.pinimg.com/736x/f7/6c/93/f76c93a3a23c2666e107ada4c4f33aec.jpg',
                'ingredients' => ['Pentol bakso sapi', 'Tulang sapi (untuk kaldu)', 'Mie kuning & bihun'],
                'steps' => ['Rebus tulang sapi bersama bawang putih geprek untuk kuah.', 'Masukkan bakso hingga mengapung, tata mie lalu sajikan.'], 'source_url' => 'https://cookpad.com/id/cari/bakso%20sapi%20kuah%20gurih'
            ],
            [
                'title' => 'Capcay Kuah Sayur', 'category' => 'Makanan Berat', 'category_time' => 'Sehat',
                'image_url' => 'https://i.pinimg.com/736x/f9/2c/17/f92c178d38efd6b57ec1c357f8525188.jpg',
                'ingredients' => ['Wortel, kembang kol, sawi hijau', 'Bakso sapi iris', 'Saus tiram & Maizena'],
                'steps' => ['Tumis bawang putih, masukkan bakso dan sayuran keras.', 'Tambahkan air, saus tiram, lalu kentalkan dengan sedikit maizena.'], 'source_url' => 'https://cookpad.com/id/cari/capcay%20kuah%20sayur'
            ],
            [
                'title' => 'Mie Goreng Jawa Tradisional', 'category' => 'Makanan Berat', 'category_time' => 'Malam',
                'image_url' => 'https://i.pinimg.com/736x/2a/eb/bc/2aebbc74f0e08a75cd8fc06f0564e2e1.jpg',
                'ingredients' => ['Mie basah/kuning', 'Kemiri & Bawang halus', 'Kecap manis', 'Daun caisim'],
                'steps' => ['Tumis bumbu halus kemiri dan bawang.', 'Masukkan mie, caisim, kecap manis, garam, aduk merata hingga matang.'], 'source_url' => 'https://cookpad.com/id/cari/mie%20goreng%20jawa%20tradisional'
            ]
        ];

        foreach ($recipes as $recipe) {
            Recipe::create($recipe);
        }
    }
}