# List Tabel

program_studi

- id
- nama program studi

mahasiswa

- id
- nim
- nama
- alamat
- telepon
- program studi (dari tabel program_studi)
- angkatan
- foto_mahasiswa
- password

dosen

- id
- nip
- nama
- email

pegawai

- id
- nama
- alamat
- telpon
- nip
- password

matakuliah

- id
- kode
- nama_matakuliah
- semester
- sks
- program studi (dari tabel program_studi)
- status_mk (wajib, pilihan)
- dosen_id
- jam_mulai
- jam_selesai

transaksi_krs

- id
- tahun_ajaran
- semester
- mahasiswa_id
- matakuliah_id
- nilai (A, B. C, D)
- status (disetujui, ditolak, pending)

## In case mau buat fitur message

message

- id
- pesan
- pegawai_id
- mahasiswa_id
