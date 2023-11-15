<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidatesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Candidate::create([
            'visi' => 'Indonesia adil makmur untuk semua.',
            'misi' => 'Memastikan ketersediaan kebutuhan pokok dan biaya hidup murah melalui kemandirian pangan, ketahanan energi dan kedaulatan air.|Mengentaskan kemiskinan dengan memperluas kesempatan berusaha dan menciptakan lapangan kerja, mewujudkan upah berkeadilan dan Menjamin kemajuan ekonomi berbasis kemandirian dan pemerataan, serta mendukung korporasi indonesia berhasil di negeri sendiri dan bertumbuh di kancah global.|Mewujudkan keadilan ekologis berkelanjutan untuk generasi mendatang.|Membangun kota dan desa berbasis kawasan yang manusiawi, berkeadilan dan saling memajukan.|Mewujudkan manusia indonesia yang sehat, cerdas, produktif, berakhlak, serta berbudaya.|Mewujudkan keluarga indonesia yang sejahtera dan bahagia sebagai akar kekuatan bangsa.|Memperkuat sistem pertahanan dan keamanan negara, serta meningkatan peran dan kepemimpinan indonesia dalam kancah politik global untuk memujudkan kepentingan nasional dan perdamaian dunia.|Memulihkan kualitas demokrasi, menegakkan hukum dan ham, memberantas korupsi tanpa tebang pilih, serta menyelenggarakan pemerintahan yang berpihak pada rakyat.',
            'image' => 'https://pollingjatim.com/assets/image/newpaslon1.png',
            'paslon' => 'Anies Baswedan | Muhaimin Iskandar',
            'total_vote' => 0
        ]);

        Candidate::create([
            'visi' => 'Menuju indonesia unggul, gerak cepat mewujudkan negara maritim yang adil dan lestari.',
            'misi' => 'Mempercepat pembangunan manusia indonesia unggul yang berkualitas, produktif dan berkepribadian.|Mempercepat penguasaan sains dan teknologi melalui percepatan riset dan inovasi (R&I) berdikari.|Mempercepat pembangunan ekonomi berdikari berbasis pengetahuan dan nilai tambah.|Mempercepat pemerataan pembangunan ekonomi.|Mempercepat pembangunan sistem digital nasional.|Mempercepat perwujudan lingkungan hidup yang berkelanjutan melalui ekonomi hijau dan biru.|Mempercepat pelaksanaan demokrasi substantif, penghormatan ham, supremasi hukum yang berkeadilan, dan keamanan yang profesional.|Mempercepat peningkatan peran indonesia dalam mewujudkan tata dunia baru yang lebih berkeadilan melalui politik luar negeri bebas aktif dan memperkuat pertahanan negara.',
            'image' => 'https://pollingjatim.com/assets/image/newpaslon2.png',
            'paslon' => 'Prabowo Subianto | Gibran Rakabuming Raka',
            'total_vote' => 0
        ]);

        Candidate::create([
            'visi' => 'Bersama Indonesia Maju, Menuju Indonesia Emas 2045.',
            'misi' => 'Memperkokoh ideologi Pancasila, demokrasi, dan hak asasi manusia (HAM).|Memantapkan sistem pertahanan keamanan negara dan mendorong kemandirian bangsa melalui swasembada pangan, energi, air, ekonomi kreatif, ekonomi hijau, dan ekonomi biru.|Meningkatkan lapangan kerja yang berkualitas, mendorong kewirausahaan, mengembangkan industri kreatif, dan melanjutkan pengembangan infrastruktur.|Memperkuat pembangunan sumber daya manusia (SDM), sains, teknologi, pendidikan, kesehatan, prestasi olahraga, kesetaraan gender, serta penguatan peran perempuan, pemdua dan penyandang disabilitas.|Melanjutkan hilirisasi dan industrialisasi untuk meningkatkan nilai tambah di dalam negeri.|Membangun dari desa dan dari bawah untuk pemerataan ekonomi dan pemberantasan kemiskinan.|Memperkuat reformasi politik, hukum dan birokrasi, serta memperkuat pencegahan dan pemberantasan korupsi dan narkoba.|Memperkuat penyelarasan kehidupan yang harmonis dengan lingkungan, alam dan budaya, serta peningkatan toleransi antarumat beragama untuk mencapai masyarakat yang adil dan makmur.',
            'image' => 'https://pollingjatim.com/assets/image/newpaslon3.png',
            'paslon' => 'Ganjar Pranowo | Mahfud MD',
            'total_vote' => 0
        ]);
    }
}
