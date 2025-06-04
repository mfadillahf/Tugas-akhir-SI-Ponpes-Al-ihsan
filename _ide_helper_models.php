<?php

class Eloquent extends \Illuminate\Database\Eloquent\Model {}
// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id_agenda
 * @property int $id_jenis_agenda
 * @property string $judul
 * @property string $tanggal_mulai
 * @property string $tanggal_akhir
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\JenisAgenda $jenisAgenda
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda whereIdAgenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda whereIdJenisAgenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda whereTanggalAkhir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda whereTanggalMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agenda whereUpdatedAt($value)
 */
	class Agenda extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_berita
 * @property int $id_user
 * @property int $id_jenis_berita
 * @property string $judul
 * @property string $isi
 * @property string $tanggal
 * @property string|null $foto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\JenisBerita $jenisBerita
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereIdBerita($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereIdJenisBerita($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereIsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Berita whereUpdatedAt($value)
 */
	class Berita extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_donatur
 * @property int $id_user
 * @property string $nama
 * @property string|null $alamat
 * @property string $no_telepon
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Infaq> $infaq
 * @property-read int|null $infaq_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur whereIdDonatur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur whereNoTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Donatur whereUpdatedAt($value)
 */
	class Donatur extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_galeri
 * @property string|null $deskripsi
 * @property string $foto
 * @property string $tanggal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri whereIdGaleri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galeri whereUpdatedAt($value)
 */
	class Galeri extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_guru
 * @property int $id_user
 * @property string $nama
 * @property string $no_telepon
 * @property string|null $email
 * @property string|null $nip
 * @property string $tanggal_lahir
 * @property string $jenis_kelamin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Hapalan> $hapalan
 * @property-read int|null $hapalan_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Mapel> $mapel
 * @property-read int|null $mapel_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru whereIdGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru whereNoTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guru whereUpdatedAt($value)
 */
	class Guru extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_hapalan
 * @property int $id_santri
 * @property int $id_guru
 * @property string $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Guru $guru
 * @property-read \App\Models\Santri $santri
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hapalan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hapalan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hapalan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hapalan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hapalan whereIdGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hapalan whereIdHapalan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hapalan whereIdSantri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hapalan whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hapalan whereUpdatedAt($value)
 */
	class Hapalan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_infaq
 * @property int $id_donatur
 * @property int $nominal
 * @property string $tanggal
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Donatur $donatur
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Infaq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Infaq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Infaq query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Infaq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Infaq whereIdDonatur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Infaq whereIdInfaq($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Infaq whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Infaq whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Infaq whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Infaq whereUpdatedAt($value)
 */
	class Infaq extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_jenis_agenda
 * @property string $jenis_agenda
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Agenda> $agenda
 * @property-read int|null $agenda_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisAgenda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisAgenda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisAgenda query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisAgenda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisAgenda whereIdJenisAgenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisAgenda whereJenisAgenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisAgenda whereUpdatedAt($value)
 */
	class JenisAgenda extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_jenis_berita
 * @property string $kategori
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Berita> $berita
 * @property-read int|null $berita_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisBerita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisBerita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisBerita query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisBerita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisBerita whereIdJenisBerita($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisBerita whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisBerita whereUpdatedAt($value)
 */
	class JenisBerita extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_jenis_user
 * @property string $jenis_user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisUser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisUser whereIdJenisUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisUser whereJenisUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JenisUser whereUpdatedAt($value)
 */
	class JenisUser extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_kelas
 * @property string $nama_kelas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Santri> $santri
 * @property-read int|null $santri_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereIdKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereNamaKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereUpdatedAt($value)
 */
	class Kelas extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_kepengurusan
 * @property string $nama
 * @property string $jabatan
 * @property string $mulai
 * @property string $akhir
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kepengurusan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kepengurusan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kepengurusan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kepengurusan whereAkhir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kepengurusan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kepengurusan whereIdKepengurusan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kepengurusan whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kepengurusan whereMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kepengurusan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kepengurusan whereUpdatedAt($value)
 */
	class Kepengurusan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_mapel
 * @property int $id_guru
 * @property string $mapel
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Guru $guru
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Nilai> $nilai
 * @property-read int|null $nilai_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mapel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mapel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mapel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mapel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mapel whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mapel whereIdGuru($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mapel whereIdMapel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mapel whereMapel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mapel whereUpdatedAt($value)
 */
	class Mapel extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_nilai
 * @property int $id_mapel
 * @property int $id_santri
 * @property int $nilai
 * @property string $tahun_ajaran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Mapel $mapel
 * @property-read \App\Models\Santri $santri
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereIdMapel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereIdNilai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereIdSantri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereNilai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereTahunAjaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nilai whereUpdatedAt($value)
 */
	class Nilai extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_santri
 * @property int $id_user
 * @property int $id_kelas
 * @property string $nama_lengkap
 * @property string $nama_panggil
 * @property string $tanggal_lahir
 * @property string $alamat
 * @property string|null $no_telepon
 * @property string|null $email
 * @property string $jenis_kelamin
 * @property string $status
 * @property string $pendidikan_asal
 * @property string $nama_ayah
 * @property string $pekerjaan_ayah
 * @property string $no_hp_ayah
 * @property string $nama_ibu
 * @property string $pekerjaan_ibu
 * @property string $no_hp_ibu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Hapalan> $hapalan
 * @property-read int|null $hapalan_count
 * @property-read \App\Models\Kelas $kelas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Nilai> $nilai
 * @property-read int|null $nilai_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereIdKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereIdSantri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereNamaAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereNamaIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereNamaLengkap($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereNamaPanggil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereNoHpAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereNoHpIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereNoTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri wherePekerjaanAyah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri wherePekerjaanIbu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri wherePendidikanAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Santri whereUpdatedAt($value)
 */
	class Santri extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $judul
 * @property string $deskripsi
 * @property string|null $no_telp
 * @property string $alamat
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem whereNoTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sistem whereUpdatedAt($value)
 */
	class Sistem extends \Eloquent {}
}

namespace App\Models{

use Eloquent;
/**
 * 
 *
 * @property int $id_user
 * @property int $id_jenis_user
 * @property string $username
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Berita> $berita
 * @property-read int|null $berita_count
 * @property-read \App\Models\Donatur|null $donatur
 * @property-read \App\Models\Guru|null $guru
 * @property-read \App\Models\JenisUser $jenisUser
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\Santri|null $santri
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdJenisUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

