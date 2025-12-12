import http from 'k6/http';
import { sleep, check } from 'k6';

// ============================================================
// PILIH SALAH SATU KONFIGURASI DI BAWAH (Hapus tanda // pada export)
// ============================================================

// 1. SMOKE TEST (Cek Kesehatan Awal - Level Santai)
// Tujuannya: Memastikan script jalan dan server ga error minimal.

/*
export const options = {
  vus: 1, // Cuma 1 user
  duration: '10s', // Cuma 10 detik
  thresholds: { 'http_req_duration': ['p(95)<500'] }, // Harus cepat
};
*/

// 2. LOAD TEST (Simulasi Hari Biasa - Level Normal)
// Tujuannya: Simulasi 50 user aktif bersamaan (Realistis buat localhost).

/*
export const options = {
  stages: [
    { duration: '30s', target: 50 }, // Naik pelan-pelan ke 50 user
    { duration: '1m', target: 50 },  // Tahan di 50 user selama 1 menit
    { duration: '20s', target: 0 },  // Turun pelan-pelan
  ],
  thresholds: { http_req_duration: ['p(95)<2000'] }, // Batas 2 detik
};
*/

// 3. STRESS TEST 
// Tujuannya: Mencari titik hancur (Breakpoint). Sampai kapan XAMPP kuat?
// KITA GEBER SAMPE 200 USER (Ini berat buat XAMPP standar)


export const options = {
  stages: [
    { duration: '1m', target: 100 }, // Panasin mesin ke 100
    { duration: '2m', target: 100 }, // Tahan
    { duration: '1m', target: 200 }, // Paksa naik ke 200!
    { duration: '2m', target: 200 }, // Siksa server di 200
    { duration: '1m', target: 0 },   // Selesai
  ],
};


// 4. SPIKE TEST (Flash Sale - Level Kaget)
// Tujuannya: Tiba-tiba melonjak drastis dalam waktu singkat.

/*
export const options = {
  stages: [
    { duration: '10s', target: 10 },  // Awalnya sepi
    { duration: '10s', target: 300 }, // DUAR! Lonjak ke 300 user dalam 10 detik
    { duration: '1m', target: 300 },  // Tahan sebentar
    { duration: '10s', target: 0 },   // Langsung hilang
  ],
};
*/

// ============================================================
// LOGIKA TEST (JANGAN DIUBAH)
// ============================================================
export default function () {
  // Ganti URL sesuai targetmu
  const url = 'http://localhost/pemrogramanWebPHP/TR_Kelompok_Bebas/index.php';
  
  const res = http.get(url);

  check(res, {
    'status is 200': (r) => r.status === 200, // Cek sukses
  });

  sleep(1); // User istirahat 1 detik (Biar laptop ga meledak)
}