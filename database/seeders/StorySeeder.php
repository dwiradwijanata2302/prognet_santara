<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\User;
use App\Models\Region;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Get region IDs
        $regionSumbar = Region::where('name', 'Sumatra Barat')->first();
        $regionJabar = Region::where('name', 'Jawa Barat')->first();
        $regionJateng = Region::where('name', 'Jawa Tengah')->first();
        $regionJatim = Region::where('name', 'Jawa Timur')->first();
        $regionSumut = Region::where('name', 'Sumatra Utara')->first();

        $stories = [
            [
                'title' => 'Malin Kundang',
                'region_id' => $regionSumbar->id,
                'content' => 'Dahulu kala, di pesisir pantai Sumatra Barat, hiduplah seorang anak bernama Malin Kundang. Ia hidup bersama ibunya dalam kemiskinan. Suatu hari, Malin memutuskan untuk merantau mencari kekayaan.

Setelah bertahun-tahun berlalu, Malin menjadi saudagar kaya dan menikah dengan putri saudagar. Ketika kapalnya singgah di kampung halamannya, ibunya yang sudah tua datang menemuinya dengan penuh kerinduan.

Namun, Malin yang malu dengan keadaan ibunya yang miskin dan kumuh, malah mengingkari ibunya di depan istrinya. Ia berkata bahwa ia bukan anaknya. Ibunya yang sangat sedih dan kecewa lalu mengutuk Malin menjadi batu.

Tidak lama kemudian, terjadi badai besar di laut. Kapal Malin karam dan tubuhnya terdampar di pantai, membatu hingga sekarang. Batu tersebut menjadi pengingat akan pentingnya berbakti kepada orang tua.',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Sangkuriang',
                'region_id' => $regionJabar->id,
                'content' => 'Di daerah Jawa Barat, hiduplah seorang putri cantik bernama Dayang Sumbi. Suatu hari, ia secara tidak sengaja meminta bantuan seekor anjing ajaib bernama Tumang untuk mengambil alat tenunnya yang jatuh. Sebagai janji, ia akan menikahi siapa yang mengambilkannya.

Tumang yang sebenarnya adalah dewa terkutuk, kemudian menikahi Dayang Sumbi dan mereka dikaruniai seorang anak bernama Sangkuriang. Sangkuriang tumbuh menjadi pemuda yang suka berburu.

Suatu hari, Sangkuriang berburu bersama Tumang. Karena tidak mendapat hasil buruan, ia membunuh Tumang dan memberikan dagingnya kepada ibunya. Dayang Sumbi yang mengetahui hal ini sangat marah dan memukul kepala Sangkuriang dengan sendok nasi, lalu mengusirnya.

Bertahun-tahun kemudian, Sangkuriang kembali dan bertemu dengan Dayang Sumbi yang awet muda. Tanpa mengenali ibunya sendiri, ia jatuh cinta. Dayang Sumbi mengenali tanda di kepala Sangkuriang dan berusaha menggagalkan pernikahan dengan meminta Sangkuriang membuat perahu dan danau dalam semalam.

Sangkuriang hampir berhasil, namun Dayang Sumbi meminta penduduk menumbuk lesung agar ayam berkokok lebih awal. Sangkuriang marah dan menendang perahu yang kemudian menjadi Gunung Tangkuban Perahu.',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Timun Mas',
                'region_id' => $regionJateng->id,
                'content' => 'Hiduplah sepasang suami istri tani yang belum dikaruniai anak. Mereka meminta bantuan kepada raksasa untuk diberikan anak. Raksasa menyetujui dengan syarat anak tersebut harus diserahkan ketika berusia 17 tahun.

Lahirlah seorang gadis cantik dari buah timun emas yang dinamai Timun Mas. Ketika menginjak usia 17 tahun, raksasa datang menagih janjinya. Sang ibu tidak rela dan memberikan empat bungkusan ajaib kepada Timun Mas untuk melarikan diri.

Timun Mas berlari meninggalkan raksasa. Saat raksasa hampir menangkapnya, ia melempar bungkusan pertama berisi biji mentimun yang berubah menjadi hutan mentimun. Raksasa terus mengejar.

Bungkusan kedua berisi jarum menjadi pohon bambu runcing, ketiga berisi garam menjadi laut, dan terakhir terasi menjadi lautan lumpur mendidih yang menenggelamkan raksasa. Timun Mas selamat dan hidup bahagia bersama orang tuanya.',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Roro Jonggrang',
                'region_id' => $regionJateng->id,
                'content' => 'Bandung Bondowoso, seorang pangeran sakti, jatuh cinta pada putri cantik bernama Roro Jonggrang. Namun, Roro Jonggrang tidak mau menikah dengannya karena Bandung telah membunuh ayahnya dalam peperangan.

Untuk menolak lamaran, Roro Jonggrang memberikan syarat yang mustahil: membangun 1000 candi dalam satu malam. Dengan bantuan jin dan makhluk halus, Bandung hampir menyelesaikan tugas tersebut.

Roro Jonggrang panik melihat hampir 1000 candi berdiri. Ia meminta para dayang untuk menumbuk lesung dan menyalakan api di sebelah timur agar ayam berkokok, memberi kesan fajar telah tiba.

Jin-jin dan makhluk halus menghentikan pekerjaan mereka karena mengira matahari akan terbit. Bandung Bondowoso menyadari tipu muslihat Roro Jonggrang dan sangat marah. Dalam kemarahannya, ia mengutuk Roro Jonggrang menjadi arca untuk melengkapi candi yang ke-1000.

Candi tersebut sekarang dikenal sebagai Candi Prambanan, dan arca Roro Jonggrang menjadi arca utama di candi tersebut.',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Bawang Merah dan Bawang Putih',
                'region_id' => $regionJatim->id,
                'content' => 'Bawang Putih hidup bersama ayah dan ibu tirinya serta Bawang Merah, anak kandung ibu tirinya. Setelah ayahnya meninggal, Bawang Putih diperlakukan seperti pembantu dan sering disiksa.

Suatu hari, Bawang Putih mencuci pakaian di sungai dan salah satu pakaian ibu tirinya hanyut. Ia mengikuti pakaian tersebut dan bertemu dengan nenek tua yang memintanya untuk tinggal dan membantunya beberapa hari.

Bawang Putih dengan senang hati membantu nenek itu. Sebagai terima kasih, nenek memberikannya labu dan memintanya untuk membukanya di rumah. Ketika dibuka, labu tersebut berisi emas dan permata.

Ibu tiri yang iri menyuruh Bawang Merah melakukan hal yang sama. Namun, Bawang Merah bersikap malas dan tidak sopan kepada nenek tersebut. Nenek tetap memberinya labu, tapi ketika dibuka, isinya adalah binatang berbisa dan makhluk mengerikan.

Sejak saat itu, Bawang Putih hidup bahagia, sementara Bawang Merah dan ibunya menyesali perbuatan mereka. Cerita ini mengajarkan bahwa kebaikan akan dibalas dengan kebaikan.',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Legenda Danau Toba',
                'region_id' => $regionSumut->id,
                'content' => 'Di sebuah desa di Sumatra Utara, hiduplah seorang pemuda yang gemar memancing. Suatu hari, ia mendapat ikan mas yang sangat besar dan indah. Betapa terkejutnya ketika ikan itu berubah menjadi seorang putri cantik.

Putri itu ternyata adalah ikan yang terkutuk. Pemuda tersebut jatuh cinta dan menikahinya dengan satu syarat: tidak boleh menceritakan asal-usul sang putri kepada siapa pun. Mereka hidup bahagia dan dikaruniai seorang anak laki-laki.

Anak mereka tumbuh menjadi anak yang nakal dan rakus. Suatu hari, sang anak memakan semua bekal makanan ayahnya. Dalam kemarahan, sang ayah tanpa sengaja mengucapkan kata-kata yang tabu: "Dasar anak ikan!"

Sang istri yang mendengar hal ini sangat sedih karena suaminya telah melanggar janji. Langit mendung dan hujan deras turun tanpa henti. Air mulai menggenangi desa dan membentuk danau yang sangat luas.

Sang istri dan anak menghilang. Danau yang terbentuk itulah yang sekarang dikenal sebagai Danau Toba, dan pulau kecil di tengahnya adalah Pulau Samosir.',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Lutung Kasarung',
                'region_id' => $regionJabar->id,
                'content' => 'Prabu Tapa Agung memiliki dua putri: Purbararang yang cantik namun sombong, dan Purbasari yang cantik hati dan rupanya. Sang Raja memilih Purbasari sebagai penggantinya, membuat Purbararang iri.

Purbararang dan tunangannya, Indrajaya, membuat rencana jahat. Mereka meminta bantuan nenek sihir untuk mengutuk Purbasari. Kulit Purbasari berubah menjadi hitam dan berbintik-bintik.

Purbasari diusir ke hutan dan hidup di sebuah gubuk. Di hutan, ia berteman dengan seekor lutung (monyet besar) yang selalu membantunya. Lutung itu sebenarnya adalah pangeran tampan yang dikutuk.

Suatu hari, Purbararang datang menghina Purbasari dan menantangnya untuk memamerkan tunangan masing-masing. Lutung berubah menjadi pangeran tampan bernama Guru Minda yang jauh lebih tampan dari Indrajaya.

Kutukan Purbasari pun lepas, kulitnya kembali putih dan bersih. Purbararang dan Indrajaya yang kalah dan malu, melarikan diri. Purbasari dan Guru Minda menikah dan menjadi pemimpin kerajaan yang bijaksana.',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Keong Mas',
                'region_id' => $regionJatim->id,
                'content' => 'Candra Kirana adalah putri yang cantik jelita dan akan menikah dengan Pangeran Inu Kertapati. Namun, kakak tirinya yang bernama Dewi Galuh iri dan meminta bantuan nenek sihir untuk mengutuk Candra Kirana.

Candra Kirana berubah menjadi keong mas (siput emas) dan terbuang ke sungai. Sementara itu, Pangeran Inu Kertapati yang kehilangan tunangannya berkelana mencarinya ke mana-mana.

Keong mas tersebut ditemukan oleh seorang nenek yang tinggal di tepi sungai. Setiap hari, ketika nenek pergi, keong berubah menjadi Candra Kirana dan memasak serta membersihkan rumah.

Suatu hari, nenek pulang lebih cepat dan melihat keajaiban itu. Ia memecahkan cangkang keong, dan Candra Kirana kembali menjadi manusia selamanya. Pangeran Inu Kertapati yang sedang berkelana melewati rumah tersebut dan menemukan Candra Kirana.

Mereka akhirnya menikah dan hidup bahagia. Sementara Dewi Galuh mendapat hukuman atas perbuatan jahatnya.',
                'user_id' => $admin->id,
            ],
        ];

        foreach ($stories as $story) {
            Story::create($story);
        }
    }
}