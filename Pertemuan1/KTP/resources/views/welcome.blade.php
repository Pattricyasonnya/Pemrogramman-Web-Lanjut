<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KTP Pattricya Sonnya</title>
    <style>
          body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.ktp {
  width: 800px;
  margin: 20px auto;
  /* border: 2px solid #000; */
  border-radius: 10px;
  padding: 20px;
  background-image: url('https://lh5.googleusercontent.com/-W4FM3TIV9I0/TYQzLeULsNI/AAAAAAAAAIo/4HwHZD_bgzQ/s1600/KTP+2.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  background: lightblue;
}

table {
  width: 100%;
  /* border: solid 2px red; */
}
td {
  /* border: solid 2px blue; */
  
}

.header {
  text-align: center;
}

.header img {
  width: 100px;
  height: 100px;
}

.label {
  font-weight: bold;
}

.footer {
  text-align: center;
}

.note {
  font-style: italic;
}
    </style>
</head>
<body>
  <div class="ktp">
    <table >
      <tr>
        <td colspan="3" class="header">
          <h1>PROVINSI JAWA TIMUR</h1>
          <h1>KABUPATEN MADIUN</h1>
        </td>
      </tr>
      <tr>
        <td class="label">NIK</td>
        <td class="value">: 3519145306020002</td>
        <td rowspan="14" style="text-align: center;">
          <img width="210" height="280" src="img/fotoku .jpg" alt=""><br>
          <span>MADIUN</span><br>
          <span>02-10-2019</span><br>
          <img width="100" src="img/ttd.jpg" alt="">
        </td>
      </tr>
      <tr>
        <td class="label">Nama</td>
        <td class="value">: Pattricya Sonnya Fridayanti</td>
      </tr>
      <tr>
        <td class="label">Tempat/Tanggal Lahir</td>
        <td class="value">: Madiun, 13-06-2002</td>
      </tr>
      <tr>
        <td class="label">Jenis Kelamin</td>
        <td class="value">: Perempuan</td>
      </tr>
      <tr>
        <td class="label">Alamat</td>
        <td class="value">: Sidomulyo</td>
      </tr>
      <tr>
        <td class="label">&nbsp;&nbsp;&nbsp;&nbsp;RT/RW</td>
        <td class="value">: 005/002</td>
      </tr>
      <tr>
        <td class="label">&nbsp;&nbsp;&nbsp;&nbsp;Kelurahan/Desa</td>
        <td class="value">: Sidomulyo</td>
      </tr>
      <tr>
        <td class="label">&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan</td>
        <td class="value">: Sawahan</td>
      </tr>
      <tr>
        <td class="label">Agama</td>
        <td class="value">: Islam</td>
      </tr>
      <tr>
        <td class="label">Status Perkawinan</td>
        <td class="value">: Belum Kawin</td>
      </tr>
      <tr>
        <td class="label">Pekerjaan</td>
        <td class="value">: Pelajar/Mahasiswa</td>
      </tr>
      <tr>
        <td class="label">Kewarganegaraan</td>
        <td class="value">: WNI</td>
      </tr>
      <tr>
        <td class="label">Berlaku Hingga</td>
        <td class="value">: Seumur Hidup</td>
      </tr>
      
    </table>
    <br>
  </div>
</body>
</html>