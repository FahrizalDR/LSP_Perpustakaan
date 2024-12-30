create database lsp_perpustakaan;

create table buku(
	id_buku varchar(10) primary key not null,
    judul varchar(50) not null,
    pengarang varchar(50) not null,
    penerbit varchar(50) not null,
    tahun_terbit varchar(4) not null,
    kategori varchar(30) not null,
    jumlah_halaman varchar(10) not null,
    deskripsi_buku text not null
);

create table admin(
	id_admin int auto_increment primary key not null,
    nama_admin varchar(50) not null,
    password_admin varchar(50) not null,
    alamat_admin varchar(255) not null,
    telepon_admin varchar(13) not null
);

create table anggota(
	id_anggota int auto_increment primary key,
    nama_anggota varchar(50) not null,
    jenis_kelamin varchar(10) not null,
    alamat_anggota varchar(255) not null,
    telepon_anggota varchar(13) not null,
    password_anggota varchar(255) not null
);

create table peminjaman(
	id_peminjaman int auto_increment primary key not null,
    id_anggota int(10) not null,
    id_buku varchar(10) not null,    
    tanggal_pinjam date not null,
    tanggal_kembali date not null,
    status varchar(20) default 'Dipinjam',
    foreign key (id_anggota) references anggota(id_anggota),
    foreign key (id_buku) references buku(id_buku)
);

create table pengembalian(
	id_pengembalian int auto_increment primary key not null,
    id_peminjaman int(10) not null,
    id_anggota int(10) not null,
    id_buku varchar(10) not null,    
    tanggal_kembali date not null,
    keterlambatan varchar(30) not null,
    denda int(15) not null,
    foreign key (id_peminjaman) references peminjaman(id_peminjaman),
    foreign key (id_buku) references buku(id_buku),
    foreign key (id_anggota) references anggota(id_anggota)
);

create view viewTransKembali as
select p.id_pengembalian, b.judul, a.nama_anggota, p.tanggal_kembali, p.keterlambatan, concat('Rp. ', format(p.denda,0, 'id_ID')) as denda
from pengembalian as p
left join buku as b
on b.id_buku = p.id_buku
left join anggota as a
on a.id_anggota = p.id_anggota
group by p.id_pengembalian;

create view viewTransPinjam as
select p.id_peminjaman, b.id_buku, a.id_anggota, b.judul, a.nama_anggota, p.tanggal_pinjam, p.tanggal_kembali, p.status
from peminjaman as p
left join buku as b
on b.id_buku = p.id_buku
left join anggota as a
on a.id_anggota = p.id_anggota
group by p.id_peminjaman;

