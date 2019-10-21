DROP TABLE tbl_disposisi;

CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(10) NOT NULL AUTO_INCREMENT,
  `tujuan` varchar(250) NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_disposisi`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO tbl_disposisi VALUES("3","Ani Triastuti, S.E., S.Pd","Segera hadiri undangan","Penting","2016-05-17","Mohon hadir tepat waktu","14","1");
INSERT INTO tbl_disposisi VALUES("4","ibu ani","mohon segera dihadiri agar mendapatkan makanan gratis bro lumayan","Penting","2019-10-19","laksanakan","13","1");
INSERT INTO tbl_disposisi VALUES("7","ibu jumhari","minum yuk kang","Rahasia","2019-10-19","laksanakan","15","1");



DROP TABLE tbl_instansi;

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kepsek` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_instansi VALUES("1","YAYASAN USAHA PENINGKATAN PENDIDIKAN TEKNOLOGI","SMK Yuppentek 1 Tangerang","Akta Notaris: SLAMET , SH, M.Hum No. 119/2013","Jl. Veteran No. 1 Kota Tangerang Tlp. 021-5524518 Fax. 021-55797521","H. Riza Fachri, S.Kom.","-","http://www.smkyuppentek1.sch.id","esemkayuppenteksatu@yahoo.co.id","logo1.gif","1");



DROP TABLE tbl_klasifikasi;

CREATE TABLE `tbl_klasifikasi` (
  `id_klasifikasi` int(5) NOT NULL AUTO_INCREMENT,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_klasifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tbl_klasifikasi VALUES("1","420","PENDIDIKAN","PENDIDIKAN","1");
INSERT INTO tbl_klasifikasi VALUES("2","421","Dinas Pemuda Olahraga","Dispora","1");



DROP TABLE tbl_sett;

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `referensi` tinyint(2) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_sett`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_sett VALUES("1","5","5","20","1");



DROP TABLE tbl_surat_keluar;

CREATE TABLE `tbl_surat_keluar` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_keluar VALUES("7","7","ibu jumhari s.pd","B.5/A7775","rapat dengan wali kota tangerang untuk membahas program sekolah bersih","421","2019-10-17","2019-10-21","4911-3299-1-21539-1-10-20180723.pdf","testing kedua","1");



DROP TABLE tbl_surat_masuk;

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `indeks` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_masuk VALUES("13","3","3 / XI/M.BIG/2016","Musyawarah Guru Mata Pelajaran Bahasa Inggris","Surat edaran pertemuan rutin musyawarah guru mata pelajaran bahasa inggris.","420","A.3","2016-04-19","2016-07-24","","-","5");
INSERT INTO tbl_surat_masuk VALUES("14","4","123","depag","tolong hadiri kegiatan amal bersama anak yatim di jalan kenangan no 5 ","420","A4","2019-10-16","2019-10-16","5198-69-233-1-PB.pdf","testing","1");
INSERT INTO tbl_surat_masuk VALUES("15","7","123223","dispora","testing wkwkwkwkwkwkw djasdsjad sahdjvsadvsa sajhdvasjvdasd sajhdvjhasdvas sdvasjvdasd  ","421","A5","2019-10-19","2019-10-18","4413-3299-1-21539-1-10-20180723.pdf","testing 2","1");



DROP TABLE tbl_user;

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_user VALUES("1","admin","21232f297a57a5a743894a0e4a801fc3","Firhan Adnan ","-","1");
INSERT INTO tbl_user VALUES("2","disposisi","13bb8b589473803f26a02e338f949b8c","operator","-","3");
INSERT INTO tbl_user VALUES("3","operator2","9e64fc8a2ad3331c44a846c3a2b4bb14","operator second","1101151316","3");



