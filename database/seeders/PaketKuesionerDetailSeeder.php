<?php

namespace Database\Seeders;

use App\Models\PaketKuesioner;
use App\Models\PaketQuesionerDetail;
use Illuminate\Database\Seeder;

class PaketKuesionerDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes123',
            'pertanyaan' => 'Apakah kamu suka?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 1,
            'is_required' => 1,
            'options' => json_encode(["ya", "tidak"]),
            'index' => 1,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1234',
            'pertanyaan' => 'Apakah kamu bisa?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 1,
            'is_required' => 1,
            'options' => json_encode(["ya", "tidak"]),
            'index' => 2,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1235',
            'pertanyaan' => 'Apakah kamu kuat?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 1,
            'is_required' => 1,
            'options' => json_encode(["ya", "tidak"]),
            'index' => 3,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes123545',
            'pertanyaan' => 'pilih yang kamu suka?',
            'tipe_id' => 12,
            'id_paket_quesioners' => 1,
            'is_required' => 1,
            'options' => json_encode(["fasih", "ahnaf", "marzuki"]),
            'index' => 4,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1235',
            'pertanyaan' => 'Apakah kamu kuat?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 1,
            'is_required' => 1,
            'options' => json_encode(["ya", "tidak"]),
            'index' => 5,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tes1236',
            'pertanyaan' => 'Berikan alasan anda?',
            'tipe_id' => 1,
            'id_paket_quesioners' => 1,
            'is_required' => 1,
            'index' => 6,
        ]);



        // Tracer Study
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'kdptimsmh',
            'pertanyaan' => 'Kode Perguruan Tinggi',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode(["005019"]),
            'index' => 1,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'kdpstmsmh',
            'pertanyaan' => 'Kode Program Studi',
            'tipe_id' => 10,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 2,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'nimhsmsmh',
            'pertanyaan' => 'NIM',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 3,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'nmmhsmsmh',
            'pertanyaan' => 'Nama Lengkap',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 4,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'telpomsmh',
            'pertanyaan' => 'Nomor Telepon/HP (Whatsapp)',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 5,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'emailmsmh',
            'pertanyaan' => 'Alamat Email',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 6,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'tahun_lulus',
            'pertanyaan' => 'Tahun Lulus',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode(["2022"]),
            'index' => 7,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'nik',
            'pertanyaan' => 'NIK (Nomor Induk Kependudukan/No KTP)',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 8,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'npwp',
            'pertanyaan' => 'NPWP (Nomor Pokok Wajib Pajak)',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 9,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f8',
            'pertanyaan' => 'Jelaskan status Anda saat ini?',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Bekerja (full time/part time)",
                "2 - Belum Memungkinakn Bekerja",
                "3 - Wiraswasta",
                "4 - Melanjutkan Pendidikan",
                "5 - Tidak kerja tetapi sedang mencari kerja",
            ]),
            'index' => 10,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f504',
            'pertanyaan' => 'Apakah Anda telah mendapatkan pekerjaan <= 6 bulan / termasuk bekerja sebelum lulus?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - ya",
                "2 - tidak"
            ]),
            'index' => 11,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f502',
            'pertanyaan' => 'Berapa bulan anda mendapatkan pekerjaan SEBELUM LULUS?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'index' => 12,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f505',
            'pertanyaan' => 'Berapa rata-rata pendapatan Anda per bulan ?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                'Rp. 1.000.000',
                'Rp. 1.500.000',
                'Rp. 2.000.000',
                'Rp. 2.500.000',
                'Rp. 3.000.000',
                'Rp. 3.500.000',
                'Rp. 4.000.000',
                'Rp. 4.500.000',
                'Rp. 5.000.000',
                'Rp. 6.000.000',
                '>Rp. 8.000.000',
            ]),
            'index' => 13,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f506',
            'pertanyaan' => 'Berapa bulan Anda MENDAPATKAN PEKERJAAN SETELAH LULUS?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'index' => 14,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f5a1',
            'pertanyaan' => 'Dimana lokasi provinsi tempat Anda bekerja??',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "010000 - Prov. D.K.I Jakarta",
                "020000 - Prov. Jawa Barat",
            ]),
            'index' => 15,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f5a2',
            'pertanyaan' => 'Dimana lokasi kabupaten/kota tempat Anda bekerja?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "010100 - Kab. Kepulauan Seribu",
                "016000 - Kota Jakarta Pusat",
            ]),
            'index' => 16,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1101',
            'pertanyaan' => 'Apa jenis perusahaan/instansi/institusi tempat anda bekerja sekarang?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Instansi pemerintah",
                "2 - Organisasi non-profit/Lembaga Swadaya Masyarakat",
                "3 - Perusahaan swasta",
                "4 - Wiraswasta/perusahaan sendiri",
                "6 - BUMN/BUMD",
                "7 - Institusi/Organisasi Multilateral",
                "5 - Lainnya",
            ]),
            'index' => 17,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f5b',
            'pertanyaan' => 'Apa nama perusahaan/kantor tempat Anda bekerja?',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 18,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f5c',
            'pertanyaan' => 'Bila Anda berwiraswasta, apa posisi/jabatan Anda saat ini ?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Founder",
                "2 - Co-Founder",
                "3 - Staff",
                "4 - Frelance Kerja Lepas",
            ]),
            'index' => 19,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f5d',
            'pertanyaan' => 'Apa tingkatan tempat kerja Anda?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Lokal/wilayah/wiraswasta tidak berbadan hukum",
                "2 - Nasional/wiraswasta berbadan hukum",
                "3 - Multinasional/Internasional",
            ]),
            'index' => 21,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f18a',
            'pertanyaan' => 'Sumber biaya Studi Lanjut Anda?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "Biaya Sendiri",
                "Bea Siswa",
            ]),
            'index' => 22,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f18b',
            'pertanyaan' => 'Nama Perguruan Tinggi Studi Lanjut Anda?',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 23,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f18c',
            'pertanyaan' => 'Nama Program Studi Studi Lanjut Anda?',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 24,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f18d',
            'pertanyaan' => 'Tanggal Masuk Awal Studi Lanjut Anda?',
            'tipe_id' => 5,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 25,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1201',
            'pertanyaan' => 'Sebutkan sumberdana dalam pembiayaan kuliah? (bukan ketika Studi Lanjut)',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Biaya Sendiri/Keluarga",
                "2 - Beasiswa ADIK",
                "3 - Beasiswa BIDIKMISI",
                "4 - Beasiswa PPA",
                "5 - Beasiswa AFIRMASI",
                "6 - Beasiswa Perusahaan/Swasta",
                "7 - Lainnya",
            ]),
            'index' => 26,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f14',
            'pertanyaan' => 'Seberapa erat hubungan bidang studi dengan pekerjaan Anda?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangar Erat",
                "2 - Erat",
                "3 - Cukup Erat",
                "4 - Kurang Erat",
                "5 - Tidak sama sekali",
            ]),
            'index' => 27,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f15',
            'pertanyaan' => 'Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan anda saat ini?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Setingkat lebih tinggi",
                "2 - Tingkat yang sama",
                "3 - Setingkat lebih rendah",
                "4 - Tidak perlu pendidikan tinggi",
            ]),
            'index' => 28,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1761',
            'pertanyaan' => 'Pada tingkat mana kompetensi ETIKA anda pada SAAT LULUS?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 29,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1762',
            'pertanyaan' => 'Pada tingkat mana kompetensi ETIKA anda pada SAAT INI?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 30,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1763',
            'pertanyaan' => 'Pada tingkat mana kompetensi KEAHLIAN BERDASARKAN BIDANG ILMU anda kuasai pada SAAT LULUS?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 31,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1764',
            'pertanyaan' => 'Pada tingkat mana kompetensi KEAHLIAN BERDASARKAN BIDANG ILMU anda kuasai pada SAAT INI?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 32,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1765',
            'pertanyaan' => 'Pada tingkat mana kompetensi BAHASA INGGRIS anda kuasai pada SAAT LULUS?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 33,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1766',
            'pertanyaan' => 'Pada tingkat mana kompetensi BAHASA INGGRIS anda kuasai pada SAAT INI?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 34,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1767',
            'pertanyaan' => 'Pada tingkat mana kompetensi TEKNOLOGI INFORMASI anda kuasai pada SAAT LULUS? ',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 35,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1768',
            'pertanyaan' => 'Pada tingkat mana kompetensi TEKNOLOGI INFORMASI anda kuasai pada SAAT INI?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 36,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1769',
            'pertanyaan' => 'Pada tingkat mana kompetensi KOMUNIKASI anda kuasai pada SAAT LULUS?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 37,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1770',
            'pertanyaan' => 'Pada tingkat mana kompetensi KOMUNIKASI anda kuasai pada SAAT INI?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 38,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1771',
            'pertanyaan' => 'Pada tingkat mana kompetensi KERJA SAMA TIM anda pada SAAT LULUS?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 39,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1772',
            'pertanyaan' => 'Pada tingkat mana kompetensi KERJA SAMA TIM anda pada SAAT INI?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 40,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1773',
            'pertanyaan' => 'Pada tingkat mana kompetensi PENGEMBANGAN DIRI anda pada SAAT LULUS?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 41,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1774',
            'pertanyaan' => 'Pada tingkat mana kompetensi PENGEMBANGAN DIRI anda pada SAAT INI?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Rendah",
                "2 - Rendah",
                "3 - Netral",
                "4 - Tinggi",
                "5 - Sangat Tinggi",
            ]),
            'index' => 42,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f21',
            'pertanyaan' => 'Perkuliahan',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Besar",
                "2 - Besar",
                "3 - Cukup Besar",
                "4 - Kurang",
                "5 - Tidak Sama Sekali",
            ]),
            'index' => 43,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f22',
            'pertanyaan' => 'Demonstrasi',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Besar",
                "2 - Besar",
                "3 - Cukup Besar",
                "4 - Kurang",
                "5 - Tidak Sama Sekali",
            ]),
            'index' => 44,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f23',
            'pertanyaan' => 'Partisipasi dalam proyek riset',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Besar",
                "2 - Besar",
                "3 - Cukup Besar",
                "4 - Kurang",
                "5 - Tidak Sama Sekali",
            ]),
            'index' => 45,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f24',
            'pertanyaan' => 'Magang',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Besar",
                "2 - Besar",
                "3 - Cukup Besar",
                "4 - Kurang",
                "5 - Tidak Sama Sekali",
            ]),
            'index' => 46,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f25',
            'pertanyaan' => 'Praktikum',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Besar",
                "2 - Besar",
                "3 - Cukup Besar",
                "4 - Kurang",
                "5 - Tidak Sama Sekali",
            ]),
            'index' => 47,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f26',
            'pertanyaan' => 'Kerja Lapangan',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Besar",
                "2 - Besar",
                "3 - Cukup Besar",
                "4 - Kurang",
                "5 - Tidak Sama Sekali",
            ]),
            'index' => 48,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f27',
            'pertanyaan' => 'Diskusi',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Sangat Besar",
                "2 - Besar",
                "3 - Cukup Besar",
                "4 - Kurang",
                "5 - Tidak Sama Sekali",
            ]),
            'index' => 49,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f301',
            'pertanyaan' => 'Kapan anda mulai mencari pekerjaan?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Saya mencari kerja sebelum lulus",
                "2 - Saya mencari kerja sesudah wisuda",
                "3 - Saya tidak mencari kerja",
            ]),
            'index' => 50,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f302',
            'pertanyaan' => 'Saya mencari pekerjaan, Kira-kira ....... bulan SEBELUM lulus',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'index' => 51,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f303',
            'pertanyaan' => 'Saya mencari pekerjaan, Kira-kira ....... bulan SETELAH wisuda',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'index' => 52,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f401',
            'pertanyaan' => 'Melalui iklan di koran/majalah, brosur ?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 53,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f402',
            'pertanyaan' => 'Melamar ke perusahaan tanpa mengetahui lowongan yang ada?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 54,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f403',
            'pertanyaan' => 'Pergi ke bursa/pameran kerja',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 55,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f404',
            'pertanyaan' => 'Mencari lewat internet/iklan online/milis',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 56,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f405',
            'pertanyaan' => 'Dihubungi oleh perusahaan',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 57,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f406',
            'pertanyaan' => 'Menghubungi Kemenakertrans',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 58,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f407',
            'pertanyaan' => 'Menghubungi agen tenaga kerja komersial/swasta',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 59,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f408',
            'pertanyaan' => 'Memperoleh informasi dari pusat/kantor pengembangan karir fakultas/universitas',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 60,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f409',
            'pertanyaan' => 'Menghubungi kantor kemahasiswaan/hubungan alumni',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 61,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f410',
            'pertanyaan' => 'Membangun jejaring (network) sejak masih kuliah',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 62,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f411',
            'pertanyaan' => 'Melalui relasi (misalnya dosen, orang tua, saudara, teman, Ikatan Alumni dll.)',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 63,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f412',
            'pertanyaan' => 'Membangun bisnis sendiri)',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 64,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f413',
            'pertanyaan' => 'Melalui penempatan kerja atau magang',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 65,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f414',
            'pertanyaan' => 'Bekerja di tempat yang sama dengan tempat kerja semasa kuliah',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 66,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f415',
            'pertanyaan' => 'Lainnya',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak",
                "1 - Iya",
            ]),
            'index' => 67,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f7a',
            'pertanyaan' => 'Berapa banyak perusahaan/instansi/institusi yang mengundang anda untuk wawancara?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'index' => 68,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1001',
            'pertanyaan' => 'Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir? Pilihlah satu jawaban',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "1 - Tidak",
                "2 - Tidak, tapi saya sedang menunggu hasil lamaran kerja",
                "3 - Ya, saya akan mulai bekerja dalam 2 minggu ke depan",
                "4 - Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan",
                "5 - Lainnya",
            ]),
            'index' => 69,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1601',
            'pertanyaan' => 'Apakah pekerjaan anda saat ini tidak sesuai dengan pendidikan anda ?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Tidak sesuai",
                "1 - Pekerjaan saya sekarang sudah sesuai dengan pendidikan saya",
            ]),
            'index' => 70,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1602',
            'pertanyaan' => 'Apakah pekerjaan anda saat ini tidak sesuai dengan pendidikan anda ?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Saya belum mendapatkan pekerjaan yang lebih sesuai",
            ]),
            'index' => 71,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1603',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Di pekerjaan ini saya memeroleh prospek karir yang baik",
            ]),
            'index' => 72,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1604',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya",
            ]),
            'index' => 73,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1605',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya",
            ]),
            'index' => 74,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1606',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini",
            ]),
            'index' => 75,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1607',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Pekerjaan saya saat ini lebih aman/terjamin/secure",
            ]),
            'index' => 76,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1608',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Pekerjaan saya saat ini lebih menarik",
            ]),
            'index' => 77,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1609',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel, dll",
            ]),
            'index' => 78,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1610',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya",
            ]),
            'index' => 79,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1611',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya",
            ]),
            'index' => 80,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1612',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Pada awal meniti karir ini, saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya",
            ]),
            'index' => 81,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1613',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya? Selain pilihan dijawaban soal diatas',
            'tipe_id' => 8,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'options' => json_encode([
                "0 - Pekerjaan saya sudah sesuai",
                "1 - Lainnya",
            ]),
            'index' => 82,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f1614',
            'pertanyaan' => 'Jika pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya? Selain pilihan dijawaban soal diatas, Tuliskan',
            'tipe_id' => 1,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 83,
        ]);
    }
}
