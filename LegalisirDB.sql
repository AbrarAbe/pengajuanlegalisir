CREATE DATABASE IF NOT EXISTS pengajuanlegalisir;
USE pengajuanlegalisir;

CREATE TABLE user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role ENUM('alumni', 'staf', 'dekan') NOT NULL
    status ENUM('aktif', 'nonaktif') DEFAULT 'nonaktif';
);

CREATE TABLE notifikasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pesan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE status (
    id_status INT PRIMARY KEY AUTO_INCREMENT,
    keterangan VARCHAR(20)
);

INSERT INTO status (keterangan) VALUES
('Menunggu Validasi'),
('Divalidasi'),
('Disahkan'),
('Ditolak'),
('Selesai'),
('Penentuan Ekspedisi'),
('Menunggu Pembayaran')
;

CREATE TABLE pengajuan (
    id_pengajuan INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    npm VARCHAR(20) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    prodi ENUM('Teknik Informatika', 'Sistem Informasi', 'Arsitektur') NOT NULL,
    tahun_lulus VARCHAR(5) NOT NULL,
    email VARCHAR(100) NOT NULL,
    scan_ijazah MEDIUMBLOB NOT NULL,
    scan_transkrip MEDIUMBLOB NOT NULL,
    metode_pengambilan ENUM('ambil di prodi', 'kirim ke alamat') NOT NULL,
    alamat_pengiriman TEXT,
    jumlah_legalisir_ijazah INT NOT NULL,
    jumlah_legalisir_transkrip INT NOT NULL,
    ekspedisi VARCHAR(50),
    ekspedisi_harga INT,
    total_harga INT NOT NULL,
    bukti_pembayaran MEDIUMBLOB,
    id_status INT,
    FOREIGN KEY (id_status) REFERENCES status(id_status),
    FOREIGN KEY (id_user) REFERENCES user(id_user)
);