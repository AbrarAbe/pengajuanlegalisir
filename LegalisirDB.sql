CREATE DATABASE IF NOT EXISTS LegalisirDB;
USE LegalisirDB;

CREATE TABLE User (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    level ENUM('Staf', 'Dekan') NOT NULL
);

CREATE TABLE Alumni (
    id_alumni INT PRIMARY KEY AUTO_INCREMENT,
    npm INT(11) NOT NULL UNIQUE,
    nama VARCHAR(30),
    email VARCHAR(50), 
    tahun_lulus INT(5)
);

CREATE TABLE Status (
    id_status INT PRIMARY KEY AUTO_INCREMENT,
    keterangan VARCHAR(20)
);

INSERT INTO Status (keterangan) VALUES
('Pending'),
('Divalidasi oleh Staf'),
('Desetujui oleh Dekan'),
('Ditolak oleh Dekan'),
('Dokumen anda sedang dilegalisir'),
('Silahkan ambil di prodi'),
('Sedang dikirim ke alamat anda')
;

CREATE TABLE Pengajuan (
    id_pengajuan INT PRIMARY KEY AUTO_INCREMENT,
    id_alumni INT,
    tgl_masuk DATE,
    email VARCHAR(50),
    metode_pengambilan ENUM('ambil', 'kirim'),
    alamat_pengiriman VARCHAR(255),
    id_status INT,
    FOREIGN KEY (id_alumni) REFERENCES Alumni(id_alumni),
    FOREIGN KEY (id_status) REFERENCES Status(id_status)
);

CREATE TABLE Dokumen (
    id_dokumen INT PRIMARY KEY AUTO_INCREMENT,
    id_pengajuan INT,
    ijazah LONGBLOB,
    transkrip LONGBLOB,
    bukti_pembayaran MEDIUMBLOB,
    FOREIGN KEY (id_pengajuan) REFERENCES Pengajuan(id_pengajuan)
);
