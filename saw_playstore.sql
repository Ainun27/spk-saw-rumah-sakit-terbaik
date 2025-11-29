-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 06, 2022 at 03:26 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saw_playstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `saw_aplikasi`
--

-- 1. Buat Database
CREATE DATABASE saw_playstore;

-- 2. Gunakan Database
USE saw_playstore;

-- 3. Tabel Alternatif (Data Rumah Sakit)
CREATE TABLE saw_rumahsakit (
  nama VARCHAR(100) PRIMARY KEY,
  alamat VARCHAR(255) NOT NULL,
  tipe VARCHAR(50) NOT NULL
);

-- 4. Tabel Kriteria (Bobot Kriteria)
CREATE TABLE saw_kriteria (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fasilitas DECIMAL(5,2) NOT NULL,
  dokter DECIMAL(5,2) NOT NULL,
  jarak DECIMAL(5,2) NOT NULL,
  biaya DECIMAL(5,2) NOT NULL,
  pelayanan DECIMAL(5,2) NOT NULL,
  akreditasi DECIMAL(5,2) NOT NULL
);

-- 5. Tabel Penilaian (Nilai Setiap RS untuk Tiap Kriteria)
CREATE TABLE saw_penilaian (
  nama VARCHAR(100) PRIMARY KEY,
  fasilitas INT NOT NULL,
  dokter INT NOT NULL,
  jarak INT NOT NULL,
  biaya INT NOT NULL,
  pelayanan INT NOT NULL,
  akreditasi INT NOT NULL,
  FOREIGN KEY (nama) REFERENCES saw_rumahsakit(nama) ON DELETE CASCADE
);



