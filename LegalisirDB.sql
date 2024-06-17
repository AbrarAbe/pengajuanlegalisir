CREATE DATABASE IF NOT EXISTS test;
USE test;

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
('Pending'),
('Divalidasi'),
('Disahkan'),
('Ditolak'),
('Silahkan ambil di prodi'),
('Sedang dikirim ke alamat anda'),
('Selesai')
;

CREATE TABLE Pengajuan (
    id_pengajuan INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    npm VARCHAR(20) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    tahun_lulus INT NOT NULL,
    email VARCHAR(50) NOT NULL,
    scan_ijazah MEDIUMBLOB NOT NULL,
    scan_transkrip MEDIUMBLOB,
    metode_pengambilan ENUM('ambil ditempat', 'dikirim ke alamat') NOT NULL,
    jumlah_legalisir_ijazah INT NOT NULL,
    jumlah_legalisir_transkrip INT NOT NULL,
    ekspedisi VARCHAR(50),
    total_harga DECIMAL(10, 2),
    bukti_pembayaran MEDIUMBLOB,
    status ENUM('pending', 'divalidasi', 'disahkan', 'selesai', 'dikirim') DEFAULT 'pending',
    FOREIGN KEY (id_user) REFERENCES User(id_user)
);


CREATE TABLE Dokumen (
    id_dokumen INT PRIMARY KEY AUTO_INCREMENT,
    id_pengajuan INT,
    ijazah LONGBLOB,
    transkrip LONGBLOB,
    bukti_pembayaran MEDIUMBLOB,
    FOREIGN KEY (id_pengajuan) REFERENCES Pengajuan(id_pengajuan)
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