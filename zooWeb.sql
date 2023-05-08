-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2023 at 04:21 PM
-- Server version: 10.11.2-MariaDB
-- PHP Version: 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zooWeb`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `name`, `image`) VALUES
(1, 'Quokka', '/assets/images/quokka-3.jpg'),
(2, 'Koala', '/assets/images/koala.jpg'),
(3, 'Capybara', '/assets/images/capybara.jpg'),
(6, 'Sapi', '/assets/images/9g3ymny16298trjad7r0p4fj8jngct.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `animal_detail`
--

CREATE TABLE `animal_detail` (
  `id` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animal_detail`
--

INSERT INTO `animal_detail` (`id`, `description`) VALUES
(1, '<h1>Fakta - fakta si imut Quokka</h1><p class=\"ql-align-justify\">	Quokka adalah hewan mungil dengan bulu pendek abu-abu coklat kasar dan memiliki telinga bulat kecil dan hidung hitam yang berasal dari pulau Rottnes, Australia. </p><p class=\"ql-align-justify\">Hewan ini pertama kali ditemukan pada tahun 1696 dimana seorang penjelajah dari Belanda yang bernama Willem de Vlamingh yang mengira hewan ini sebagai tikus yang berukuran besar, sehingga Ia pun memberi nama pulau tersebut \"Rattennest\" (dalam bahasa Belanda menjadi \"Rat Nest\") yang kemudian berubah nama menjadi \"Rottnest\". </p><p class=\"ql-align-justify\">Quokka juga dapat ditemukan didaerah Australia lainnya seperti daerah daratan Australia Barat dan Pulau bald (Bald Island). Quokka merupakan salah satu hewan yang menarik untuk dibahas, dan berikut adalah fakta - fakta menarik dari hewan ini.</p><p class=\"ql-align-justify\"><br></p><h3>Merupakan Hewan Nokturnal</h3><p><br></p><p class=\"ql-align-justify\">Quokka merupakan hewan nokturnal yang artinya hewan yang aktif di malam hari dan tidur di siang hari, ketika siang hari hewan ini biasanya tidur diantara tanaman paku untuk perlindungan dan juga persembunyian.</p><p class=\"ql-align-justify\"><br></p><h3>Termasuk Hewan herbivora</h3><p><br></p><p class=\"ql-align-justify\">Quokka memakan banyak jenis vegetasi, termasuk rerumputan, alang-alang, dan daun. </p><p class=\"ql-align-justify\">Sebuah penelitian menemukan bahwa Guichenotia ledifolia yaitu spesies semak kecil dari keluarga Malvaceae, merupakan salah satu makanan favorit para quokka.</p><p class=\"ql-align-justify\">Pengunjung Pulau Rottnest didesak untuk tidak pernah memberi makan quokka, sebagian karena makan \"makanan manusia\" dapat menyebabkan dehidrasi dan kekurangan gizi, yang keduanya merugikan kesehatan quokka. </p><p class=\"ql-align-justify\">Meskipun relatif kekurangan air tawar di Pulau Rottnest, quokka memiliki kebutuhan air yang tinggi, yang sebagian besar dipenuhi dengan memakan tumbuh-tumbuhan. </p><p class=\"ql-align-justify\">Di daratan, quokka hanya hidup di daerah yang memiliki curah hujan 600 mm (24 in) atau lebih per tahun. Quokka mengunyah makanan mereka, mirip dengan sapi.</p><p class=\"ql-align-justify\">Jika kondisi alam dilanda kemarau panjang, quokka bisa bertahan cukup lama tanpa makanan atau air karena menyimpan lemak di ekor mereka.</p><h3><br></h3><h3>Hewan Marsupial</h3><p class=\"ql-align-justify\">Sama seperti kanguru, quokka juga berkembang biak dengan beranak. </p><p class=\"ql-align-justify\">Di daratan Australia Barat, quokka bisa berkembang biak sepanjang tahun, namun di Pulau Rottnest mereka hanya bisa berkembang biak antara bulan Januari hingga Agustus. </p><p class=\"ql-align-justify\">Masa kehamilan quokka hanya satu bulan, dan bayi yang disebut joey ini selanjutnya akan tinggal di kantung sang ibu selama enam bulan. </p><p class=\"ql-align-justify\">Induk quokka bisa melahirkan dua kali dalam setahun. </p><p class=\"ql-align-justify\">Selepas enam bulan, anak quokka sudah bisa meninggalkan kantung ibunya, namun ia masih bergantung pada air susu ibunya hingga dua bulan ke depan. </p><p class=\"ql-align-justify\">Quokka bisa mulai beranak pinak saat usianya satu setengah tahun. Usia quokka di alam liar bisa mencapai sepuluh tahun.</p><h3><br></h3><h3>Termasuk Hewan yang Terancam Punah</h3><p class=\"ql-align-justify\"><img src=\"http://localhost:8080/assets/images/quokka-senyum.jpg\">	</p><p class=\"ql-align-justify\">Satwa khas Australia Barat ini termasuk satwa yang dilindungi, karena populasinya yang sedikit. </p><p class=\"ql-align-justify\">Dalam Daftar Merah IUCN (Persatuan Internasional untuk Konservasi Alam), status konservasi quokka masuk dalam kategori rentan (vulnerable). </p><p class=\"ql-align-justify\">Predator yang mengancam keberlangsungan kehidupan quokka adalah rubah, anjing liar dan kucing-kucing di daratan utama, namun di Pulau Rottnest ancaman justru datang dari manusia. </p><p class=\"ql-align-justify\">Mamalia kecil ini, juga rentan terhadap penyakit otot, sebuah penyakit yang melemahkan dan merusak otot. Quokka membutuhkan penutup tanah yang lebat untuk berlindung. Penebangan tebang habis , pembangunan pertanian, dan perluasan perumahan telah mengurangi habitat mereka, berkontribusi pada penurunan spesies, seperti halnya pembukaan dan pembakaran lahan rawa yang tersisa. </p><p class=\"ql-align-justify\">Selain itu, quokka biasanya memiliki ukuran sampah satu dan berhasil membesarkan satu anak setiap tahun. </p><p class=\"ql-align-justify\">Meskipun mereka terus-menerus kawin, biasanya satu hari setelah anak lahir, ukuran serasah yang kecil, bersama dengan ruang terbatas dan predator yang mengancam, berkontribusi pada kelangkaan spesies di daratan.</p><h3><br></h3><h3>Hewan Paling Bahagia</h3><p class=\"ql-align-justify\">Alasan mereka disebut binatang yang paling bahagia adalah karena mereka selalu terlihat tersenyum. </p><p class=\"ql-align-justify\">Mereka sempat terkenal di tahun 2015 karena banyak sekali orang-orang yang melakukan selfie dengan binatang ini. </p><p class=\"ql-align-justify\">Yang membuat binatang ini terkenal adalah saat turis-turis foto dengan mereka, mereka sedang tersenyum juga. </p><p class=\"ql-align-justify\">Beda dengan binatang lain, mereka tidak takut dengan adanya manusia dan mereka tidak peduli dengan keadaan sekitar mereka. </p><p class=\"ql-align-justify\">Maka dari itu, turis-turis bisa melihat mereka berlari di tengah-tengah taman atau dekat pepohonan. </p><p class=\"ql-align-justify\">Mereka juga bisa saja masuk ke dalam bangunan atau restoran yang di sekitarnya terdapat pepohonan. </p><p class=\"ql-align-justify\">Terkadang, ini mengganggu orang-orang local yang tinggal di pulau Australia tersebut. </p><p class=\"ql-align-justify\">Namun, walaupun hewan ini tidak takut dengan manusia, dinyatakan ilegal untuk mengambil quokka liar dan menjadikannya binatang peliharaan.</p>'),
(2, '<h1>Fakta - fakta mengenai koala</h1><p class=\"ql-align-justify\">Banyak orang mungkin berpikir, hewan ini diberi nama \"Koala\" karena nama itu terdengar sangat imut dan sesuai dengan hewan satu ini.</p><p class=\"ql-align-justify\">Yang benar adalah, nama \"Koala\" berasal dari bahasa suku Aborigin yang merupakan suku asli Australia.</p><p class=\"ql-align-justify\">Koala sendiri dalam bahasa Aborigin berarti tanpa minum.</p><p class=\"ql-align-justify\">Kenyataannya, koala memang jarang sekali minum air dan mendapatkan suplai cairan dari daun kayu putih yang mereka makan.</p><p class=\"ql-align-justify\">Meski begitu, koala sesekali juga akan mencari sumber air dan minum jika mereka membutuhkannya terutama saat udara panas atau saat musim kemarau.</p><h3>Koala bukan beruang</h3><p class=\"ql-align-justify\">Banyak orang berpikir, koala adalah bagian dari keluarga beruang.</p><p class=\"ql-align-justify\">Sekilas, hewan ini memang mirip seperti saudara jauh dari beruang dengan badan gemuk berbulu, dan kuping yang bundar.</p><p class=\"ql-align-justify\">Padahal, koala bukanlah beruang.</p><p class=\"ql-align-justify\">Daripada beruang, hewan ini lebih mirip seperti saudara jauh kanguru karena sama seperti kanguru, koala juga memiliki sebuah kantung yang digunakan untuk menyimpan anaknya dan menjaganya tetap aman.</p><h3>Bayi koala ternyata memiliki nama</h3><p class=\"ql-align-justify\">Beda dengan hewan lain, bayi koala dikenal dengan nama Joey.</p><p class=\"ql-align-justify\">Dalam satu tahun, koala betina hanya akan melahirkan satu anak.</p><p class=\"ql-align-justify\">Berbeda dengan koala dewasa, bayi koala lahir tanpa bulu dan tidak bisa melihat.</p><p class=\"ql-align-justify\">Untuk menjaga agar bayinya tetap aman, induk koala akan menempatkan bayinya di dalam kantung selama enam bulan.</p><p class=\"ql-align-justify\">Setelah cukup besar, bayi koala akan merangkak naik ke punggung induknya dan tinggal di sana selama enam bulan.</p><h3>Mereka sangat pemilih dalam urusan makanan</h3><p class=\"ql-align-justify\"><img src=\"http://localhost:8080/assets/images/koala-makan.jpg\"></p><p class=\"ql-align-justify\">Koala adalah hewan yang sangat bawel dalam urusan makanan.</p><p class=\"ql-align-justify\">Meski hanya memakan daun, tapi mereka hanya mau memakan daun kayu putih yang berasal dari pohon tempat mereka tinggal. Dalam satu hari, koala dewasa bisa makan sampai 1 kilogram daun kayu putih.</p><p class=\"ql-align-justify\">Biasanya koala mencari makan di pohon mereka sendiri dan hanya memakan daun muda yang berasal dari puncak pohon.</p><h3>Koala adalah hewan yang sangat malas</h3><p class=\"ql-align-justify\">Bertubuh gendut, koala adalah hewan yang sangat malas dan menghabiskan waktunya untuk tidur.</p><p class=\"ql-align-justify\">Dalam sehari, seekor koala bisa tidur selama 18 hingga 22 jam.</p><p class=\"ql-align-justify\">Dua jam sisanya dipergunakan untuk mencari makan dan jika mereka gagal menemukan daun kayu putih, mereka akan kembali merayap ke batang pohon dan kembali tidur.</p><h3>Merupakan perenang yang hebat</h3><p class=\"ql-align-justify\">Memang benar jika koala menghabiskan hampir seluruh hidupnya di atas pohon.</p><p class=\"ql-align-justify\">Meski begitu, hewan ini ternyata juga jago olahraga renang. Jika memang harus, seekor koala bisa melintasi sebuah sungai tanpa tenggelam.</p><p class=\"ql-align-justify\">Biasanya selain untuk minum, koala juga menyeberangi sungai untuk mencari pohon baru sebagai tempat tinggal.</p>'),
(3, '<h1>Fakta - fakta mengenai Kapibara</h1><p class=\"ql-align-justify\">Kapibara yang memiliki nama ilmiah Hydrochoerus hydrochaeris merupakan hewan pengerat berukuran besar yang masih tersisa di Bumi. </p><p class=\"ql-align-justify\">Hewan liar yang ramah ini mudah ditemukan di wilayah Amerika Selatan dan Tengah. </p><p class=\"ql-align-justify\">Meski termasuk hewan liar, beberapa orang di Amerika kadang menjadikannya sebagai hewan peliharaan. </p><p class=\"ql-align-justify\">Sedangkan di Venezuela, kapibara dibudidayakan untuk diambil dagingnya.</p><p class=\"ql-align-justify\">Kepopuleran hewan pengerat ini dimulai dari meme yang memperlihatkan Capybara sedang duduk santai di atas buaya, hewan predator karnivora di alam liar. </p><p class=\"ql-align-justify\">Terlihat tidak terganggu sama sekali dengan kehadiran predator tersebut, banyak yang merasa bahwa hewan pengerat ini sangat unik dan mulai dipanggil \" Masbro \" di internet.</p><h3>Mirip dengan marmut</h3><p class=\"ql-align-justify\">Kapibara memiliki kemiripan dengan marmut karena masih dalam famili yang sama, yaitu Caviidae. </p><p class=\"ql-align-justify\">Selain itu, keduanya aktif di siang hari dibandingkan malam hari. </p><p class=\"ql-align-justify\">Sedangkan sebagian besar hewan pengerat aktif di malam hari. </p><p class=\"ql-align-justify\">Perbedaannya hanya terletak pada ukuran kapibara yang lebih besar daripada marmut. </p><p class=\"ql-align-justify\">Selain itu, kapibara juga lebih gesit dibandingkan dengan marmut.</p><h3>Hewan pengerat terbesar di Bumi</h3><p class=\"ql-align-justify\">Kapibara dinobatkan sebagai hewan pengerat terbesar yang masih ada di Bumi. </p><p class=\"ql-align-justify\">Hewan ini memiliki ukuran panjang mencapai 1,3 meter dengan tinggi 50 cm cari kaki sampai bahu. </p><p class=\"ql-align-justify\">Sedangkan beratnya antara 27 sampai dengan 79 kilogram. Kapibara betina memiliki ukuran yang lebih kecil dibandingkan pejantan.</p><h3><img src=\"http://localhost:8080/assets/images/capybara-interview.jpg\"></h3><p>Pengerat yang suka berkelompok</p><p class=\"ql-align-justify\">Hampir sama dengan hewan liar pada umumnya, kapibara juga hidup berkelompok. </p><p class=\"ql-align-justify\">Setiap kelompok kapibara biasanya terdiri daro 10-20 ekor. </p><p class=\"ql-align-justify\">Kelompok tersebut terdiri dari pejantan dan dewasa, beberapa pejantan dan betina muda serta anak-anak kapibara.</p><p class=\"ql-align-justify\">Sedangkan pada musim kemarau, jumlah anggota kawanan kapibara akan semakin banyak dan berkumpul di dekat sumber air. </p><p class=\"ql-align-justify\">Seekor kapibara jantan dewasa akan menjadi pemimpin dan melindungi kawanannya.</p><h3>Perenang yang cakap</h3><p class=\"ql-align-justify\">Kapibara memiliki sifat semi-akuatik dengan kaki yang sedikit berselaput dan ekor yang sangat pendek. </p><p class=\"ql-align-justify\">Kondisi tubuh tersebut berfungsi untuk menjaga keseimbangan ketika kapibara berenang. </p><p class=\"ql-align-justify\">Selain itu, kaki berselaput yang dimilikinya berfungsi untuk berjalan di tanah berlumpur.</p><p class=\"ql-align-justify\">Kapibara dikatakan sebagai perenang yang cakap karena mampu terendam air selama lima menit. </p><p class=\"ql-align-justify\">Hal tersebut memudahkan kapibara untuk menghindari predator dengan bersembunyi di bawah air. </p><p class=\"ql-align-justify\">Bahkan, dapat tidur di bawah air dengan hidung berada di permukaan air untuk bernapas.</p><h3>Memiliki indra penciuman yang sangat baik</h3><p class=\"ql-align-justify\">Kapibara memiliki dua tipe penciuman, yaitu morillo dan kelenjar anal yang membuat penciumannya baik. </p><p class=\"ql-align-justify\">Kapibara jantan dapat mencium aroma dari bulu yang melekat pada tanaman atau objek lainnya. </p><p class=\"ql-align-justify\">Sehingga kapibara dapat mencari makanan dengan jarak yang jauh dan kembali ke rumahnya.</p><h3>Kulit kapibara bisa terbakar matahari, lho!</h3><p class=\"ql-align-justify\">Meski kapibara memiliki bulu yang cukup panjang, namun tidak cukup untuk menutupi seluruh tubuhnya. </p><p class=\"ql-align-justify\">Selain itu, bulu kapibara tidak cukup tebal dan tidak dapat sepenuhnya melindungi kulit dar efek sinar ultraviolet. </p><p class=\"ql-align-justify\">Sehingga, membuat kapibara rentan terhadap penyinaran matahari yang terlalu lama. </p><p class=\"ql-align-justify\">Cara mereka beradaptasi dari suhu tinggi yaitu dengan berendam di air atau lumpur.</p><h3>Memakan kotorannya sendiri</h3><p class=\"ql-align-justify\">Kapibara termasuk herbivora, biasanya makan rumput dan tanaman air. </p><p class=\"ql-align-justify\">Namun, kapibara juga makan kotoran mereka sendiri. </p><p class=\"ql-align-justify\">Kotoran kapibara dianggap kaya protein yang berasal dari mikroba pencerna makanannya dihari sebelumnya. </p><p class=\"ql-align-justify\">Rumput yang dimakan oleh kapibara sulit dicerna, sehingga memakan kotoran dianggap sebagai cara mencerna untuk kedua kalinya.</p>'),
(4, '<h2>Hewan</h2>'),
(5, '<h2>Hapus</h2>'),
(6, '<h2>Hewan</h2>');

-- --------------------------------------------------------

--
-- Table structure for table `fav_animal`
--

CREATE TABLE `fav_animal` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_code` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `total_price` float NOT NULL,
  `status` enum('progress','success','cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_code`, `user_id`, `voucher_id`, `total_price`, `status`) VALUES
(1, 'INVOICE/2023/05/02/001', 3, NULL, 100000, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `order_ticket`
--

CREATE TABLE `order_ticket` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_ticket`
--

INSERT INTO `order_ticket` (`id`, `order_id`, `ticket_id`, `amount`, `total`) VALUES
(1, 1, 1, 1, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `name`, `price`) VALUES
(1, 'Keluarga', 100000),
(2, 'Pasangan', 75000),
(3, 'Single', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'owner', 'owner@gmail.com', '4c1029697ee358715d3a14a2add817c4b01651440de808371f78165ac90dc581', 'owner'),
(2, 'admin', 'admin@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin'),
(3, 'oystr', 'oystr@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`id`, `address`, `image`, `phone`, `description`) VALUES
(1, 'Jln. Teratai, RT 19', '/assets/images/ns7ty8d7hp8eejwg6ji8hqlw1vn1bq.png', '08888844', '<h1>Tentang Kami</h1><p>ZooYuk adalah website karya Rizky Maulana Alfauzan dimana website ini berfungsi untuk menampilkan hewan - hewan yang ada di kebun binatang ZooYuk, Sehingga para pengunjung dapat lebih mengenal hewan-hewan yang ada disini.</p><h3><img src=\"http://localhost:8080/assets/images/programmer.jpg\" alt=\"Rizky Maulana Alfauzan\"></h3><p>Rizky Maulana Alfauzan</p><h3><strong>Mengenal lebih dekat</strong></h3><p>Saya Rizky Maulana Alfauzan merupakan mahasiswa prodi Sistem Informasi yang berada di Universitas Mulawarman.</p><p>Hobby saya adalah bermain game dan juga gemar desain sebuah website maupun konten untuk social media.</p><p>Ketika teman-teman saya membutuhkan desainer, saya akan hadir untuk membantu teman saya tanpa berat hati karena saya suka sekali desain</p>'),
(2, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animal_detail`
--
ALTER TABLE `animal_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fav_animal`
--
ALTER TABLE `fav_animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `voucher_id` (`voucher_id`);

--
-- Indexes for table `order_ticket`
--
ALTER TABLE `order_ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `animal_detail`
--
ALTER TABLE `animal_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fav_animal`
--
ALTER TABLE `fav_animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_ticket`
--
ALTER TABLE `order_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fav_animal`
--
ALTER TABLE `fav_animal`
  ADD CONSTRAINT `fav_animal_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `fav_animal_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fav_animal_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_detail` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_detail` (`id`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`id`);

--
-- Constraints for table `order_ticket`
--
ALTER TABLE `order_ticket`
  ADD CONSTRAINT `order_ticket_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  ADD CONSTRAINT `order_ticket_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
