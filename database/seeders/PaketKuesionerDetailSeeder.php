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
            'index' => 23,
        ]);
        PaketQuesionerDetail::create([
            'kode_pertanyaan' => 'f18d',
            'pertanyaan' => 'Tanggal Masuk Awal Studi Lanjut Anda?',
            'tipe_id' => 5,
            'id_paket_quesioners' => 2,
            'is_required' => 1,
            'index' => 23,
        ]);
    }
}
