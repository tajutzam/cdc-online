<?php

namespace Database\Seeders;

use App\Models\QuisionerProdi;
use Illuminate\Database\Seeder;

class QuisProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ["kode" => "54647", "nama" => "Manajemen Informatika K.Temanggung"],
            ["kode" => "54601", "nama" => "Pertanian"],
            ["kode" => "41633", "nama" => "Produksi Tanaman Perkebunan K. Temanggung"],
            ["kode" => "41671", "nama" => "Teknologi Industri Pangan K. Sidoarjo"],
            ["kode" => "41621", "nama" => "Teknologi Industri Pangan K. Temanggung"],
            ["kode" => "54572", "nama" => "Budidaya Tanaman Perkebunan Kab. Berau"],
            ["kode" => "41511", "nama" => "Manajemen Agroindustri, Kampus K. Cianjur"],
            ["kode" => "54531", "nama" => "Manajemen Bisnis Unggas, Kampus K. Cianjur"],
            ["kode" => "57581", "nama" => "Manajemen Informatika K. Nganjuk"],
            ["kode" => "57571", "nama" => "Manajemen Informatika K. Sidoarjo"],
            ["kode" => "57501", "nama" => "Manajemen Informatika K.Situbondo"],
            ["kode" => "57582", "nama" => "Manajemen Informatika Kab. Berau"],
            ["kode" => "57502", "nama" => "Manajemen Informatika, Kampus K. Cianjur"],
            ["kode" => "41534", "nama" => "Produksi Ternak K. Bondowoso"],
            ["kode" => "54532", "nama" => "Produksi Ternak Kab. Halmahera Tengah"],
            ["kode" => "21505", "nama" => "Teknik Otomotif Kab. Halmahera Tengah"],
            ["kode" => "21506", "nama" => "Teknologi Energi Terbarukan, Kampus K. Cianjur"],
            ["kode" => "41522", "nama" => "Teknologi Industri Pangan K. Bondowoso"],
            ["kode" => "41571", "nama" => "Teknologi Industri Pangan K. Nganjuk"],
            ["kode" => "41521", "nama" => "Teknologi Industri Pangan K. Situbondo"],
            ["kode" => "41531", "nama" => "Teknologi Produksi Benih, Kampus K. Cianjur"],
            ["kode" => "79402", "nama" => "Bahasa Inggris"],
            ["kode" => "41401", "nama" => "Keteknikan Pertanian"],
            ["kode" => "54401", "nama" => "Manajemen Agribisnis"],
            ["kode" => "54402", "nama" => "Manajemen Agribisnis (Kampus Kab. Nganjuk)"],
            ["kode" => "57401", "nama" => "Manajemen Informatika"],
            ["kode" => "54412", "nama" => "Produksi Tanaman Hortikultura"],
            ["kode" => "54471", "nama" => "Produksi Tanaman Perkebunan"],
            ["kode" => "54432", "nama" => "Produksi Ternak"],
            ["kode" => "56401", "nama" => "Teknik Komputer"],
            ["kode" => "41421", "nama" => "Teknologi Industri Pangan"],  ["kode" => "62303", "nama" => "Akuntansi Sektor Publik"],
            ["kode" => "61316", "nama" => "Bisnis Digital"],
            ["kode" => "54371", "nama" => "Budidaya Tanaman Perkebunan"],
            ["kode" => "93304", "nama" => "Destinasi Pariwisata"],
            ["kode" => "13311", "nama" => "Gizi Klinik"],
            ["kode" => "54304", "nama" => "Manajemen Agribisnis (Kampus. Kab Ngawi)"],
            ["kode" => "41311", "nama" => "Manajemen Agroindustri"],
            ["kode" => "41312", "nama" => "Manajemen Agroindustri (Kampus Kab Sidoarjo)"],
            ["kode" => "54331", "nama" => "Manajemen Bisnis Unggas"],
            ["kode" => "13363", "nama" => "Manajemen Informasi Kesehatan"],
            ["kode" => "13364", "nama" => "Manajemen Informasi Kesehatan (Kampus Kab. Ngawi)"],
            ["kode" => "93308", "nama" => "Manajemen Pemasaran Internasional"],
            ["kode" => "21301", "nama" => "Mesin Otomotif"],
            ["kode" => "54357", "nama" => "Pengelolaan Perkebunan Kopi"],
            ["kode" => "90347", "nama" => "Produksi Media"],
            ["kode" => "13331", "nama" => "Promosi Kesehatan"],
            ["kode" => "13362", "nama" => "Rekam Medik"],
            ["kode" => "21306", "nama" => "Teknik Energi Terbarukan"],
            ["kode" => "55301", "nama" => "Teknik Informatika"],
            ["kode" => "55302", "nama" => "Teknik Informatika (Kampus Kab Nganjuk)"],
            ["kode" => "55304", "nama" => "Teknik Informatika (Kampus Kab. Sidoarjo)"],
            ["kode" => "41331", "nama" => "Teknik Produksi Benih"],
            ["kode" => "54317", "nama" => "Teknologi Pakan Ternak"],
            ["kode" => "41322", "nama" => "Teknologi Produksi Tanaman Pangan"],
            ["kode" => "21312", "nama" => "Teknologi Rekayasa Mekatronika"],
            ["kode" => "41203", "nama" => "Teknologi Rekayasa Pangan"],
            ["kode" => "54101", "nama" => "Agribisnis"],
        ];

        foreach ($data as $prodi) {
            QuisionerProdi::create([
                'id' => $prodi['kode'],
                'nama_prodi' => $prodi['nama']
            ]);
        }
    }
}
