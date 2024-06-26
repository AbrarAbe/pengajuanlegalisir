CREATE DATABASE IF NOT EXISTS LegalisirDB;
USE LegalisirDB;

CREATE TABLE User (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('alumni', 'staf', 'dekan') NOT NULL
);

CREATE TABLE Alumni (
    id_alumni INT PRIMARY KEY AUTO_INCREMENT,
    npm VARCHAR(20) UNIQUE,
    nama VARCHAR(50),
    tahun_lulus YEAR,
    email VARCHAR(50),
    alamat TEXT
);

CREATE TABLE Status (
    id_status INT PRIMARY KEY AUTO_INCREMENT,
    keterangan VARCHAR(20)
);

INSERT INTO Status (keterangan) VALUES
('Menunggu Validasi'),
('Divalidasi'),
('Disahkan'),
('Ditolak'),
('Selesai'),
('Ambil'),
('Dikirim')
;

CREATE TABLE Pengajuan (
    id_pengajuan INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    npm VARCHAR(20) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    tahun_lulus VARCHAR(5) NOT NULL,
    email VARCHAR(100) NOT NULL,
    scan_ijazah MEDIUMBLOB NOT NULL,
    scan_transkrip MEDIUMBLOB NOT NULL,
    metode_pengambilan ENUM('ambil di prodi', 'kirim ke alamat') NOT NULL,
    alamat_pengiriman TEXT,
    jumlah_legalisir_ijazah INT,
    jumlah_legalisir_transkrip INT,
    ekspedisi VARCHAR(50),
    ekspedisi_harga INT,
    total_harga INT,
    bukti_pembayaran MEDIUMBLOB NOT NULL,
    id_status INT,
    FOREIGN KEY (id_status) REFERENCES Status(id_status),
    FOREIGN KEY (id_user) REFERENCES User(id_user)
);

CREATE TABLE Validasi (
    id_validasi INT PRIMARY KEY AUTO_INCREMENT,
    id_pengajuan INT,
    id_staf INT,
    tanggal_validasi DATE,
    FOREIGN KEY (id_pengajuan) REFERENCES Pengajuan(id_pengajuan),
    FOREIGN KEY (id_staf) REFERENCES User(id_user)
);

CREATE TABLE Persetujuan (
    id_persetujuan INT PRIMARY KEY AUTO_INCREMENT,
    id_pengajuan INT,
    id_dekan INT,
    tanggal_persetujuan DATE,
    FOREIGN KEY (id_pengajuan) REFERENCES Pengajuan(id_pengajuan),
    FOREIGN KEY (id_dekan) REFERENCES User(id_user)
);
