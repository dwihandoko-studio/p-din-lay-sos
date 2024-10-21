<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Pendidikan</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #1a3b5d;
            font-size: 24px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 24px;
            font-weight: bold;
        }

        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow-x: auto;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            max-width: 300px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #1a3b5d;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-sekolah {
            background-color: #e6f4ea;
            color: #1e7e34;
        }

        .status-putus {
            background-color: #fce8e8;
            color: #dc3545;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .charts-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Dashboard Data Pendidikan</h1>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Penduduk Usia Sekolah</h3>
                <div class="number" style="color: #1a73e8;">2,600</div>
            </div>
            <div class="stat-card">
                <h3>Total Bersekolah</h3>
                <div class="number" style="color: #28a745;">2,350</div>
            </div>
            <div class="stat-card">
                <h3>Total Putus Sekolah</h3>
                <div class="number" style="color: #dc3545;">250</div>
            </div>
        </div>

        <div class="charts-container">
            <div class="chart-card">
                <h3>Distribusi per Kelompok Usia</h3>
                <canvas id="barChart"></canvas>
            </div>
            <div class="chart-card">
                <h3>Persentase Status Pendidikan</h3>
                <canvas id="pieChart"></canvas>
            </div>
        </div>

        <div class="table-card">
            <h3>Data Statistik per Kelompok Usia</h3>
            <table>
                <thead>
                    <tr>
                        <th>Kelompok Usia</th>
                        <th>Total</th>
                        <th>Bersekolah</th>
                        <th>Putus Sekolah</th>
                        <th>Persentase Putus Sekolah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>7-12 tahun</td>
                        <td>1,200</td>
                        <td>1,150</td>
                        <td>50</td>
                        <td>4.2%</td>
                    </tr>
                    <tr>
                        <td>13-15 tahun</td>
                        <td>800</td>
                        <td>720</td>
                        <td>80</td>
                        <td>10%</td>
                    </tr>
                    <tr>
                        <td>16-18 tahun</td>
                        <td>600</td>
                        <td>480</td>
                        <td>120</td>
                        <td>20%</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-card">
            <h3>Data Detail Penduduk</h3>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, NIK, atau alamat...">
            </div>
            <table id="detailTable">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>TTL</th>
                        <th>Usia</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Jenjang</th>
                        <th>Sekolah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1002065208140001</td>
                        <td>ANISHA PUTRI</td>
                        <td>2014-08-12</td>
                        <td>9</td>
                        <td>Perempuan</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1072024512190000</td>
                        <td>AURELLIA ADENA N</td>
                        <td>2019-12-05</td>
                        <td>4</td>
                        <td>Perempuan</td>
                        <td>JL WALET</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1082066512080001</td>
                        <td>JIHAN MAFIQOZAH M</td>
                        <td>2011-03-30</td>
                        <td>12</td>
                        <td>Perempuan</td>
                        <td>DUSUN 1. RT/RW 005/002 . SRISAWAHAN. KEC. PUNGGUR. KAB. LAMPUNG TENGAH</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1082066904110002</td>
                        <td>NAIRA LUTFUNNISA</td>
                        <td>2012-04-29</td>
                        <td>11</td>
                        <td>Perempuan</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1202244909200001</td>
                        <td>CORRDELIA KHNANZA R</td>
                        <td>2020-09-09</td>
                        <td>3</td>
                        <td>Perempuan</td>
                        <td>DUSUN XVII</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1205151009160003</td>
                        <td>SAFAAT ABDUL RISKI</td>
                        <td>2016-09-10</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1205152308110003</td>
                        <td>RANDA MANALU</td>
                        <td>2011-08-23</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1302076702120001</td>
                        <td>FANI AFNAN JANNATI</td>
                        <td>2012-02-27</td>
                        <td>11</td>
                        <td>Perempuan</td>
                        <td>JL. DIPONEGORO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1409152208130001</td>
                        <td>DAVID ERLANDO</td>
                        <td>2013-08-22</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1471096303130003</td>
                        <td>RIA RAHMAWATI</td>
                        <td>2013-03-23</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1471096412100006</td>
                        <td>WIDYANA NAFIKA</td>
                        <td>2010-12-24</td>
                        <td>13</td>
                        <td>Perempuan</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1502066707070001</td>
                        <td>PUTRI QULIA AB</td>
                        <td>2007-07-27</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN IV SIDOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1505056805160002</td>
                        <td>MESYA ANDINI</td>
                        <td>2016-05-28</td>
                        <td>7</td>
                        <td>Perempuan</td>
                        <td>TEMPINO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1602150809130001</td>
                        <td>HABIB MUHAMAD ZAKY</td>
                        <td>2013-09-08</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>TOTO KATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1602155105160002</td>
                        <td>MEDINA ZAHIRA SOFA</td>
                        <td>2016-05-11</td>
                        <td>7</td>
                        <td>Perempuan</td>
                        <td>TOTO KATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1602205812070003</td>
                        <td>REVANI KUMALA DEWI</td>
                        <td>2007-12-18</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1602221901110001</td>
                        <td>MUHAMMAD ALVIN SYIHAB</td>
                        <td>2011-01-19</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1602226111070001</td>
                        <td>MUTIARA SYAFAATIDZ DZIKRO</td>
                        <td>2007-11-21</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN III PARAHYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1602226405150001</td>
                        <td>HANIN AQILA KHANSA</td>
                        <td>2015-05-24</td>
                        <td>8</td>
                        <td>Perempuan</td>
                        <td>DUSUN III PARAHYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1605034108120001</td>
                        <td>MURSYIDABILQISRAMADA</td>
                        <td>2012-08-01</td>
                        <td>11</td>
                        <td>Perempuan</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1605034904080002</td>
                        <td>KUNI FATIMATIZZAHRA</td>
                        <td>2008-04-09</td>
                        <td>15</td>
                        <td>Perempuan</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1606021911130004</td>
                        <td>NOVAL ALLZAKY</td>
                        <td>2013-11-19</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMO DADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1606044705070003</td>
                        <td>PUTRI MELIASARI</td>
                        <td>2007-05-07</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN 7</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1607082604080001</td>
                        <td>TIRTA MAULANA</td>
                        <td>2008-04-26</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1608012604110001</td>
                        <td>ABDUR RAHMAN AS SA'DI</td>
                        <td>2011-04-26</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1608015405080001</td>
                        <td>FATIMAH AZZAHRA</td>
                        <td>2008-05-14</td>
                        <td>15</td>
                        <td>Perempuan</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1608081103170001</td>
                        <td>IQBAL YUSUF ABIZAR</td>
                        <td>2017-03-11</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1608082005080001</td>
                        <td>FARHAN DIKA UTAMA</td>
                        <td>2008-05-20</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1609140404110002</td>
                        <td>ILHAM SETIAWAN</td>
                        <td>2011-04-04</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1610042801160003</td>
                        <td>MUHAMMAD MUFID</td>
                        <td>2016-01-28</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>TANJUNG RAYA LINGKUNGAN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1610042812130002</td>
                        <td>AHMAD FATAN</td>
                        <td>2013-12-28</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>TANJUNG RAYA LINGKUNGAN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1610045109130001</td>
                        <td>QONITAH</td>
                        <td>2013-09-11</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>TANJUNG RAYA LINGKUNGAN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1611046310070001</td>
                        <td>ASMIRANDAH WULANDARI</td>
                        <td>2007-10-23</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1612011403130001</td>
                        <td>ZIDAN FERDIANSYAH</td>
                        <td>2013-03-14</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1612012102110002</td>
                        <td>ALVINO PUTRA PRATAMA</td>
                        <td>2011-02-21</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1671086406190001</td>
                        <td>DAMERIA SIDAURUK</td>
                        <td>2019-06-24</td>
                        <td>4</td>
                        <td>Perempuan</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1671086912170004</td>
                        <td>NATALYA SIDAURUK</td>
                        <td>2017-12-29</td>
                        <td>6</td>
                        <td>Perempuan</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1671100907090001</td>
                        <td>MUHAMMAD RAFIQ RAFAEL</td>
                        <td>2009-07-09</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1701054806140002</td>
                        <td>NURUL ALYA AFIFAH</td>
                        <td>2014-06-08</td>
                        <td>9</td>
                        <td>Perempuan</td>
                        <td>NUNGGAL REJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1701055904110002</td>
                        <td>NUR ANZALNA AJRIN KARIIM</td>
                        <td>2011-04-19</td>
                        <td>12</td>
                        <td>Perempuan</td>
                        <td>NUNGGAL REJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1709030807120001</td>
                        <td>MUHAMMAD AZKA ATHAR AL KHAZIM</td>
                        <td>2012-07-08</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI TIRTO BANGUN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1709032104140002</td>
                        <td>MUHAMMAD AKINS ATHIR AR RAYYAN</td>
                        <td>2014-04-21</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI TIRTO BANGUN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1800206531013000</td>
                        <td>ARIFA NGULYA</td>
                        <td>2013-10-13</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1800206640409000</td>
                        <td>KHALDA SALSABELA</td>
                        <td>2009-04-24</td>
                        <td>14</td>
                        <td>Perempuan</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1801041306190005</td>
                        <td>MUZZAMMIL AZZAM</td>
                        <td>2019-06-13</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II BUMISARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1801041510150001</td>
                        <td>MUHPIAN OKTA TRINATA</td>
                        <td>2015-10-15</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>JL KERAMAT JAYA DSN II HAJIMENA</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1801045508090003</td>
                        <td>JUWITA FAULIA</td>
                        <td>2009-06-15</td>
                        <td>14</td>
                        <td>Perempuan</td>
                        <td>JL KERAMAT JAYA DSN II HAJIMENA</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1801045512110003</td>
                        <td>NAKEISHA ABIGAIL CHAVALI</td>
                        <td>2011-12-15</td>
                        <td>12</td>
                        <td>Perempuan</td>
                        <td>PERUM GOLDEN VILLAGE BLOK F4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1801045706160004</td>
                        <td>AURA GHINA RAMADHANI</td>
                        <td>2016-06-17</td>
                        <td>7</td>
                        <td>Perempuan</td>
                        <td>DUSUN II BUMISARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1801046104070007</td>
                        <td>AJENG SYAHFRILICIA HARZETI</td>
                        <td>2007-04-21</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN V KARANG ANYAR</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1801046110150007</td>
                        <td>AXA AISYAH HARZETI</td>
                        <td>2015-10-21</td>
                        <td>8</td>
                        <td>Perempuan</td>
                        <td>DUSUN V KARANG ANYAR</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1801047009160001</td>
                        <td>ZALFA FARZANA KHALIQA</td>
                        <td>2016-09-30</td>
                        <td>7</td>
                        <td>Perempuan</td>
                        <td>PERUM GOLDEN VILLAGE BLOK F4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1801064508160001</td>
                        <td>ANNISA PUTRI MAHARANI</td>
                        <td>2016-08-05</td>
                        <td>7</td>
                        <td>Perempuan</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1801066409130001</td>
                        <td>NADINE LATIFFATUL UMAYA</td>
                        <td>2013-09-24</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1801081102140003</td>
                        <td>FERDINAN SETIAWAN</td>
                        <td>2014-02-11</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1801084411090001</td>
                        <td>NOVITA WINDI SETIAWATI</td>
                        <td>2009-11-04</td>
                        <td>14</td>
                        <td>Perempuan</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1801131312190002</td>
                        <td>AHMAD IRSYAD BAYHAQI</td>
                        <td>2019-12-13</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>KARANG REJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1801132204190002</td>
                        <td>ELPRINCE KHAIRAN WIBOWO</td>
                        <td>2019-04-22</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1 D</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1801170310110001</td>
                        <td>SUPRIO HEDI UTOMO</td>
                        <td>2011-10-03</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1801172704170002</td>
                        <td>ADI WIJAYA TITO UTOMO</td>
                        <td>2017-04-27</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1801172704170003</td>
                        <td>ADI WILAGA TITO UTOMO</td>
                        <td>2017-04-27</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1801231702080002</td>
                        <td>YOGA SAPUTRA</td>
                        <td>2008-02-17</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4 TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1801232712110003</td>
                        <td>RAMA ISMAIL EFENDI</td>
                        <td>2011-12-27</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4 TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1801234204180003</td>
                        <td>QISTI AULIA RAHMA</td>
                        <td>2018-04-02</td>
                        <td>5</td>
                        <td>Perempuan</td>
                        <td>DUSUN 4 TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1801235602130002</td>
                        <td>LUTFI SALMA MAHARANI</td>
                        <td>2013-02-16</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802004804070002</td>
                        <td>LAILA NADIAH</td>
                        <td>2007-04-08</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802006500911004</td>
                        <td>MARIA ANITASETIAWATI</td>
                        <td>2011-09-10</td>
                        <td>12</td>
                        <td>Perempuan</td>
                        <td>NGESTIRAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802010309070004</td>
                        <td>NABIL MAULANA</td>
                        <td>2007-09-03</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>NGESTIRAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802022905180001</td>
                        <td>RENNO ALFIANSYAH SAPUTRA</td>
                        <td>2018-05-29</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802024706120003</td>
                        <td>SYAHRISYAH NUR TIYANI</td>
                        <td>2012-06-07</td>
                        <td>11</td>
                        <td>Perempuan</td>
                        <td>BANJAR MULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802024910130001</td>
                        <td>HASHSHOH</td>
                        <td>2013-10-09</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802026803090003</td>
                        <td>JANA</td>
                        <td>2009-03-28</td>
                        <td>14</td>
                        <td>Perempuan</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802030501120002</td>
                        <td>AGENG MUHAMMAD</td>
                        <td>2012-01-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5 TOTOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802031009140001</td>
                        <td>ALVINO SEPTIAN FERNANDO</td>
                        <td>2014-09-10</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802031211100002</td>
                        <td>RIZQI ADITYA</td>
                        <td>2011-11-12</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802034701170001</td>
                        <td>JEVITA HERA ANGGRAINI</td>
                        <td>2017-01-07</td>
                        <td>6</td>
                        <td>Perempuan</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802036806180001</td>
                        <td>MUFIDA LAILATUNISA</td>
                        <td>2018-06-28</td>
                        <td>5</td>
                        <td>Perempuan</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802037007190002</td>
                        <td>NUR AZIZAH SHAKIRA</td>
                        <td>2019-07-30</td>
                        <td>4</td>
                        <td>Perempuan</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802040107200009</td>
                        <td>ARIF ZIO WIJAYA</td>
                        <td>2020-07-01</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802040207130001</td>
                        <td>REZA SAPUTRA</td>
                        <td>2013-07-02</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802040606130001</td>
                        <td>RAHMAT AGAM ATHAILAH</td>
                        <td>2013-06-06</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802040711140001</td>
                        <td>ABDURRAHMAN AR RAYYAN</td>
                        <td>2014-11-07</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802040805070004</td>
                        <td>ALFITO BAYU NUGROHO</td>
                        <td>2007-05-08</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1 NGESTIRAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802040907190003</td>
                        <td>RAFFASYA PRADIPTA</td>
                        <td>2019-07-09</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802041107170003</td>
                        <td>FACHRI IBNU MAHIR</td>
                        <td>2017-07-11</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>SIDOREJO 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802041210130003</td>
                        <td>REZA PRATAMA</td>
                        <td>2013-10-12</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SINDANG SARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802041501100001</td>
                        <td>IBNU RADITYA</td>
                        <td>2010-01-15</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DSN 2 ASTOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802041703160002</td>
                        <td>ABDULLAH AL MUBAROK</td>
                        <td>2016-03-17</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802041708140002</td>
                        <td>TRISTAN AGUNG SAPUTRA</td>
                        <td>2014-08-17</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SARI AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802041908150002</td>
                        <td>IQBAL WIDIANTARA</td>
                        <td>2015-08-19</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802041911120001</td>
                        <td>RENDY PRASETYO</td>
                        <td>2012-11-19</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802042002150001</td>
                        <td>FAHRI AHMAD</td>
                        <td>2015-02-20</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802042103080005</td>
                        <td>FADLI AHMAD AZAM</td>
                        <td>2008-03-21</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802042705120002</td>
                        <td>DICKI FIRMANSYAH</td>
                        <td>2012-05-27</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802042803070004</td>
                        <td>LUCKY ADJI PRATAMA</td>
                        <td>2007-03-28</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802042804090001</td>
                        <td>MUHAMMAD HASANUDDIN M</td>
                        <td>2009-04-28</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802044109100003</td>
                        <td>SEPTIKA RAHMADANI</td>
                        <td>2010-09-01</td>
                        <td>13</td>
                        <td>Perempuan</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802044411120001</td>
                        <td>SALSABILA NUR ASHIFA</td>
                        <td>2012-11-04</td>
                        <td>11</td>
                        <td>Perempuan</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802044501070004</td>
                        <td>AZKA DINAR YANUARSYAH</td>
                        <td>2007-01-05</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802044504120002</td>
                        <td>MUSTIKA PUTRI NUR ANGGRAINI</td>
                        <td>2012-04-05</td>
                        <td>11</td>
                        <td>Perempuan</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802044510140003</td>
                        <td>FAHIRA SALWA NABILA</td>
                        <td>2014-10-05</td>
                        <td>9</td>
                        <td>Perempuan</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802044602170001</td>
                        <td>KHAIRA DEPA RAFANDA</td>
                        <td>2017-02-06</td>
                        <td>6</td>
                        <td>Perempuan</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802044610100003</td>
                        <td>SHAKIRA NAFISA AZZIA</td>
                        <td>2010-10-06</td>
                        <td>13</td>
                        <td>Perempuan</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802044701180005</td>
                        <td>DINARA FALISHA QUEENA</td>
                        <td>2018-01-07</td>
                        <td>5</td>
                        <td>Perempuan</td>
                        <td>DUSUN 9</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802044812120003</td>
                        <td>NATASYA MUTIA SARI</td>
                        <td>2012-12-08</td>
                        <td>11</td>
                        <td>Perempuan</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802045001090002</td>
                        <td>ELI HANDAYANI</td>
                        <td>2009-01-10</td>
                        <td>14</td>
                        <td>Perempuan</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802045203070001</td>
                        <td>NAJWA NYAK DARA</td>
                        <td>2007-03-12</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN IRIAN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802045207070004</td>
                        <td>DEA ANISA</td>
                        <td>2007-07-12</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802045409140001</td>
                        <td>NATASYA ANGGRAENI</td>
                        <td>2014-09-14</td>
                        <td>9</td>
                        <td>Perempuan</td>
                        <td>DUSUN IV ASTOMULYO KECAMATAN PUNGGUR KABUPATEN LAMPUNG TENGAH</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802045704090002</td>
                        <td>DIAN INTAN SAPUTRI</td>
                        <td>2009-04-17</td>
                        <td>14</td>
                        <td>Perempuan</td>
                        <td>DUSUN 5 KARANG ANYAR</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802045711160002</td>
                        <td>FATIMAH AZZAHRA MP</td>
                        <td>2016-11-17</td>
                        <td>7</td>
                        <td>Perempuan</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802045904100003</td>
                        <td>ZHIEFARA ABELIA</td>
                        <td>2010-04-19</td>
                        <td>13</td>
                        <td>Perempuan</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802045908110001</td>
                        <td>ANNISA RAHMA DEWI</td>
                        <td>2011-08-19</td>
                        <td>12</td>
                        <td>Perempuan</td>
                        <td>DUSUN IRIAN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802046004170003</td>
                        <td>APRILIANA</td>
                        <td>2017-04-20</td>
                        <td>6</td>
                        <td>Perempuan</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802046303130001</td>
                        <td>ADINDA NAZWA ANGGRAINI</td>
                        <td>2013-03-23</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802046305040005</td>
                        <td>MELISA ARDIRA</td>
                        <td>2007-05-23</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN VI TIRTOBANGUN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802046309130001</td>
                        <td>AQILLA ELVIRA PUTRI</td>
                        <td>2013-09-23</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802046401130002</td>
                        <td>DELIA PUTRI</td>
                        <td>2013-01-24</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802046409180002</td>
                        <td>ALIKA NAILA PUTRI</td>
                        <td>2018-09-24</td>
                        <td>5</td>
                        <td>Perempuan</td>
                        <td>NGESTI RAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802046603130002</td>
                        <td>ALMEERA KURNIA RAHMA</td>
                        <td>2013-03-26</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802046604140001</td>
                        <td>ANISA APRILIA PUTRI</td>
                        <td>2014-04-26</td>
                        <td>9</td>
                        <td>Perempuan</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802046708110001</td>
                        <td>ANGELINA CHIKA RAMADANI</td>
                        <td>2011-08-27</td>
                        <td>12</td>
                        <td>Perempuan</td>
                        <td>DUSUN 6 MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802046708160003</td>
                        <td>ANINDITA KEYSA ZAHRA</td>
                        <td>2016-08-27</td>
                        <td>7</td>
                        <td>Perempuan</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802046802140001</td>
                        <td>LIZA AMALIA</td>
                        <td>2014-02-28</td>
                        <td>9</td>
                        <td>Perempuan</td>
                        <td>DUSUN II MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802047003090001</td>
                        <td>ILMA NAFI'A</td>
                        <td>2009-03-30</td>
                        <td>14</td>
                        <td>Perempuan</td>
                        <td>DUSUN VII</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802050401130001</td>
                        <td>ALVINO FAREL ADMAJA</td>
                        <td>2013-01-04</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>TOTO KATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802050603180001</td>
                        <td>ARKAN PUTRA SETIAWAN</td>
                        <td>2018-03-06</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802051012120002</td>
                        <td>ANAS NURFHADILAH</td>
                        <td>2012-12-10</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802052208110001</td>
                        <td>FADHIL KURNIA PRATAMA</td>
                        <td>2011-08-22</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802052300100003</td>
                        <td>MUHAMMAD FAHTAN GHOZALI</td>
                        <td>2010-06-23</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802052303130001</td>
                        <td>YAHYA</td>
                        <td>2013-03-23</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802053005070006</td>
                        <td>MUHAMMAD ATHAR</td>
                        <td>2007-05-30</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802053011110002</td>
                        <td>NIZAM NURHAKIM</td>
                        <td>2011-11-30</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802054110200001</td>
                        <td>VERLINA REGINA PUTRI</td>
                        <td>2020-10-01</td>
                        <td>3</td>
                        <td>Perempuan</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802054209100003</td>
                        <td>SALWA KHALISA ATHAILLAH</td>
                        <td>2010-09-02</td>
                        <td>13</td>
                        <td>Perempuan</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802054508150001</td>
                        <td>YESI NUR KHASANAH</td>
                        <td>2015-08-08</td>
                        <td>8</td>
                        <td>Perempuan</td>
                        <td>RT 15 DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802054601100001</td>
                        <td>RUMAYSHA</td>
                        <td>2010-01-06</td>
                        <td>13</td>
                        <td>Perempuan</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802054612070002</td>
                        <td>CERY ADINDA CAHYA WIGUNA</td>
                        <td>2007-12-06</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802054804130002</td>
                        <td>FAIHAA RAYYAA KAMIILAH</td>
                        <td>2013-04-08</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802054911170002</td>
                        <td>FRAZA AYUNDA PUTRI</td>
                        <td>2017-11-09</td>
                        <td>6</td>
                        <td>Perempuan</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802055703150001</td>
                        <td>EMIL OKTA FELISYA</td>
                        <td>2015-03-17</td>
                        <td>8</td>
                        <td>Perempuan</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802055710080002</td>
                        <td>ARINDI</td>
                        <td>2008-10-17</td>
                        <td>15</td>
                        <td>Perempuan</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802056005070001</td>
                        <td>AFTINA HANIFAH</td>
                        <td>2007-05-20</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802056164150001</td>
                        <td>QONITTAH AYUDIA .I</td>
                        <td>2015-04-21</td>
                        <td>8</td>
                        <td>Perempuan</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802056401110001</td>
                        <td>ATHAFATU IFFAH HIDAYAT</td>
                        <td>2011-01-24</td>
                        <td>12</td>
                        <td>Perempuan</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802056705180001</td>
                        <td>DHIYA KHOIROTUN HISAN</td>
                        <td>2018-05-27</td>
                        <td>5</td>
                        <td>Perempuan</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060030711000</td>
                        <td>ARKA MARMORA</td>
                        <td>2011-07-03</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060101070001</td>
                        <td>AZRIL FAUZAN HANAFI</td>
                        <td>2007-01-01</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060101080001</td>
                        <td>ACHMAD RIDWAN</td>
                        <td>2008-01-01</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060101080002</td>
                        <td>HANDIKA DWI PERMANA</td>
                        <td>2008-01-01</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III.. PARAHYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060101110003</td>
                        <td>AFABIAN MUHAMAD YANFA</td>
                        <td>2011-01-01</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060101110004</td>
                        <td>M.BINTANG SYAH PUTRA</td>
                        <td>2016-01-01</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060101130003</td>
                        <td>JEPRI</td>
                        <td>2013-01-01</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060101180002</td>
                        <td>MUHAMMAD YUSUF ALRASYID</td>
                        <td>2018-01-01</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1 MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060101190002</td>
                        <td>PRAJA HAFIZ DIRGANTARA</td>
                        <td>2019-01-01</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1 NGESTIRAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060101200001</td>
                        <td>MUHAMMAD ALFIAN FERNANDO</td>
                        <td>2020-01-01</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060102100002</td>
                        <td>KHOIRON NURSIDIQ</td>
                        <td>2010-02-01</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060102110001</td>
                        <td>FEBRI NURCAHYO</td>
                        <td>2011-02-01</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060102110002</td>
                        <td>M. RIFKI MUSTOFA</td>
                        <td>2011-02-01</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060102130001</td>
                        <td>YUSUF KENZO</td>
                        <td>2013-02-01</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060102130002</td>
                        <td>FEBRYANO ADI YANSYAH</td>
                        <td>2013-02-01</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060102170001</td>
                        <td>ACHMAD ARASYID</td>
                        <td>2017-02-01</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060103080001</td>
                        <td>AHMAD SAHIR MUJTABA</td>
                        <td>2008-03-01</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060103100004</td>
                        <td>M. IRFAN IZZUDIN</td>
                        <td>2010-03-01</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060103130001</td>
                        <td>MUHAMMAD ALIF HANAFI</td>
                        <td>2013-03-01</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060103190001</td>
                        <td>MUHAMMAD KHOIRI AL HAZIQ</td>
                        <td>2019-03-01</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060104110002</td>
                        <td>NOFRIANSAH</td>
                        <td>2011-04-01</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>TOTO KATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060104130001</td>
                        <td>ASHIF FATTIH AL GIFARI</td>
                        <td>2013-04-01</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060104150002</td>
                        <td>KEVIN FERNANDO BRADIANSA</td>
                        <td>2015-04-01</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060104200001</td>
                        <td>KANNAKA GILANG DINATA</td>
                        <td>2020-04-01</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SINDANGSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060105090002</td>
                        <td>MUHAMAD FAIZ</td>
                        <td>2009-05-01</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060105090003</td>
                        <td>MUHAMMAD FAHMI MUKHTAR</td>
                        <td>2009-05-01</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060105090004</td>
                        <td>MUHAMMAD ULINNUHA</td>
                        <td>2009-05-01</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060105090005</td>
                        <td>ADITYA RADIS PRATAMA</td>
                        <td>2009-05-01</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III.</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060105110001</td>
                        <td>NAUVAL FATAN ASSIDIQ</td>
                        <td>2011-05-01</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060105120001</td>
                        <td>AHMAD AKBAR DWI MAULANA</td>
                        <td>2012-05-01</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VII</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060105150001</td>
                        <td>RAFFA ZAIDAN</td>
                        <td>2015-05-01</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060105190001</td>
                        <td>ADZRIL KENZIE AL HARIS</td>
                        <td>2019-05-01</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060106080004</td>
                        <td>RISMAN ADI WIJAYA</td>
                        <td>2008-06-01</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VII</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060106080005</td>
                        <td>DEDI RIAWAN</td>
                        <td>2008-06-01</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060106100002</td>
                        <td>ARYADI WANGSA</td>
                        <td>2010-06-01</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060106110001</td>
                        <td>FAIZ MUTANAHUL HUDA</td>
                        <td>2011-06-01</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060106110002</td>
                        <td>FIRMAN DAKA</td>
                        <td>2011-06-01</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060106130001</td>
                        <td>AHMAD NUR KHOLID</td>
                        <td>2013-06-01</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060106130002</td>
                        <td>MUHAMMAD RAFA FADHILLAH</td>
                        <td>2013-06-01</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060106140001</td>
                        <td>ALIANDO NIZAR</td>
                        <td>2014-06-01</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060106170001</td>
                        <td>GILANG RAMADAN</td>
                        <td>2017-06-01</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060106180001</td>
                        <td>PRANAJA DANISH BIRENDRA</td>
                        <td>2018-06-01</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060106200001</td>
                        <td>ALDEBARAN FATIR RAFAEL</td>
                        <td>2020-06-01</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4 SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060107070001</td>
                        <td>MUKLIS TRIAWAN</td>
                        <td>2007-07-01</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1 MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060107070003</td>
                        <td>WILDAN INDRA LESMANA</td>
                        <td>2007-07-01</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060107080002</td>
                        <td>TRI YULIANTO</td>
                        <td>2008-07-01</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060107080003</td>
                        <td>ANANG MUNTHOHIR</td>
                        <td>2008-07-01</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060107080004</td>
                        <td>REHAN ALVIAN</td>
                        <td>2008-01-30</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060107100005</td>
                        <td>MUHAMAD FAHRIZAL</td>
                        <td>2010-07-01</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060107100006</td>
                        <td>RO'ID ZIDAN HAKIM</td>
                        <td>2010-07-01</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060107130009</td>
                        <td>JULIAN RIFKI SAPUTRA</td>
                        <td>2013-07-01</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060107130010</td>
                        <td>DENNIS REFANO</td>
                        <td>2013-07-01</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060108070001</td>
                        <td>M. RIZAL SAPUTRA</td>
                        <td>2007-08-01</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 10</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060108080003</td>
                        <td>VALENT JAYANTO</td>
                        <td>2008-08-01</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060108090001</td>
                        <td>PUTRA GUSTIAWAN</td>
                        <td>2009-08-01</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060108100001</td>
                        <td>ALFIZA DWI HENDRAWAN</td>
                        <td>2010-08-01</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060108100002</td>
                        <td>MUHAMAD FARIZ ALAMSYAH</td>
                        <td>2010-08-01</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060108110001</td>
                        <td>RIZKI RAMADHAN</td>
                        <td>2011-08-01</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060108150001</td>
                        <td>MAHESA JENAR</td>
                        <td>2015-08-01</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SINDANGSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060108180001</td>
                        <td>AL SHAMEER HAKIM</td>
                        <td>2018-08-01</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060108190001</td>
                        <td>ADAM ALAMSYAH</td>
                        <td>2019-08-01</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SINDANGSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060108190003</td>
                        <td>ZLATAN EVANO VIRMANSYAH</td>
                        <td>2019-08-01</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060109070001</td>
                        <td>PRABU BUMI AMCA</td>
                        <td>2007-08-01</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060109100001</td>
                        <td>MUHAMMAD HANIF</td>
                        <td>2010-09-01</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060109150001</td>
                        <td>FABIYAN AKBAR ALL RIZKY</td>
                        <td>2015-09-01</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060109190001</td>
                        <td>MUHAMMAD AFIF NUMATYA</td>
                        <td>2019-09-01</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060110080001</td>
                        <td>NARYA REYHAN SAPUTRA</td>
                        <td>2008-10-01</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060110120001</td>
                        <td>ZULFIKAR NUR HIDAYAH</td>
                        <td>2012-10-01</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060110140001</td>
                        <td>ZAIDAAN OKTAN ALDIANO</td>
                        <td>2014-10-01</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060110180001</td>
                        <td>AFID MAULANA</td>
                        <td>2018-10-01</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060110200001</td>
                        <td>KENZO ALFANO</td>
                        <td>2020-10-01</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060111080001</td>
                        <td>MUHAMMAD RIZKI SAPUTRA</td>
                        <td>2008-11-01</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060111100001</td>
                        <td>ANANDA CHESTA MAHARDIKA</td>
                        <td>2010-11-01</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060111100002</td>
                        <td>RACHEL AMANDIKA</td>
                        <td>2010-11-01</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060111120001</td>
                        <td>ATHA SENJA NOVENDRA</td>
                        <td>2012-11-01</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060111150001</td>
                        <td>MUHAMAD RAFFA SARFARAZ YUSUF</td>
                        <td>2015-11-01</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060111180001</td>
                        <td>RAFISQI ARFADHIA KUSUMA</td>
                        <td>2018-11-01</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060111190001</td>
                        <td>RESTU AJI WIBOWO</td>
                        <td>2019-11-01</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060112070001</td>
                        <td>FAREL ARITONANG</td>
                        <td>2007-12-01</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060112140001</td>
                        <td>MUFAZZAL RASYIQUL PRADIPTA</td>
                        <td>2014-12-01</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060112160001</td>
                        <td>MUHAMMAD LUTHFI NABAWI</td>
                        <td>2016-12-01</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060201080001</td>
                        <td>WISNU DEOADI</td>
                        <td>2008-01-02</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I, NGESTIRAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060201080002</td>
                        <td>NAWANG ARDIAN PRATAMA</td>
                        <td>2008-01-02</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060201140001</td>
                        <td>RASYID ANNAFI</td>
                        <td>2014-01-02</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060201150001</td>
                        <td>ADHWA ANANDA FAJLI</td>
                        <td>2015-10-02</td>
                        <td>8</td>
                        <td>Perempuan</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060201180001</td>
                        <td>ANDRA ARDIWINATA</td>
                        <td>2018-01-02</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060201190001</td>
                        <td>ELVANO ABID MUZAKI</td>
                        <td>2019-01-02</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060201210001</td>
                        <td>RAYYAN AL GAUZHAN</td>
                        <td>2021-01-02</td>
                        <td>2</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060202090001</td>
                        <td>MUHAMAD ZIDAN</td>
                        <td>2009-02-02</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060202100001</td>
                        <td>REZA RADITYA PRATAMA</td>
                        <td>2010-02-02</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060202160001</td>
                        <td>MUHAMMAD AZKHA FEBRIANTO</td>
                        <td>2016-02-02</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060202180001</td>
                        <td>NAZRIL MAHESA RASHAD</td>
                        <td>2018-02-02</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060203090001</td>
                        <td>ALTAF FAUZAN ARSYAD</td>
                        <td>2009-03-02</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060203090002</td>
                        <td>VINCENTIUS FREDIKA</td>
                        <td>2009-03-02</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060203090003</td>
                        <td>MUHAMMAD DUDLE HAFY MUAZZAM</td>
                        <td>2009-03-02</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060203130001</td>
                        <td>ARIF RAHMAN HAKIM</td>
                        <td>2013-03-02</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060203130002</td>
                        <td>RASYA PRAYOGA</td>
                        <td>2013-03-02</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060203160001</td>
                        <td>ADYA RASYA ARRAFIF</td>
                        <td>2016-03-02</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060203180001</td>
                        <td>MUHAMAD FAHRUR ULUM</td>
                        <td>2018-03-02</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060203200001</td>
                        <td>ELVANO LUCIO ATHAFANNI</td>
                        <td>2020-03-02</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060203200002</td>
                        <td>AZKIYA ANANDITA PUTRI</td>
                        <td>2020-03-02</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060204070002</td>
                        <td>RISKI ARDIANSYAH</td>
                        <td>2007-04-02</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060204080001</td>
                        <td>M. FAUZAN SIDIQ</td>
                        <td>2008-04-02</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060204110001</td>
                        <td>SANDY MUHAMMAD FAUZI</td>
                        <td>2011-04-02</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060204120001</td>
                        <td>EDI SAPUTRA</td>
                        <td>2012-04-02</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060204120002</td>
                        <td>MUHAMMAD RISKI AGUSTINA</td>
                        <td>2012-04-02</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060204130001</td>
                        <td>FAQIH ABDILLAH YUNUS</td>
                        <td>2013-04-02</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060204130002</td>
                        <td>FACHRI ABDILLAH YUNUS</td>
                        <td>2013-04-02</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060204200001</td>
                        <td>KEANO ALBY ARZHANKA</td>
                        <td>2020-04-02</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060204240001</td>
                        <td>REYVAN SAPUTRA</td>
                        <td>2021-04-02</td>
                        <td>2</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060205090001</td>
                        <td>MEINDRA ALWI IRAWAN</td>
                        <td>2009-05-02</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060205090002</td>
                        <td>FAJAR PUTRA MAULANA ILHAM</td>
                        <td>2009-05-02</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060205120001</td>
                        <td>GALIH SANJAYA</td>
                        <td>2015-05-02</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SINDANGSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060205120002</td>
                        <td>ROBBY DWI SAMPORNA</td>
                        <td>2012-05-02</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060205130001</td>
                        <td>HANGGA YUDA BRAWIJAYA</td>
                        <td>2013-05-02</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060205140001</td>
                        <td>ERWIN RAHMAD HIDAYAT</td>
                        <td>2014-05-02</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060205140002</td>
                        <td>MUHAMMAD DIMAS PRATAMA</td>
                        <td>2014-05-02</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060205150001</td>
                        <td>ALIF HAFIZH SHARKAN</td>
                        <td>2015-05-02</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060205170001</td>
                        <td>PRADIPTA AMZARI</td>
                        <td>2017-05-02</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060206070001</td>
                        <td>RAIHAN DWIKY SAPUTRA</td>
                        <td>2007-06-02</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060206070002</td>
                        <td>M. ARKAN IHSANDI</td>
                        <td>2007-06-02</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060206070005</td>
                        <td>ADE RIJAL PRAYOGA</td>
                        <td>2007-06-02</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060206070006</td>
                        <td>HASBY ASH SHIDIQI</td>
                        <td>2007-06-02</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060206100001</td>
                        <td>FINSEN ABI SAPUTRA</td>
                        <td>2010-06-02</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060206100002</td>
                        <td>RAHMAT KHOIRUL ASRORI</td>
                        <td>2010-06-02</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060206120001</td>
                        <td>FARIS ALFAREZEL</td>
                        <td>2012-06-02</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DS.III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060206150001</td>
                        <td>AHMAD FAHRI</td>
                        <td>2015-06-02</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060206160001</td>
                        <td>ASHLAN FAQIH RAMADHAN</td>
                        <td>2016-06-02</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060206170001</td>
                        <td>MUHAMMAD ARFAN ALRIZKI</td>
                        <td>2017-06-02</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060207070002</td>
                        <td>RIZKI ADI PURNAMA</td>
                        <td>2007-07-02</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4 SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060207120001</td>
                        <td>MOHAMMAD NIZAM</td>
                        <td>2012-07-02</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060207160001</td>
                        <td>FAHLEVI SYAHREZA</td>
                        <td>2016-07-02</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060207170001</td>
                        <td>RADJA HENDRA ABRISAM</td>
                        <td>2017-07-02</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060207190002</td>
                        <td>ZAIN NAUFAL BILAL</td>
                        <td>2019-07-02</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060207200002</td>
                        <td>RAFA FAUZAN KAMIL</td>
                        <td>2020-07-02</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060208080001</td>
                        <td>RENALDI SAPUTRA</td>
                        <td>2008-08-02</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2 SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060208110001</td>
                        <td>MUHAMAD FERDIANSYAH</td>
                        <td>2011-08-02</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060208110002</td>
                        <td>AHZA HAMIZAN</td>
                        <td>2011-08-02</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060208120001</td>
                        <td>DENNIS RADITYA RAMADHAN</td>
                        <td>2012-08-02</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060208170002</td>
                        <td>SYAHDAN HAIKAL FAJRI</td>
                        <td>2017-08-02</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060209110001</td>
                        <td>ALFIN IZZA FIDDINI</td>
                        <td>2011-09-02</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II TRITUNGGAL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060209120001</td>
                        <td>MUHAMMAD HANIF SYAPUTRA</td>
                        <td>2012-09-02</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060209140001</td>
                        <td>VIAN KUSUMA</td>
                        <td>2014-09-02</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060209140003</td>
                        <td>ALZAM ABDILAH</td>
                        <td>2014-09-02</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060209170001</td>
                        <td>AUZAN DAFFA ARDIANTO</td>
                        <td>2017-09-02</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 7</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060210080003</td>
                        <td>AMAR RIFQI OKTARIADI</td>
                        <td>2008-10-02</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060210080006</td>
                        <td>ZANIDIN AHMAD</td>
                        <td>2008-10-02</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060210100002</td>
                        <td>M. FARHAN NURROHMAN</td>
                        <td>2010-10-02</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060210100003</td>
                        <td>RADITA ALDO MUHROBIN</td>
                        <td>2010-10-02</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060210100004</td>
                        <td>DAMAR AJI PRASTYO</td>
                        <td>2010-10-02</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>NUNGGAL REJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060210110001</td>
                        <td>FAIZ NUR IHSAN</td>
                        <td>2011-10-02</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II BADRANSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060210160001</td>
                        <td>ALDO IVANO SHAPUTRA</td>
                        <td>2016-10-02</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060211090001</td>
                        <td>HAKKI MUHAMMAD FAISAL</td>
                        <td>2009-11-02</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060211100001</td>
                        <td>BERTRAND AMOR CHRISTO</td>
                        <td>2010-11-02</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060211120001</td>
                        <td>RICO NANDA SAPUTRA</td>
                        <td>2012-11-02</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II TRITUNGGAL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060211140001</td>
                        <td>RESTU HIDAYAT</td>
                        <td>2014-11-02</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060211150001</td>
                        <td>RAFARDHAN FILIO AZZAMY</td>
                        <td>2015-11-02</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2 TRITUNGGAL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060212120001</td>
                        <td>DAFFA RASYID KHOIRUDDIN</td>
                        <td>2012-12-02</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060212130001</td>
                        <td>ERFAN PURNAMA</td>
                        <td>2013-12-02</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2 SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060212140001</td>
                        <td>KENZI DESWA PRATAMA</td>
                        <td>2014-12-02</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI TIRTOBANGUN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060212140002</td>
                        <td>MUHAMAD RIDWAN</td>
                        <td>2014-12-02</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060212150001</td>
                        <td>ALDI FIRMANSAH</td>
                        <td>2015-12-02</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>NUNGGAL REJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060212160001</td>
                        <td>FADHLAN AMALUL ARIFIN</td>
                        <td>2016-12-02</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060212190001</td>
                        <td>TRISTAN AMZARI</td>
                        <td>2019-12-02</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060260800001</td>
                        <td>M FACHRI PRATAMA</td>
                        <td>2008-06-02</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060301080003</td>
                        <td>M. ALFATHONI</td>
                        <td>2008-01-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060301090001</td>
                        <td>AKHDAN REYNARD JANDIY</td>
                        <td>2009-01-03</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060301140002</td>
                        <td>MUHAMAD IRFAN</td>
                        <td>2014-01-03</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060301150001</td>
                        <td>RIZKI BAGUS IRAWAN</td>
                        <td>2015-01-03</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>TOTO KATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060301150002</td>
                        <td>MUHAMMAD HASNAFUR R</td>
                        <td>2015-01-03</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060301160001</td>
                        <td>RANGGA ARDIANSYAH</td>
                        <td>2016-01-03</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060301180001</td>
                        <td>NAUFAL DIFA DIRGANTARA</td>
                        <td>2018-01-03</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060301190001</td>
                        <td>AQSHA AKMAL AR ROYAN</td>
                        <td>2019-01-03</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060301200001</td>
                        <td>GHIBRAN RIZKY SAPUTRA</td>
                        <td>2020-01-03</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060302070001</td>
                        <td>ANANTA HIMANSYAH</td>
                        <td>2007-02-04</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060302070002</td>
                        <td>BAGUS PRASETYO</td>
                        <td>2007-02-03</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060302110001</td>
                        <td>DIMAS GALANG ARMANDA</td>
                        <td>2011-02-03</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060302120001</td>
                        <td>RISKY RADITYA</td>
                        <td>2012-02-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060302150001</td>
                        <td>RIFFA AHMAD FEBRIAN</td>
                        <td>2015-02-03</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060302170001</td>
                        <td>AHMAD BUSYAIRI</td>
                        <td>2017-02-03</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II TRITUNGGAL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060302210002</td>
                        <td>NIZAR SURYA AFIS</td>
                        <td>2021-02-03</td>
                        <td>2</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060303070001</td>
                        <td>MUHAMAD ARTHA PRATAMA</td>
                        <td>2007-03-03</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060303110001</td>
                        <td>VADILLAH MAHMUD QURNNANDA</td>
                        <td>2011-03-03</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060303120001</td>
                        <td>ALDIANO IRZI NUGRAHA</td>
                        <td>2012-03-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SINDANG SARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060303130001</td>
                        <td>PATIH SYAIKHUL AHMAD</td>
                        <td>2013-03-03</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060303130002</td>
                        <td>ABI MAULANA</td>
                        <td>2013-03-03</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060303170002</td>
                        <td>MUHAMAD AZRIL MARDIANSYAH</td>
                        <td>2017-03-03</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060304080003</td>
                        <td>RIZKY SENA PRATAMA</td>
                        <td>2008-04-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060304080005</td>
                        <td>AHMAD FAUZI</td>
                        <td>2008-04-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060304100001</td>
                        <td>MUMTAZUL FIQRI</td>
                        <td>2010-04-03</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN DIGUL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060304110003</td>
                        <td>MAHFUDH MABRURI</td>
                        <td>2011-04-03</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5 KARANG ANYAR</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060304120002</td>
                        <td>APTANA BISMA</td>
                        <td>2012-04-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060304140001</td>
                        <td>ABIAN ZIKRI HADI</td>
                        <td>2014-04-03</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 9</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060304140002</td>
                        <td>ABDUR ROHMAN AL-HAQI</td>
                        <td>2014-04-03</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060304160001</td>
                        <td>GIO BASKORO</td>
                        <td>2016-04-03</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 7</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060304190001</td>
                        <td>HAFIZ LUTHFI KHALIF MU'IN</td>
                        <td>2019-04-03</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060305090001</td>
                        <td>ZIDAN FALAH MAULANA</td>
                        <td>2009-05-03</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060305090002</td>
                        <td>RIDHO FADILAH</td>
                        <td>2009-05-03</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060305150001</td>
                        <td>MUHAMMAD HAMDAN FAUZI</td>
                        <td>2015-05-03</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060305170001</td>
                        <td>ALZAM FAIZ ARTANABIL</td>
                        <td>2017-05-03</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060305200001</td>
                        <td>EKO KURNIAWAN</td>
                        <td>2020-05-03</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060306080001</td>
                        <td>RIDO ALFIANTO</td>
                        <td>2008-06-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060306080002</td>
                        <td>DIKA PRATAMA</td>
                        <td>2008-06-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 10</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060306090001</td>
                        <td>ANDIKA PRASETIA JAYA</td>
                        <td>2009-06-03</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060306090002</td>
                        <td>TEGAR SAPUTRA</td>
                        <td>2009-06-03</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060306100002</td>
                        <td>MUHAMAD LATIF</td>
                        <td>2010-06-03</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060306120001</td>
                        <td>HADI FAHTUR RAHMAN</td>
                        <td>2012-06-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060306120002</td>
                        <td>M. FAHRI ANIZAR</td>
                        <td>2012-06-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060306120004</td>
                        <td>MUHAMAD ZAHIR</td>
                        <td>2012-06-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060306170001</td>
                        <td>MUHAD JAIZ</td>
                        <td>2017-06-03</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060306190001</td>
                        <td>MUHAMMAD HAFIZ RAMADHAN</td>
                        <td>2019-06-03</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060307060002</td>
                        <td>ADI SANTOSO</td>
                        <td>2008-07-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060307070002</td>
                        <td>BILLY YAMA CAHYA SAPUTRA</td>
                        <td>2007-07-03</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060307100002</td>
                        <td>LORENTINUS SATRIA SETIAWAN</td>
                        <td>2010-07-03</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060307120002</td>
                        <td>STEVEN JULIO</td>
                        <td>2012-07-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060307120003</td>
                        <td>ANJAS ALVAN AZMI</td>
                        <td>2012-07-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060307140002</td>
                        <td>LATIF AWAL RHAMDANU</td>
                        <td>2014-07-03</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 01</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060307150001</td>
                        <td>M. SURYA RAMADHANI</td>
                        <td>2015-07-03</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VII</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060307160001</td>
                        <td>MAULANA ANUGRAH RAMADHAN</td>
                        <td>2016-07-03</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN.3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060308090002</td>
                        <td>KHOIRUS SA'AT</td>
                        <td>2009-08-03</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060308110002</td>
                        <td>M. TOIF RAMADAN</td>
                        <td>2011-08-03</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060308170001</td>
                        <td>SAFREZA KARLEN AULIAN</td>
                        <td>2017-08-03</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060309070001</td>
                        <td>ANDRE DERMAWAN</td>
                        <td>2007-09-03</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060309080002</td>
                        <td>REZA RAMADHANI</td>
                        <td>2008-09-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 7</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060309090002</td>
                        <td>WAHID TEGAR RAMADANI</td>
                        <td>2009-09-03</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060309110002</td>
                        <td>TAUFIK HIDAYAT</td>
                        <td>2011-09-03</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060309150003</td>
                        <td>RIDHO NUR IKHSAN</td>
                        <td>2015-09-03</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 10</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060309180001</td>
                        <td>DYLAN AVISHA ADAM</td>
                        <td>2018-09-03</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060309190002</td>
                        <td>MIFTAHUDIN</td>
                        <td>2019-09-03</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060310070001</td>
                        <td>DANU SAPUTRA</td>
                        <td>2007-10-03</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060310070002</td>
                        <td>TEGAR RAHMADAN PRATAMA</td>
                        <td>2007-10-03</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 7</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060310080002</td>
                        <td>DANDI RIZKI MULYADI</td>
                        <td>2008-10-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060310080004</td>
                        <td>RAFFOLI QOWIY</td>
                        <td>2007-10-03</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060310110001</td>
                        <td>RENO RIZKI OKTAVIYAN</td>
                        <td>2011-10-03</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060310110002</td>
                        <td>VINCENSIUS REHAN</td>
                        <td>2011-10-03</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060310120001</td>
                        <td>RAFA LUTFI ADI</td>
                        <td>2012-10-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060310130001</td>
                        <td>AZHAR RIFAT ASSYUROTHY</td>
                        <td>2013-10-03</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060310140002</td>
                        <td>AHMAD FADLI FAUZAN</td>
                        <td>2014-10-03</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060310150001</td>
                        <td>DAFFA ARIF SHAPUTRA</td>
                        <td>2015-10-03</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V KARANG ANYAR</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060310160001</td>
                        <td>RIFQI FIRDAUS</td>
                        <td>2016-10-03</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060310170001</td>
                        <td>BAIHAQY MUFIDZ ZULFIKAR MANAN</td>
                        <td>2017-10-03</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060310180001</td>
                        <td>AL-KEYNAN YUDA SAPUTRA</td>
                        <td>2018-10-03</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060310180002</td>
                        <td>REYNANDA RIFKI ARIFIAN</td>
                        <td>2018-10-03</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060310190001</td>
                        <td>DAVIE KAVINDRA ALFAREZI</td>
                        <td>2019-10-03</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VII</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060311080001</td>
                        <td>IKHSAN MAULANA</td>
                        <td>2008-11-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060311080002</td>
                        <td>AHMAD FIRDAUS</td>
                        <td>2008-11-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060311080004</td>
                        <td>DIMAS ANGGARA</td>
                        <td>2008-11-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060311120001</td>
                        <td>NIZAM AL FARIQH YUNUS</td>
                        <td>2012-11-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060311120002</td>
                        <td>QOIS AL-QO'QO'</td>
                        <td>2012-11-03</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060311150002</td>
                        <td>FAUZAN AHNAF FATUROHMAN</td>
                        <td>2015-11-03</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>SEMULI RAYA</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060311150003</td>
                        <td>RADITIA SAPUTRA</td>
                        <td>2015-11-03</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060311170001</td>
                        <td>HAFID NOVA NURHUDA</td>
                        <td>2017-11-03</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060311170002</td>
                        <td>RIFQI ANDRIYAN PRATAMA</td>
                        <td>2017-11-03</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060312070001</td>
                        <td>FADLI FIRMANDANI</td>
                        <td>2007-12-03</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060312080002</td>
                        <td>ANDIKA AGENG PRATAMA</td>
                        <td>2008-12-03</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060312110001</td>
                        <td>MUHAMAD ZIDAN LATIF</td>
                        <td>2011-12-03</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060312140001</td>
                        <td>AZKA RANGGA PRATAMA</td>
                        <td>2014-12-03</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>NUNGGAL REJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060312150001</td>
                        <td>KHAFI EL AZZAM</td>
                        <td>2015-12-03</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>SIDO MULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060312190001</td>
                        <td>DESTA FADIL WIJAYA</td>
                        <td>2019-12-03</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060312190002</td>
                        <td>AL GHIFARI KENZI ARMANDA</td>
                        <td>2019-12-03</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060312200001</td>
                        <td>PRADITYA KENDRIK</td>
                        <td>2020-12-03</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060401080002</td>
                        <td>JERRY ADRIANSYAH</td>
                        <td>2008-01-04</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060401130001</td>
                        <td>MUHAMAD ZAKI NURHANSYAH</td>
                        <td>2013-01-04</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060401140001</td>
                        <td>JACKA ADI DWI SAPUTRA</td>
                        <td>2014-01-04</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060401180001</td>
                        <td>ARYA TEGUH</td>
                        <td>2018-01-04</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060401190001</td>
                        <td>SU'AEEB SAABI'I AS SYIDIK</td>
                        <td>2019-01-04</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060401190002</td>
                        <td>FEREL REVALDO</td>
                        <td>2019-01-04</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060401190003</td>
                        <td>HAMMAM ABDUL JABBAR</td>
                        <td>2019-01-04</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>SONO MULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060401210001</td>
                        <td>KAMILA ALMAHYRA RIZQ</td>
                        <td>2021-01-04</td>
                        <td>2</td>
                        <td>Perempuan</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060402070002</td>
                        <td>FERNANDA DAVA</td>
                        <td>2007-02-04</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060402070003</td>
                        <td>ANDRI</td>
                        <td>2007-02-04</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060402080002</td>
                        <td>RAFLI INDIE UTAMA</td>
                        <td>2008-02-04</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060402090001</td>
                        <td>MUHAMMAD ADEVAN</td>
                        <td>2009-02-04</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060402120001</td>
                        <td>FIRDAUS ZAQI ABIMANYU</td>
                        <td>2012-02-04</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>SRI SAWAHAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060402130001</td>
                        <td>KEYZA AYRELLIO RADHITYA</td>
                        <td>2013-02-04</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060402130002</td>
                        <td>QIYANU RAFA FEBRIANOZA</td>
                        <td>2013-02-04</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060402140001</td>
                        <td>REVAN MAHARDHIKA</td>
                        <td>2014-02-04</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060402150002</td>
                        <td>ATALAH PRATAMA</td>
                        <td>2015-02-04</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060402150003</td>
                        <td>MUHAMMAD YASA FEBYANTO</td>
                        <td>2015-02-04</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060402160003</td>
                        <td>MUHAMAD HAFIZ AKBAR</td>
                        <td>2016-02-04</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>TANGGUL ANGIN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060402180001</td>
                        <td>ABRIZAM FATHUL RIDHO</td>
                        <td>2018-02-04</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II TRITUNGGAL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060402200002</td>
                        <td>RADIKA AZRIEL ADHITAMA</td>
                        <td>2020-02-04</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060403070001</td>
                        <td>MAULANA ASROR</td>
                        <td>2007-03-04</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1II TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060403090001</td>
                        <td>ANGGA KURNIAWAN</td>
                        <td>2009-03-04</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060403150003</td>
                        <td>HARJUNA ARSHAVIN</td>
                        <td>2015-03-04</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060404080001</td>
                        <td>FARHAN DWI MAULANA</td>
                        <td>2008-04-04</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060404130001</td>
                        <td>LUCKY APRILLIO PRATAMA</td>
                        <td>2013-04-04</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060404130002</td>
                        <td>ILYAS KHAIRUL ANAM</td>
                        <td>2012-04-25</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SINDANGSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060404140001</td>
                        <td>MUHAMMAD FATHAN AL AUFAR</td>
                        <td>2014-04-04</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060404140005</td>
                        <td>IZAM KHOIRUL AKWAN</td>
                        <td>2014-04-04</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060404170001</td>
                        <td>RIDHO MUHAMMAD</td>
                        <td>2017-04-04</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060404200001</td>
                        <td>MUHAMMAD WALID NAUFAL</td>
                        <td>2020-04-04</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060405080004</td>
                        <td>RIFKA AFIFA MUSYAFA</td>
                        <td>2008-05-04</td>
                        <td>15</td>
                        <td>Perempuan</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060405110001</td>
                        <td>FAIZ KHOIRUL WILDAN</td>
                        <td>2011-05-04</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060405130002</td>
                        <td>CELVIN ALFERO PUTRA</td>
                        <td>2013-05-04</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060405140002</td>
                        <td>ARYA KURNIAWAN</td>
                        <td>2014-05-04</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060405140004</td>
                        <td>RAKA DEBIANO</td>
                        <td>2014-05-04</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060405180001</td>
                        <td>ARSAKHA RANZI ALDEN</td>
                        <td>2018-05-04</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060405200001</td>
                        <td>KHALID IRSYAD HANAFI</td>
                        <td>2020-05-04</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060406070001</td>
                        <td>NAUFAL AZIZ HIDAYAT</td>
                        <td>2007-06-04</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060406110001</td>
                        <td>FAJRI DWI PRASETYO</td>
                        <td>2011-06-04</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060406110002</td>
                        <td>SALMAN ALFARIZI</td>
                        <td>2011-05-04</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060406120001</td>
                        <td>MUHAMAD NAUFAL AKBAR</td>
                        <td>2012-06-04</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060406120002</td>
                        <td>ABID MAHFUZ TASAQIF</td>
                        <td>2012-06-04</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060406130002</td>
                        <td>BILAL SEPTIAN</td>
                        <td>2013-06-04</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060406150001</td>
                        <td>M. JAMIL AZKA SYAPUTRA</td>
                        <td>2015-06-04</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V KARANG ANYAR</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060406190001</td>
                        <td>RAKA DWI RAMADHAN</td>
                        <td>2019-06-04</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060406200001</td>
                        <td>FITNO MAHDI HIDAYAT</td>
                        <td>2020-06-04</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060407080001</td>
                        <td>M. USAMAH AQOSIM</td>
                        <td>2008-07-04</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060407100001</td>
                        <td>SULTAN FIRDAUS</td>
                        <td>2017-07-04</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060407120003</td>
                        <td>AHLIL ILMIL KHAIRIL</td>
                        <td>2012-07-04</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060407130001</td>
                        <td>MUHAMMAD FARREL ALVIANO</td>
                        <td>2013-07-04</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060407130002</td>
                        <td>SHANDY EZA PRATAMA</td>
                        <td>2013-07-04</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 10</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060407160001</td>
                        <td>ROSIKHUL 'AQLI AL KHOIR</td>
                        <td>2016-07-04</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060408070001</td>
                        <td>REVAN PRASSTIAWAN</td>
                        <td>2007-08-04</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060408080001</td>
                        <td>IDRIS AFANDI</td>
                        <td>2008-08-04</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060408090001</td>
                        <td>YOHANES WILLIAM DWI SAPUTRA</td>
                        <td>2009-08-04</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060408120002</td>
                        <td>SALMAN ABDURROZZAQ</td>
                        <td>2012-08-04</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060408150001</td>
                        <td>M. BIMA BAGUS RADITYA</td>
                        <td>2015-08-04</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060408150003</td>
                        <td>AHMAD ZULVA ZAWAWI MANAN</td>
                        <td>2015-08-04</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060408160001</td>
                        <td>ELFATHAN ABYAN NANDANA AHMAD</td>
                        <td>2016-08-04</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II TRITUNGGAL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060408190001</td>
                        <td>MUHAMMAD NAJAH AL ZUBAIR</td>
                        <td>2019-08-04</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 10</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060408200001</td>
                        <td>MUHAMMAD HAFIDZ BAGASKARA</td>
                        <td>2020-08-04</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060409110001</td>
                        <td>TISNA PUTRA ARDIANSYAH</td>
                        <td>2011-09-04</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060409120000</td>
                        <td>HAFINZA CHOIRUL</td>
                        <td>2012-09-04</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060409150002</td>
                        <td>ARSAKHA AZFAR</td>
                        <td>2015-09-04</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060409190001</td>
                        <td>ARSAKA PUTRA BIRAWA SETIAWAN</td>
                        <td>2019-09-04</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060410080002</td>
                        <td>ILMAN FIRDAUS</td>
                        <td>2008-10-04</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SINDANGSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060410160001</td>
                        <td>AHMAD FATHU SOBIRIN</td>
                        <td>2016-10-04</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060410170001</td>
                        <td>FEBIAN DAVI AL MAJID</td>
                        <td>2017-10-04</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060411070001</td>
                        <td>FAHMI HAKIKI</td>
                        <td>2007-11-04</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060411090001</td>
                        <td>ALIF PUTRA PRATAMA</td>
                        <td>2009-11-04</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060411100001</td>
                        <td>MUHAMAD ZACKY FATURROHMAN</td>
                        <td>2010-11-04</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060411110001</td>
                        <td>FEMAS ADLY SAPUTRA</td>
                        <td>2011-11-04</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060411110002</td>
                        <td>DAFA ARCAN PRATAMA</td>
                        <td>2011-11-04</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060411130001</td>
                        <td>ADITIYA NOVEN SETIAWAN</td>
                        <td>2013-11-04</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060411140001</td>
                        <td>MUHAMMAD FIKRI ZHAFRAN KHOIRY</td>
                        <td>2014-11-04</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060411150003</td>
                        <td>AZHAM ALDYANO AJI SENJAYA</td>
                        <td>2015-11-04</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060411170001</td>
                        <td>FILDAN NOVANTO</td>
                        <td>2017-11-04</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060412080001</td>
                        <td>M. ALI MUSDAVA</td>
                        <td>2008-12-04</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060412080002</td>
                        <td>M. ALI MUSDAVI</td>
                        <td>2008-12-04</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060412100003</td>
                        <td>REVA WIRATMOKO</td>
                        <td>2010-12-04</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060412100006</td>
                        <td>RIZKI PRATAMA</td>
                        <td>2010-12-04</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060412100007</td>
                        <td>SURYANTORO HARIS</td>
                        <td>2010-12-04</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060412110001</td>
                        <td>MUHAMAD AMAR DESTIA</td>
                        <td>2011-12-04</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060412120001</td>
                        <td>MUHAMMAD REVAN MAULANA</td>
                        <td>2012-12-04</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060412120002</td>
                        <td>RAFA DESTRIANO</td>
                        <td>2012-12-04</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060412170001</td>
                        <td>AKBAR ABI YUSUF</td>
                        <td>2017-12-04</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060412180001</td>
                        <td>ADAM RAMADANI</td>
                        <td>2018-12-04</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060412180002</td>
                        <td>M.FAUZAN FERDIYANSAH</td>
                        <td>2018-12-04</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060501070003</td>
                        <td>FERI ARDIANSYAH</td>
                        <td>2007-01-05</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060501070004</td>
                        <td>FATTAHUR RABBANI</td>
                        <td>2007-01-05</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060501100001</td>
                        <td>NATHAN RINO CHRISTIANO</td>
                        <td>2010-01-05</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060501120001</td>
                        <td>MUHAMMAD ILYAS AL HAFIZH</td>
                        <td>2012-01-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060501120002</td>
                        <td>ALDYNO ARFANSYAH</td>
                        <td>2012-01-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060501140001</td>
                        <td>MUHAMMAD QOMARI</td>
                        <td>2014-01-05</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060501200001</td>
                        <td>KIAN SYAIAN</td>
                        <td>2020-01-05</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060502100003</td>
                        <td>HUSEIN PAMUNGKAS</td>
                        <td>2010-02-05</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>JL. BELIDA</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060502120001</td>
                        <td>RAMA MAULANA ALFAZA</td>
                        <td>2012-02-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060502200001</td>
                        <td>IMAM FAHRUDIN</td>
                        <td>2020-02-05</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6 SIDO MULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060502900001</td>
                        <td>ZAKI ALFARIZA PRATAMA</td>
                        <td>2009-02-05</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060503080002</td>
                        <td>ZAKARIA SYAIFULAH</td>
                        <td>2008-03-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6 TIRTO BANGUN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060503120002</td>
                        <td>AHMAD IHSANUL ZAIM</td>
                        <td>2012-03-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060503120003</td>
                        <td>MUHAMAD RAIS FIRMANSAH</td>
                        <td>2012-03-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060503130001</td>
                        <td>DANNIEL SAPUTRA</td>
                        <td>2013-03-05</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060503170002</td>
                        <td>REVANDY ALVIAN</td>
                        <td>2017-03-05</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060503190001</td>
                        <td>FADHIL AKBAR</td>
                        <td>2019-03-05</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060503200001</td>
                        <td>ARRUN NAUKO</td>
                        <td>2020-03-05</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060504080001</td>
                        <td>ABDI SETIAWAN</td>
                        <td>2008-04-05</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060504130001</td>
                        <td>M. RASYA FA'IZASYAH</td>
                        <td>2013-04-05</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060504180002</td>
                        <td>ARKA RIFQI PRATAMA</td>
                        <td>2018-04-05</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060504200001</td>
                        <td>EL MALIK ATQAN PUTRA ARSYAVIE</td>
                        <td>2020-04-05</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060504200002</td>
                        <td>AZRIL ROHMAN</td>
                        <td>2020-04-05</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2 SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060504210001</td>
                        <td>MUHAMAD AL KAHFI</td>
                        <td>2021-04-05</td>
                        <td>2</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060505070001</td>
                        <td>ALDIANSYAH</td>
                        <td>2007-05-05</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060505110001</td>
                        <td>GIGIH PRASTYA NUGRAHA</td>
                        <td>2011-05-05</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060505120001</td>
                        <td>NAUFAL AZHAR</td>
                        <td>2012-05-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060505130001</td>
                        <td>RAHMAT APANDI</td>
                        <td>2013-05-05</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060505130002</td>
                        <td>MUHAMMAD AUFA NIZAR</td>
                        <td>2013-05-05</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN NEGERI ULANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060505150001</td>
                        <td>KEVIN TRI BASTIAN</td>
                        <td>2015-05-05</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060505150002</td>
                        <td>PUTRA SAMUDRA</td>
                        <td>2015-05-05</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060505150003</td>
                        <td>MEILANO RACHEL KURIAWAN</td>
                        <td>2015-05-05</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>SIDO MULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060505160001</td>
                        <td>MUHAMAD ARKA WIJAYA</td>
                        <td>2016-05-05</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060505170001</td>
                        <td>REKA ADITIYA</td>
                        <td>2017-05-05</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060506080002</td>
                        <td>LAURENSIUS BONAVENTURA</td>
                        <td>2008-06-05</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060506140001</td>
                        <td>PANDEKA ZULFAN WIJAYA</td>
                        <td>2014-06-05</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060506140002</td>
                        <td>ARGHA FATHIR AL-JUNIO</td>
                        <td>2014-06-05</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060506150001</td>
                        <td>ANGGA WICAKSONO</td>
                        <td>2015-06-05</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060506180002</td>
                        <td>RAMADHANI SULAIMAN</td>
                        <td>2018-06-05</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060507070002</td>
                        <td>DIVO YULIANTO</td>
                        <td>2007-07-05</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060507190001</td>
                        <td>FAJRI RAFISQY AQMAR</td>
                        <td>2019-07-05</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060508090001</td>
                        <td>AGUS WIJAYA</td>
                        <td>2009-08-05</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060508120001</td>
                        <td>DIMAS DAICHI RAMADHAN</td>
                        <td>2012-08-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060508130001</td>
                        <td>AHMAD VITO DARMAWAN</td>
                        <td>2013-08-05</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060508150002</td>
                        <td>M. AQIL MAHMUD</td>
                        <td>2015-08-16</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060508170002</td>
                        <td>ARFAN FAEYZA</td>
                        <td>2017-08-05</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060508190002</td>
                        <td>MUHAMAD BAKIR</td>
                        <td>2019-08-05</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>KAMPUNG DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060509080001</td>
                        <td>NOVAL RIZKY RAMADANI</td>
                        <td>2008-09-05</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060509080002</td>
                        <td>GILANG PRATAMA RAMADHANI</td>
                        <td>2008-09-05</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060509100001</td>
                        <td>M.DARMA NUSA KUSUMA YUDHA</td>
                        <td>2010-09-05</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060509110001</td>
                        <td>GALANG SETIAWAN</td>
                        <td>2011-09-05</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060509120001</td>
                        <td>MUHAMMAD NURUL ALFIN</td>
                        <td>2012-09-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060509170001</td>
                        <td>MUHAMMAD HUSNI MUBAROK</td>
                        <td>2017-09-05</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060509200001</td>
                        <td>MUHAMAD RISKY ALFATIH</td>
                        <td>2020-09-05</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060510080001</td>
                        <td>MUHAMMAD SIDIQ GHUFRON</td>
                        <td>2008-10-05</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>SRI MULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060510080004</td>
                        <td>ADI ARI YUSUP PRATAMA</td>
                        <td>2008-10-05</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060510090001</td>
                        <td>MUHLISIN</td>
                        <td>2009-10-05</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060510090004</td>
                        <td>FANDY AHMAD DARMAWAN</td>
                        <td>2009-10-05</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060510090005</td>
                        <td>TRI FAISAL ARROSYID</td>
                        <td>2009-10-05</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060510110002</td>
                        <td>NINO ADILLA PANGESTU</td>
                        <td>2011-10-05</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060510120003</td>
                        <td>JONATHAN FERRY</td>
                        <td>2012-10-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060510140001</td>
                        <td>ALFAZA ADHA ATAMMA</td>
                        <td>2014-10-05</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060510150001</td>
                        <td>AZZAHRA NUR ALVIANRA</td>
                        <td>2015-10-25</td>
                        <td>8</td>
                        <td>Perempuan</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060510180001</td>
                        <td>MUHAMMAD SYAROFUL UMAM</td>
                        <td>2018-10-05</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V MORODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060510200001</td>
                        <td>RAYYAN SANDIKA ALFARISQI</td>
                        <td>2020-10-05</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>NUNGGAL REJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060511080001</td>
                        <td>DAFA RAMADANI</td>
                        <td>2008-11-05</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060511100001</td>
                        <td>MOHAMAT FAUZI KURNAIN</td>
                        <td>2010-11-05</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060511110003</td>
                        <td>LUTFI NUR ROHIM</td>
                        <td>2011-11-05</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060511140001</td>
                        <td>AZKA DANENDRA</td>
                        <td>2014-11-05</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060511140002</td>
                        <td>RACHA VALENCIA</td>
                        <td>2014-11-05</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060512070001</td>
                        <td>DESTIA ERIS PURNOMO</td>
                        <td>2007-12-05</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060512090002</td>
                        <td>ILHAM ARSYAD SURURI</td>
                        <td>2009-12-05</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060512110001</td>
                        <td>ADLI ZAHWAN RAFIF</td>
                        <td>2011-12-05</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>TOTO KATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060512120004</td>
                        <td>ENDITO ERICK PRASETYO</td>
                        <td>2012-12-05</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060512140001</td>
                        <td>AFAN LATHIFURAHMAN</td>
                        <td>2014-12-05</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060512140002</td>
                        <td>RIZAL PUTRA MAHENDRA</td>
                        <td>2014-12-05</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060512160001</td>
                        <td>ADIB ZAINUL MUTAQIN</td>
                        <td>2016-12-05</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060512160002</td>
                        <td>MUHAMMAD ZAYN ALVARO</td>
                        <td>2016-12-05</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060512180001</td>
                        <td>M. ANWAR RIFA'I</td>
                        <td>2018-12-05</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4 SINDANGSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060550516001</td>
                        <td>NAESA ANJANIATHA. S</td>
                        <td>2016-05-15</td>
                        <td>7</td>
                        <td>Perempuan</td>
                        <td>DUSUN III PARAHYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060601080001</td>
                        <td>ALDO EKA KUSWARA</td>
                        <td>2008-01-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060601110003</td>
                        <td>DEVAN WAHYU SETIAWAN</td>
                        <td>2011-01-06</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060601130001</td>
                        <td>AHMAD TOMI KURNIAWAN</td>
                        <td>2013-01-06</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060601200001</td>
                        <td>ALBY ALGIFARI</td>
                        <td>2020-01-06</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060602080001</td>
                        <td>FERDI DANU PRAKOSO</td>
                        <td>2008-02-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060602080002</td>
                        <td>PUTRA PANCA PAMUNGKAS</td>
                        <td>2008-02-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>JL. TONGKOL NO 27 A</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060602090001</td>
                        <td>DAFA ARKANA BELFA</td>
                        <td>2009-02-06</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060602090002</td>
                        <td>TENDI DANANG PRATAMA</td>
                        <td>2009-02-06</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060602100003</td>
                        <td>INDRAK FEBRIANSYAH</td>
                        <td>2010-02-06</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V KARANG ANYAR</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060602130001</td>
                        <td>AHMAD FADHILLAH CAHYO PRATAMA</td>
                        <td>2013-02-06</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN DIGUL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060602130004</td>
                        <td>NABILA CAHYA ANSYARI</td>
                        <td>2013-02-26</td>
                        <td>10</td>
                        <td>Perempuan</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060603130002</td>
                        <td>RAIHAN SURYA ARKAN</td>
                        <td>2013-03-06</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060603160001</td>
                        <td>SER CAHYA</td>
                        <td>2016-03-06</td>
                        <td>7</td>
                        <td>Perempuan</td>
                        <td>ASTOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060603180001</td>
                        <td>MUHAMMAD ABRORI SHUL CHAN</td>
                        <td>2018-03-06</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060603200001</td>
                        <td>ANDIKA DIRGANTARA</td>
                        <td>2020-03-06</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060604070001</td>
                        <td>HILDAN MAULANA HAFID</td>
                        <td>2007-04-06</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>SONO MULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060604090001</td>
                        <td>NAWANG WULAN APRILIA</td>
                        <td>2009-04-02</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060604110001</td>
                        <td>RIFQI RASYA FADHILA</td>
                        <td>2011-04-06</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060604130001</td>
                        <td>GILBY APRILIANO CAHYA SAPUTRA</td>
                        <td>2013-04-06</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060604180001</td>
                        <td>ARGA DUWI HARIANTO</td>
                        <td>2018-04-06</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TULUNG ITIK I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060604200001</td>
                        <td>ZAYYAN SYAZANI</td>
                        <td>2020-04-06</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060605080003</td>
                        <td>TAUFIK ANDREA SAPUTR</td>
                        <td>2008-05-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060605110001</td>
                        <td>ALFIAN DWI DARMAWAN</td>
                        <td>2011-05-06</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060605140001</td>
                        <td>THOMI RAHMATULLOH</td>
                        <td>2014-05-16</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060605140002</td>
                        <td>AHMAD ZAENAL FANANI</td>
                        <td>2014-05-06</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060605150001</td>
                        <td>MUHAMMAD HENNUR ADINATA</td>
                        <td>2015-05-06</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060605160001</td>
                        <td>DZAKI FATHI MUKTHAR</td>
                        <td>2016-05-06</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060605160002</td>
                        <td>NIZAM RIZKY RAMADHAN</td>
                        <td>2016-06-06</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060605170001</td>
                        <td>REZKY ALKAUTSAR</td>
                        <td>2017-05-06</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060605180002</td>
                        <td>MOHAMAT ZEFRAN V</td>
                        <td>2015-04-09</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060605190001</td>
                        <td>AUFA NADHIF PRADIPTA</td>
                        <td>2019-05-06</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060605190002</td>
                        <td>MUHAMMAD DIRGANTARA</td>
                        <td>2019-05-06</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4 SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060606070001</td>
                        <td>YOSAFAT RADITYA</td>
                        <td>2007-06-06</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060606090003</td>
                        <td>KHOIRUL FARIS</td>
                        <td>2009-06-06</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060606130001</td>
                        <td>VINO ADITYA WIJAYA</td>
                        <td>2013-06-06</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>TANGGUL ANGIN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060606130002</td>
                        <td>MUHAMMAD HANIF ALFARIZI</td>
                        <td>2013-06-06</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060606160001</td>
                        <td>MUHIBBUL FADLY RAMADHAN</td>
                        <td>2016-06-06</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060607080001</td>
                        <td>M. ZIBRAN RISWANDI</td>
                        <td>2008-07-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060607084000</td>
                        <td>M.AZI TAQIUDIN</td>
                        <td>2008-07-07</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060607090001</td>
                        <td>KEVIN FENDI PRATAMA</td>
                        <td>2009-07-06</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 10</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060607100001</td>
                        <td>DHAVIN AIRLANGGA RIAWAN</td>
                        <td>2010-07-06</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060607110001</td>
                        <td>ALAM NUR ROHMAN</td>
                        <td>2011-07-06</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060607120003</td>
                        <td>ARKHANATA OLIVER SEKA</td>
                        <td>2012-07-06</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060608110001</td>
                        <td>STEFANUS SAMUEL BERLIAN PRASOJO</td>
                        <td>2011-08-06</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060608110002</td>
                        <td>MUHAMMAD RIZKI RAMADHAN</td>
                        <td>2011-08-06</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060608130002</td>
                        <td>ZAKI ABDUL AZIS</td>
                        <td>2013-08-06</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060608140002</td>
                        <td>MUHAMAD ABIZAR AL-GHIFARI</td>
                        <td>2014-08-06</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5 MORODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060608150001</td>
                        <td>DAVA TRISTAN MAULANA</td>
                        <td>2015-08-06</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060608170001</td>
                        <td>FHARUL PERDIYANSA</td>
                        <td>2017-08-06</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060608170003</td>
                        <td>AKMAL IBNU ARFA</td>
                        <td>2017-08-06</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060608170004</td>
                        <td>ABDURRAHIM AL AKROM</td>
                        <td>2017-08-06</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060608870002</td>
                        <td>VARHAN ABDI SAPUTRA</td>
                        <td>2007-06-06</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060609090001</td>
                        <td>WAHYU RAMADHANI</td>
                        <td>2008-09-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN.3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060609100002</td>
                        <td>REVANO NURREYHASYA</td>
                        <td>2010-09-06</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060609100003</td>
                        <td>AHMAD IHSAN MUBAROK</td>
                        <td>2010-09-06</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060609120001</td>
                        <td>KHOLIF ASROFI</td>
                        <td>2012-09-06</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060609130001</td>
                        <td>IDAM KHOLIQ ALFARIS</td>
                        <td>2013-09-06</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060609140001</td>
                        <td>ABILAL KEVIN SANJAYA</td>
                        <td>2014-09-06</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060609150001</td>
                        <td>AHMAD NAUFFAL</td>
                        <td>2015-09-06</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060609170001</td>
                        <td>MUHAMMAD ALVINO MUZAKKI</td>
                        <td>2017-09-06</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060610070001</td>
                        <td>FAREL RAMADIANSYAH</td>
                        <td>2007-10-06</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060610080001</td>
                        <td>RIDHO FIRNAN SAPUTRA</td>
                        <td>2008-10-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060610100001</td>
                        <td>IQBAL FAIZUL HAQ</td>
                        <td>2010-10-06</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060610110003</td>
                        <td>RIZKY TEGAR SAPUTRA</td>
                        <td>2011-10-06</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060610140001</td>
                        <td>HABIB ANWARRUDIN</td>
                        <td>2014-10-06</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060610150001</td>
                        <td>YURIKE OKTAVIA H.</td>
                        <td>2015-10-06</td>
                        <td>8</td>
                        <td>Perempuan</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060611070003</td>
                        <td>FADHIL ACHMAD FAHRUDIN</td>
                        <td>2007-10-06</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060611140001</td>
                        <td>MUHAMAD ALI IRSAL</td>
                        <td>2014-11-06</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060611150001</td>
                        <td>FAUZI AHNAF F</td>
                        <td>2016-11-03</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>SEMULI RAYA</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060612080003</td>
                        <td>UMAMUL NGAZIS</td>
                        <td>2008-12-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5 MORODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060612080004</td>
                        <td>AEREZZA ZUKHRUF AZ-ZA'ID</td>
                        <td>2008-12-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060612100001</td>
                        <td>ABDUL HALIM</td>
                        <td>2010-12-06</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060612130001</td>
                        <td>JENSEN SURYAN SYAH</td>
                        <td>2013-12-06</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060612170002</td>
                        <td>BARIQ AKMALUDIN</td>
                        <td>2017-12-06</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060612190001</td>
                        <td>SYAHRIECAL ZIO AZARQA</td>
                        <td>2019-12-06</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060701080001</td>
                        <td>FURKHON ARDIANSAH</td>
                        <td>2008-01-07</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060701120002</td>
                        <td>DHIKA ZAINUL HUDA</td>
                        <td>2012-01-07</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060701140001</td>
                        <td>BERNADUS MARTIN JHOVANGGA</td>
                        <td>2014-01-07</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060701140002</td>
                        <td>SEBASTIAN MARTIN JHOVANKA</td>
                        <td>2014-01-07</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060701170001</td>
                        <td>MUHAMAD ZAQI SETIAWAN</td>
                        <td>2017-01-07</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI TIRTOBANGUN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060701180001</td>
                        <td>JONATHAN GIANDRA</td>
                        <td>2018-01-07</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II NGESTI RAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060701210001</td>
                        <td>ELFATIH RIZKIANSYAH</td>
                        <td>2021-01-07</td>
                        <td>2</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060702070002</td>
                        <td>DIMAS PRASETYO</td>
                        <td>2007-02-07</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060702090001</td>
                        <td>M. NUR ALFANSYAH</td>
                        <td>2009-02-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060702100001</td>
                        <td>WISNU AULVI NAZIR AHMAD</td>
                        <td>2010-02-07</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060702120001</td>
                        <td>GUS MUHAMMAD ARSYAD</td>
                        <td>2012-02-07</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060703080003</td>
                        <td>MUZAQI ALFI HANAN</td>
                        <td>2008-03-07</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060703090001</td>
                        <td>MUHAMAD NOVAL NUGRAHA</td>
                        <td>2009-03-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060703090002</td>
                        <td>KELVIN ARITONANG</td>
                        <td>2009-03-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060703090003</td>
                        <td>RIZMA DANI KURNIAWAN</td>
                        <td>2009-03-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060703100003</td>
                        <td>BAGAS AGUNG WIBOWO</td>
                        <td>2010-03-07</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060703100004</td>
                        <td>ADILA ANANTA ISLAMI</td>
                        <td>2010-03-07</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060703120001</td>
                        <td>AHMAD MAULANA</td>
                        <td>2012-03-07</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060704080001</td>
                        <td>RIZAL EVENDI</td>
                        <td>2008-04-07</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>SRIMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060704090002</td>
                        <td>AKBAR ZIDANE TRI YANTO</td>
                        <td>2009-04-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060704140001</td>
                        <td>YUSUF MAULANA</td>
                        <td>2014-04-07</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060704160002</td>
                        <td>MUHAMMAD AZKA MUKHTAR HAKIM</td>
                        <td>2016-04-07</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060704330001</td>
                        <td>AGUS FATURAHMAN</td>
                        <td>2015-08-14</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060705070001</td>
                        <td>TEGAR SAPUTRA</td>
                        <td>2007-05-07</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060705080001</td>
                        <td>FIDELIS VITTO VIOLENT</td>
                        <td>2008-05-07</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2 NGESTIRAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060705080002</td>
                        <td>RIZKI ADY IRAWAN</td>
                        <td>2008-05-07</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060705120002</td>
                        <td>RIZKY RAHMAN ADITIYA</td>
                        <td>2012-05-07</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060706090002</td>
                        <td>RIDHO MAULANA YUSUF</td>
                        <td>2009-06-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060706090003</td>
                        <td>AHNAF NAUFAL ARIFIN</td>
                        <td>2009-06-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060706100001</td>
                        <td>WILDAN TOTIAN ARDIANSYAH</td>
                        <td>2010-06-07</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060706110002</td>
                        <td>RAFA AHMAD RIYAN WIBOWO</td>
                        <td>2011-06-07</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060706120001</td>
                        <td>MUHAMMAD MA'RUF</td>
                        <td>2012-06-07</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060706140001</td>
                        <td>MUHAMAD NABHAN MUZAKY</td>
                        <td>2014-06-07</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060706150002</td>
                        <td>FARID ATTALAH</td>
                        <td>2015-06-07</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060706150003</td>
                        <td>AHMAD ARFAN ASKIA</td>
                        <td>2015-06-07</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060706170001</td>
                        <td>ARSAKA VIRENDRA</td>
                        <td>2017-06-07</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060706180001</td>
                        <td>MUHAMMAD FAHRI AYUBI</td>
                        <td>2018-06-07</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060706180002</td>
                        <td>ALDIFARIS FERDIAN</td>
                        <td>2018-06-07</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060707070002</td>
                        <td>MAULANA SAPUTRA</td>
                        <td>2007-07-07</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060707100001</td>
                        <td>CHORNELLIUS RANDI SANBIMA</td>
                        <td>2010-01-07</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060707100003</td>
                        <td>M. RAIHAN FADHILAH</td>
                        <td>2010-07-07</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060707120001</td>
                        <td>FEDERIK JULIAN S</td>
                        <td>2012-07-07</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II NGESTIRAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060707140001</td>
                        <td>HAFIS TAUFIK HIDAYAT</td>
                        <td>2014-07-07</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060707150001</td>
                        <td>ALIEFFIANSYAH ARSYAD RAMADHAN</td>
                        <td>2015-07-07</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060707150002</td>
                        <td>FAHRI RAHMADAN</td>
                        <td>2015-07-07</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI TIRTO BANGUN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060707160001</td>
                        <td>RAFIF ALFARIZI</td>
                        <td>2016-07-07</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060707160002</td>
                        <td>HILAL ABIYU EL AZZAM</td>
                        <td>2016-07-07</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060707170001</td>
                        <td>NIHAD AHMAD SHEFI</td>
                        <td>2017-07-07</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060708080001</td>
                        <td>AHMAD KHOLIL</td>
                        <td>2008-08-07</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X RAWA INDAH</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060708090003</td>
                        <td>MUHAMMAD FADHIIL AKBAR</td>
                        <td>2009-08-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060708110001</td>
                        <td>VANO RAMADHAN WIJAYA</td>
                        <td>2011-08-07</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060708110003</td>
                        <td>RAFEL ARDIANSYAH</td>
                        <td>2011-08-07</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060708150001</td>
                        <td>ADI TRIANTO</td>
                        <td>2015-08-07</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060708180001</td>
                        <td>ARNATHAN RIFQI PERMANA</td>
                        <td>2018-08-07</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060709090001</td>
                        <td>WAHYU AHMAD RAMADHAN</td>
                        <td>2009-09-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060709090002</td>
                        <td>BAYU AHMAD RAMADHAN</td>
                        <td>2009-09-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060709110001</td>
                        <td>GALANG SETIAWAN</td>
                        <td>2011-09-07</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060709200001</td>
                        <td>MUHAMMAD RAKA ALFATHAN</td>
                        <td>2020-09-07</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060710070002</td>
                        <td>FIQRI HANAN HARDIAN</td>
                        <td>2007-10-07</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060710080001</td>
                        <td>ARMA RIFA`I OKTAVIAN</td>
                        <td>2008-10-07</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060710090001</td>
                        <td>ROYHAN FA'IZ KURNIAWAN</td>
                        <td>2009-07-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 10</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060710090002</td>
                        <td>ANGGA PRATAMA</td>
                        <td>2009-10-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060710130001</td>
                        <td>FARHAN ZIDNA FAQIH</td>
                        <td>2013-10-07</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060710150001</td>
                        <td>MUHAMMAD IQBAL MARZUKI</td>
                        <td>2015-10-07</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060710160001</td>
                        <td>MUHAMMAD KARISMA AKBAR</td>
                        <td>2016-10-07</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060710190001</td>
                        <td>AKSA ARDHANA ABI P</td>
                        <td>2019-10-07</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060711070001</td>
                        <td>ANANDA PRATAMA</td>
                        <td>2007-11-07</td>
                        <td>16</td>
                        <td>Perempuan</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060711080001</td>
                        <td>M.SYARIF NURKHOLIK</td>
                        <td>2008-11-07</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060711110002</td>
                        <td>RASYID NOVRI PRAYOGA</td>
                        <td>2011-11-07</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060711130002</td>
                        <td>MUHAMMAD ALI MUZAKI</td>
                        <td>2013-11-07</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060711140001</td>
                        <td>DZAKIR KHAFADI</td>
                        <td>2014-11-07</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060711150002</td>
                        <td>DAVIN CHANDRA RIFAI</td>
                        <td>2015-11-07</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060711160002</td>
                        <td>BINTANG CAHYA NUGROHO</td>
                        <td>2016-11-07</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060711180001</td>
                        <td>SHAKIRA ALFIA DEVANI</td>
                        <td>2018-11-17</td>
                        <td>5</td>
                        <td>Perempuan</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060712090001</td>
                        <td>GALLIH MARTIANTO</td>
                        <td>2009-12-07</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060712100001</td>
                        <td>WAHYU GILANG DESWANTORO</td>
                        <td>2010-12-07</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUDUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060712200001</td>
                        <td>DESTRA FAQIH ADRIAN</td>
                        <td>2020-12-07</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUDUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060785484249</td>
                        <td>ANISA PURNOMO</td>
                        <td>2021-01-12</td>
                        <td>2</td>
                        <td>Perempuan</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060801100001</td>
                        <td>M. RAFA AL HARIDZI</td>
                        <td>2010-01-06</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060801120004</td>
                        <td>MUHAMMAD ALDIAN ALAMSYAH</td>
                        <td>2012-01-08</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060801130001</td>
                        <td>MUHAMAD LABIB AZKAL WAFA</td>
                        <td>2013-01-08</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060801130003</td>
                        <td>WILDAN NAJIB MUBAROK</td>
                        <td>2013-01-08</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 10</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060801140001</td>
                        <td>DENUAR ATHA WIJAYA</td>
                        <td>2014-01-08</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060801160001</td>
                        <td>AJUNA MAULANA HAMZAH</td>
                        <td>2016-01-08</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4 SINDANGSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060801170001</td>
                        <td>JOVAN FATHAN ALMUQNI</td>
                        <td>2017-01-08</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060801170003</td>
                        <td>MUHAMAD REFAN AL-ZAHIR</td>
                        <td>2017-01-08</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5 MORODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060801190001</td>
                        <td>FAEZA DEVAN DIYAKSA</td>
                        <td>2019-01-09</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060801200001</td>
                        <td>MICHAEL ELVANO CRISTIAN</td>
                        <td>2020-01-08</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060802070001</td>
                        <td>FERNANDO</td>
                        <td>2007-02-08</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II TRI TUNGGAL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060802150001</td>
                        <td>MUHAMAD DZAKWAN AL-FATIH</td>
                        <td>2015-02-08</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060802160001</td>
                        <td>HAFIZZUDIN ISLAMI</td>
                        <td>2016-02-08</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060802170002</td>
                        <td>AZZAM KHALIF PUTRA FEBRIAN</td>
                        <td>2017-02-08</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060802210004</td>
                        <td>REZA MAULANA</td>
                        <td>2021-02-08</td>
                        <td>2</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060803090001</td>
                        <td>PUTRI KINANTI</td>
                        <td>2009-03-08</td>
                        <td>14</td>
                        <td>Perempuan</td>
                        <td>DUSUN VIII</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060803100001</td>
                        <td>MUHAMAD SIFA ATSANY</td>
                        <td>2010-03-08</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060803100004</td>
                        <td>ARIS MUNANDAR</td>
                        <td>2010-03-08</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060803100005</td>
                        <td>MOHAMMAD FHADIL WARDHANA</td>
                        <td>2010-03-08</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060803110001</td>
                        <td>AKHDAN NIZAR ZAIN</td>
                        <td>2011-03-08</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060803160001</td>
                        <td>AHMAD FADLI</td>
                        <td>2016-03-08</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060803180001</td>
                        <td>MUHAMAD SAMANI KHOIRUL ANAM</td>
                        <td>2018-03-08</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2 SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060804090002</td>
                        <td>MUHAMMAD BAHRUL FATHONI</td>
                        <td>2009-04-08</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060804100003</td>
                        <td>CAHYA ADI PRATAMA</td>
                        <td>2010-04-08</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060804110001</td>
                        <td>LAKSAMANA WICAKSONO</td>
                        <td>2012-04-08</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060804120001</td>
                        <td>DAFFA NUR ROHMAN</td>
                        <td>2012-04-08</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060804160001</td>
                        <td>KAESANG MIFTA ALFALAH</td>
                        <td>2016-04-08</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060804190001</td>
                        <td>YUDHA ADITTHIYA</td>
                        <td>2019-04-08</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 06</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060805070001</td>
                        <td>REZA NURFAJRI</td>
                        <td>2007-05-08</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060805080001</td>
                        <td>ARIF NUR SOFIYAN</td>
                        <td>2008-05-06</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060805090001</td>
                        <td>GALIH AN HARI</td>
                        <td>2009-05-08</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060805090002</td>
                        <td>RIVA MAULANA</td>
                        <td>2009-05-08</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060805100001</td>
                        <td>AHMAD KHUSNI BADRUS ZAMAN</td>
                        <td>2010-05-08</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060805110001</td>
                        <td>FIRMAN CAHYA SAPUTRA</td>
                        <td>2011-05-08</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060805150001</td>
                        <td>RAHES MAULANA AKBAR</td>
                        <td>2015-05-08</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060805180001</td>
                        <td>ABHAR DZAKA ARIENDRA</td>
                        <td>2018-05-08</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060805190001</td>
                        <td>ILMAN QURAYS SHYHAB</td>
                        <td>2019-05-08</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060806100002</td>
                        <td>RIZKY SAPUTRA</td>
                        <td>2010-06-08</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060806110002</td>
                        <td>MUKHSIN HAMAMI</td>
                        <td>2011-06-08</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060806120001</td>
                        <td>MUHAMMAD KANZAL AUFA</td>
                        <td>2012-06-08</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 05</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060806130001</td>
                        <td>MUHAMMAD RAFA ZAINUL ABIDIN</td>
                        <td>2013-06-08</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060806130002</td>
                        <td>MUHAMMAD RAFI ZAINUL ABIDIN</td>
                        <td>2013-06-08</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060806140001</td>
                        <td>JORDAN ELEGAN</td>
                        <td>2014-06-08</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060806160001</td>
                        <td>ARKA BILAL RAMADHAN</td>
                        <td>2016-06-08</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060806160002</td>
                        <td>WILDAN FASIHU FIKRI</td>
                        <td>2016-06-07</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V MORODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060806180001</td>
                        <td>M. RIEZKY RAMADHAN</td>
                        <td>2018-06-08</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060806180002</td>
                        <td>WILLIAM ALBERT ADRIAN</td>
                        <td>2018-06-08</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060806190001</td>
                        <td>MUHAMAD RIZAL SAPUTRA</td>
                        <td>2019-06-08</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060806200001</td>
                        <td>RAFFA FAUZAN KAMIL</td>
                        <td>2020-06-08</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060806200002</td>
                        <td>ROZAN MUHAMMAD IHSAN</td>
                        <td>2020-06-08</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 10</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060807080002</td>
                        <td>ACHMAD FADLI AZIZ ZAMZAMI</td>
                        <td>2008-07-08</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060807090001</td>
                        <td>ERIC PERMADI SAPUTRA</td>
                        <td>2009-07-08</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060807110001</td>
                        <td>DIMAS CANDRA WINATA</td>
                        <td>2011-07-08</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060807110002</td>
                        <td>SATRIA ABDUL LATIF</td>
                        <td>2011-07-08</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060807130001</td>
                        <td>AGAM ABDILAH PRATAMA</td>
                        <td>2013-07-08</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>SRI SAWAHAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060808070003</td>
                        <td>RENDI</td>
                        <td>2007-08-08</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060808090001</td>
                        <td>ANDIKA SAPUTRA</td>
                        <td>2009-08-08</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060808100001</td>
                        <td>RASYAD FAKRUZA MANNUR</td>
                        <td>2010-08-08</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060808110002</td>
                        <td>DIKA RAMDANI</td>
                        <td>2011-08-08</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060808120001</td>
                        <td>ALKALIFI RAMADHAN PRADANA</td>
                        <td>2012-08-08</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060808120002</td>
                        <td>FRENZA ABI RAMADHAN</td>
                        <td>2012-08-06</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060808160001</td>
                        <td>MUHAMAD NASIR MUIN</td>
                        <td>2016-08-08</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060808170002</td>
                        <td>DHANIZ AHMAD FAISAL</td>
                        <td>2017-06-08</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060809080001</td>
                        <td>DIMAS ADI SAPUTRA</td>
                        <td>2008-09-08</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MOLYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060809100002</td>
                        <td>ARNAN ARDIASYAH</td>
                        <td>2010-09-08</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060809120001</td>
                        <td>DIKA ANANTA</td>
                        <td>2012-09-08</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060809130001</td>
                        <td>NU'MAN SHADIQ</td>
                        <td>2013-09-08</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II PARAHYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060809150001</td>
                        <td>HAFIZ AKMAL ALGHIFARI</td>
                        <td>2015-09-08</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060809200001</td>
                        <td>MUHAMMAD YUSUF ALFARIZQI</td>
                        <td>2020-09-08</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060809200002</td>
                        <td>MUHAMAD GALVIN PRATAMA</td>
                        <td>2020-09-08</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060810090001</td>
                        <td>BAYU AL RASYID</td>
                        <td>2009-10-08</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060810150001</td>
                        <td>AMMAR NAJIB IRKHAMUDIN</td>
                        <td>2015-10-08</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060810150003</td>
                        <td>ASFA AWRA AB'ROR</td>
                        <td>2015-10-08</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060810170001</td>
                        <td>MUHAMAD RANGGA AL BUCHORI</td>
                        <td>2017-10-08</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4 SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060810190001</td>
                        <td>DULAH KUSNAN</td>
                        <td>2019-10-08</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060811070001</td>
                        <td>FIKRI AZIZ ROSYADI</td>
                        <td>2007-11-08</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060811090002</td>
                        <td>M. DAVI HABIBI</td>
                        <td>2009-11-08</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060811110001</td>
                        <td>REZA ALVIANSYAH</td>
                        <td>2011-11-08</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060811120001</td>
                        <td>MUHAMMAD DEFA SYAIFULOH</td>
                        <td>2012-11-08</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060811130001</td>
                        <td>AL MIZZI</td>
                        <td>2013-11-08</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060811150001</td>
                        <td>M. RIZQI MUSYAFA</td>
                        <td>2015-11-08</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060811180001</td>
                        <td>ARVINO DAREL ANDANA</td>
                        <td>2018-11-08</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060811180002</td>
                        <td>MUHAMMAD ATHAR YUDHISTIRA</td>
                        <td>2018-11-08</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060811180004</td>
                        <td>ARKANA ATTALAH SAPUTRA</td>
                        <td>2018-11-08</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060811180005</td>
                        <td>MUHAMMAD ABIANSYAH</td>
                        <td>2018-01-06</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060812070002</td>
                        <td>ADVENTINO STIVEN NICHOLAS</td>
                        <td>2007-12-08</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060812090001</td>
                        <td>RIZAL HILMI AZMI</td>
                        <td>2009-12-08</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060812100001</td>
                        <td>SAUZI KAHAIRAN ROHIM</td>
                        <td>2010-12-08</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060812110001</td>
                        <td>YUDA RIZKY ANSORI</td>
                        <td>2011-12-08</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1 MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060812170001</td>
                        <td>MUHAMMAD RIJAL FADHILAH</td>
                        <td>2017-12-08</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IX</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060812190001</td>
                        <td>DIRGA RAFIQ AL MAJID</td>
                        <td>2019-12-08</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060901110001</td>
                        <td>YOGA PRATAMA</td>
                        <td>2011-01-09</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060901120003</td>
                        <td>RIKO PUTRA MAULANA</td>
                        <td>2012-01-09</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060901140001</td>
                        <td>VICKY AVANDY</td>
                        <td>2014-01-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060901140002</td>
                        <td>ASYAUL ARIZKI</td>
                        <td>2014-01-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060901160002</td>
                        <td>ILHAM SYAH REZA</td>
                        <td>2016-01-09</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060901180001</td>
                        <td>KEVIN ANGGARA</td>
                        <td>2018-01-09</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V KARANG ANYAR</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060902080001</td>
                        <td>HERONIMUS RENO</td>
                        <td>2008-02-09</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060902090001</td>
                        <td>ANDRIANSYAH</td>
                        <td>2009-02-09</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060902100002</td>
                        <td>VARIS BAYU SAPUTRA</td>
                        <td>2010-02-09</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060902120001</td>
                        <td>BOY DAREL MARIFAT</td>
                        <td>2012-02-09</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060902140001</td>
                        <td>AHMAD KASYFU NNAJA</td>
                        <td>2014-02-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 7</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060902150002</td>
                        <td>FEBRIANO DWI NURFADHILAH</td>
                        <td>2015-02-09</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060902160002</td>
                        <td>RADITYA FAUZAN NUGRAHA</td>
                        <td>2016-02-09</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060903070001</td>
                        <td>RIO PRASANDI</td>
                        <td>2007-03-09</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060903090001</td>
                        <td>RADITYA</td>
                        <td>2009-03-09</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060903090002</td>
                        <td>ARDITYA PUTRA PRATAMA</td>
                        <td>2009-02-28</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060903100001</td>
                        <td>ARDIAN AGIL SANJAYA</td>
                        <td>2010-03-09</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060903140001</td>
                        <td>AHNAF MAHFUDZAMAN AR-RASYID</td>
                        <td>2014-03-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V MORODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060903150001</td>
                        <td>RAZAN FAKHRUDDIN FASHIH</td>
                        <td>2015-03-09</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060903150002</td>
                        <td>GHINA SHAFWATUL I.</td>
                        <td>2015-03-09</td>
                        <td>8</td>
                        <td>Perempuan</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060903180001</td>
                        <td>TITO DESMAWAN</td>
                        <td>2018-03-09</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VII</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060904040004</td>
                        <td>DEVANO MAULANA HERMAWAN</td>
                        <td>2014-05-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060904070001</td>
                        <td>REFANDI HUSNAN ILYASA</td>
                        <td>2007-04-09</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060904090001</td>
                        <td>BAGAS RICKI PRATAMA</td>
                        <td>2009-04-09</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060904100004</td>
                        <td>AKMAL FAHRUL ZAIN</td>
                        <td>2010-04-09</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060904100005</td>
                        <td>AHMAD DANIL</td>
                        <td>2010-04-09</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060904170001</td>
                        <td>ILHAM AFIF SAYFUDIN</td>
                        <td>2017-04-09</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VII</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060904180001</td>
                        <td>M. YAZID AL-BAIDLOWI</td>
                        <td>2018-04-09</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060904190001</td>
                        <td>KALANDRA QIYAS ADITAMA</td>
                        <td>2019-04-09</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060904200001</td>
                        <td>AMADEUS GALEN CHRISTOPER</td>
                        <td>2020-04-09</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060904200002</td>
                        <td>MUHAMMAD AKBAR SAPUTRA</td>
                        <td>2020-04-09</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4 SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060905070001</td>
                        <td>M. FAUZI RASYA</td>
                        <td>2007-05-09</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060905070002</td>
                        <td>M.AZAM ALFAKIH</td>
                        <td>2007-05-09</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060905080002</td>
                        <td>GILANG PRASTIO</td>
                        <td>2008-05-09</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060905120001</td>
                        <td>PRENDA ADITYA</td>
                        <td>2012-05-09</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060905130001</td>
                        <td>AHMAD HAFID ATHOLLAH</td>
                        <td>2013-05-09</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060905140004</td>
                        <td>MUHAMMAD AKMAL ALFARIZIE</td>
                        <td>2014-05-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060905160001</td>
                        <td>ALBI LUTFI FAHRI</td>
                        <td>2016-05-09</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>NUNGGAL REJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060906090001</td>
                        <td>SANDIKA JUNIARTA</td>
                        <td>2009-06-09</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060906090002</td>
                        <td>EVAN JUNIANTO</td>
                        <td>2009-06-09</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060906120001</td>
                        <td>REYFAN FABIAN SAPUTRA</td>
                        <td>2012-06-09</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>JL.KACA PIRING</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060906150002</td>
                        <td>URWAH IBADURRAHMAN AL IHSANI</td>
                        <td>2015-06-09</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060907080002</td>
                        <td>AFIF AL HAJAR</td>
                        <td>2008-07-09</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060907090001</td>
                        <td>TRIO PUTRA FADILAH</td>
                        <td>2009-07-09</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060907120001</td>
                        <td>M. NIZAM ALFARIZ</td>
                        <td>2012-07-09</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060907140001</td>
                        <td>ALFIAN RIZKY RAMADAN</td>
                        <td>2014-07-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060907140002</td>
                        <td>ATHAR RAFIT RAMADANI</td>
                        <td>2014-07-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060907170002</td>
                        <td>AL FINO DWI PRADITIA</td>
                        <td>2017-07-09</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060907190001</td>
                        <td>ZAIN DWI AZHAR</td>
                        <td>2019-07-09</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060908080001</td>
                        <td>BAGUS LUKMAN HARYANTO</td>
                        <td>2008-08-09</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 7</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060908090001</td>
                        <td>ADLY FAIRUZ</td>
                        <td>2009-08-09</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VII</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060908120002</td>
                        <td>AKSA DINATA</td>
                        <td>2012-08-09</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN DIGUL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060908140001</td>
                        <td>AGUS SETIAWAN</td>
                        <td>2014-08-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060908160002</td>
                        <td>ARDAM PUTRA HEFAN</td>
                        <td>2016-08-09</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060908180001</td>
                        <td>HANIF AZKA RAFFASYA</td>
                        <td>2018-08-09</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060908190001</td>
                        <td>MUHAMMAD ARYADILAH SULAIMAN ALFARIKHZI</td>
                        <td>2019-08-09</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060908190002</td>
                        <td>AHMAD FATKHUR ROSYID</td>
                        <td>2019-08-09</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060908200001</td>
                        <td>DEVANO RIFQI RAHARDIAN</td>
                        <td>2020-08-09</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060909080001</td>
                        <td>WAHYU RAMA DONI</td>
                        <td>2008-09-09</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060909080002</td>
                        <td>M. ANDI PAMUNGKAS</td>
                        <td>2008-09-09</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060909080003</td>
                        <td>ARGA FIRMANSYAH</td>
                        <td>2008-09-09</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060909090001</td>
                        <td>ANDIKA DWI RAMADHAN</td>
                        <td>2009-09-09</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060909130001</td>
                        <td>IRSYAD DIEGO PURSIMAYTU</td>
                        <td>2013-09-09</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060909140001</td>
                        <td>ARJUN PUTRA BRILLIAN</td>
                        <td>2014-09-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060909140002</td>
                        <td>MUHAMAD KHOIRUL AZAM</td>
                        <td>2014-09-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060909140003</td>
                        <td>AHMAD NGIZAM HABIBI</td>
                        <td>2014-09-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060909170001</td>
                        <td>SANIQ EL FATIN</td>
                        <td>2017-09-09</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060910070001</td>
                        <td>IHSAN SOFIE AMRULLAH</td>
                        <td>2007-09-10</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN DIGUL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060910080001</td>
                        <td>ZAKI EFDIANSYAH</td>
                        <td>2008-10-09</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060910110001</td>
                        <td>M. JAUHARIL MAKNUN</td>
                        <td>2011-10-09</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060910110002</td>
                        <td>RAFI KHOIRUL MUSTOFA</td>
                        <td>2011-10-09</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060910110004</td>
                        <td>RAMA DANI</td>
                        <td>2011-10-09</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060910160001</td>
                        <td>HILMI YAQDAN ABDULLAH</td>
                        <td>2016-10-09</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V KARANG ANYAR</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060910160003</td>
                        <td>NAZRIL BRYAN AMRULLOH</td>
                        <td>2016-10-09</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060910200002</td>
                        <td>NIZAM IMANSYAH</td>
                        <td>2020-10-09</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060911110001</td>
                        <td>NGABDULLAH AL HAFIDH</td>
                        <td>2011-11-09</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060911110003</td>
                        <td>CANDRA FIRMANSYAH</td>
                        <td>2011-11-09</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060911120001</td>
                        <td>ADRIEL BOHDAN CRISTIANUS</td>
                        <td>2012-11-09</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060911140001</td>
                        <td>SAKTI AKBAR RISKI</td>
                        <td>2014-11-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060911180001</td>
                        <td>RAFIQ WAVI AL-FARIZ</td>
                        <td>2018-11-09</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II TRITUNGGAL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060911200001</td>
                        <td>MUHAMMAD RAFIF ASSYA</td>
                        <td>2020-11-09</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 10</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802060912070001</td>
                        <td>AHMAD FAJRI EFENDI</td>
                        <td>2007-12-09</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN MULYOKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060912110002</td>
                        <td>PUTRA PRATAMA</td>
                        <td>2011-12-09</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802060912140002</td>
                        <td>ANWARUDIN AHMAD</td>
                        <td>2014-12-09</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060912160001</td>
                        <td>ABDULLOH QINAN</td>
                        <td>2016-12-09</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IX</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802060912170001</td>
                        <td>DAFIAN DESWANTARA</td>
                        <td>2017-12-09</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I ASTOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061001090003</td>
                        <td>TIAN BAKHTIAR</td>
                        <td>2009-01-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061001100001</td>
                        <td>QOTADAH</td>
                        <td>2010-01-10</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3 PARAHYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061001110001</td>
                        <td>ARYA DANDI PUTRA PRATAMA</td>
                        <td>2011-01-10</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 07</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061001120001</td>
                        <td>KANZA PRATAMA RIZWANTO</td>
                        <td>2012-01-10</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061001120002</td>
                        <td>AHMAD ZAINURI</td>
                        <td>2012-01-10</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5 KARANG ANYAR</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061001210001</td>
                        <td>AFZA ATHARRAYHAN</td>
                        <td>2021-01-10</td>
                        <td>2</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061002070002</td>
                        <td>M. ABDUL ROHMAN</td>
                        <td>2007-02-10</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061002080001</td>
                        <td>PAHRI DWI ANDIKA</td>
                        <td>2008-02-10</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061002090002</td>
                        <td>DWI FERDIANSYAH</td>
                        <td>2009-02-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN.3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061002140001</td>
                        <td>RIZAL ARYA WIGUNA</td>
                        <td>2014-02-10</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061003070001</td>
                        <td>MIFTAHUL KAFI</td>
                        <td>2007-03-10</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 7</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061003070002</td>
                        <td>ELVAN DIAN SAPUTRA</td>
                        <td>2007-03-10</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061003090001</td>
                        <td>MARSEL ASMARA</td>
                        <td>2009-03-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061003110001</td>
                        <td>MARCHEL DHARMA PUTRA</td>
                        <td>2011-03-10</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061003150001</td>
                        <td>ALIF AHMADI PRAYOGA</td>
                        <td>2015-03-10</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061003160002</td>
                        <td>ANGELLO EDZHAR NARAYANA</td>
                        <td>2016-03-10</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061003170001</td>
                        <td>ROFI'ATUL AZIZAH</td>
                        <td>2017-03-10</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1 NGESTIRAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061003170003</td>
                        <td>KRESNA SYAMS XAVIER</td>
                        <td>2017-03-10</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061003200001</td>
                        <td>ALVARENDRA SURYA MAULANA</td>
                        <td>2020-03-10</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061004070003</td>
                        <td>RASYA KURNIAWAN</td>
                        <td>2007-04-10</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4 SINDANGSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061004090002</td>
                        <td>KINAN ABDILLAH RAZAN</td>
                        <td>2009-04-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061004100001</td>
                        <td>ALFIANO SETIA PUTRA</td>
                        <td>2010-04-10</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 06</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061004100002</td>
                        <td>ALFIANSAH SETIA PUTRA</td>
                        <td>2010-04-10</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 06</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061005070002</td>
                        <td>RIZKI KURNIAWAN</td>
                        <td>2007-05-10</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN SUKAJADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061005080001</td>
                        <td>RIVALDI JUNIANDA</td>
                        <td>2008-06-10</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>GANJAR AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061005160001</td>
                        <td>SABQI FATIH AHMAD</td>
                        <td>2016-05-10</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2 SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061005180001</td>
                        <td>ALFIANO PRAYOGA</td>
                        <td>2018-05-10</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TRIKATON</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061005180002</td>
                        <td>MUHAMMAD AZRIL SAFARI</td>
                        <td>2018-05-10</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061006120001</td>
                        <td>JAYA</td>
                        <td>2012-06-10</td>
                        <td>11</td>
                        <td>Perempuan</td>
                        <td>DUSUN IRIAN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061006130002</td>
                        <td>FAHRID TRI SETIAWAN</td>
                        <td>2013-06-10</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061006140002</td>
                        <td>ARKA RADITYA PRADIPTA</td>
                        <td>2014-06-10</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061006200001</td>
                        <td>ELVINO ALFARIZQY</td>
                        <td>2020-06-10</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061006200002</td>
                        <td>FATHAN ARZIKY</td>
                        <td>2020-06-10</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061007070001</td>
                        <td>MUHAMAT RIKI MUJAKI</td>
                        <td>2007-07-10</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061007090003</td>
                        <td>MUHAMAD ANDIKA SAPUTRA</td>
                        <td>2009-07-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061007090005</td>
                        <td>STENDI RICARD ATHANREA</td>
                        <td>2009-07-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061007110001</td>
                        <td>ZAKY ALFARISKY</td>
                        <td>2011-07-10</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061007150001</td>
                        <td>M. JULIANSYAH FIRDAUS</td>
                        <td>2015-07-10</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061007170001</td>
                        <td>ARYA DWI SAPUTRA</td>
                        <td>2017-07-10</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061007190001</td>
                        <td>KEVIN KURNIAWAN</td>
                        <td>2019-07-10</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061008090002</td>
                        <td>RANDI SAPUTRA</td>
                        <td>2009-08-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SINDANGSARI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061008100001</td>
                        <td>WEYNE GHANY DANDES</td>
                        <td>2010-08-10</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I.. SIDOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061008110004</td>
                        <td>MUJAKY EGA RAMADHAN</td>
                        <td>2011-08-10</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 2 SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061008110005</td>
                        <td>DEVA DWI SAPUTRA</td>
                        <td>2011-08-10</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061008120001</td>
                        <td>KAHLIL GIBRAN TRAVIS FERNANDA</td>
                        <td>2012-08-10</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 9</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061008140001</td>
                        <td>AHMAD LABIB RIFA'I</td>
                        <td>2014-08-10</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061008140002</td>
                        <td>ALI ARKAAN EFENDI</td>
                        <td>2014-08-10</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061008160001</td>
                        <td>GUSTRIAN RASYA ALFARIZKI</td>
                        <td>2016-08-10</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061008180001</td>
                        <td>REYNDRA SHAKEEL PRADIPTA</td>
                        <td>2018-08-10</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061008200001</td>
                        <td>AHMAD REZKA ELVANO</td>
                        <td>2020-08-10</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061009080002</td>
                        <td>SAIFUL RAMADHANI</td>
                        <td>2008-09-10</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN.3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061009100001</td>
                        <td>RAHMAD AIDIL FITRIYAN</td>
                        <td>2010-09-10</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>UMPU KENCANA</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061009130003</td>
                        <td>MUHAMMAD NAFI HASAN</td>
                        <td>2013-09-10</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061010080002</td>
                        <td>ABU ROHMAN</td>
                        <td>2008-10-10</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061010080003</td>
                        <td>ARYA ARGA DINATA</td>
                        <td>2008-10-10</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>NGESTI RAHAYU</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061010090002</td>
                        <td>AVIAN CHOKY PRAMUDIA</td>
                        <td>2009-10-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061010160001</td>
                        <td>HABIBI RIZKI NURHERMANSYAH</td>
                        <td>2016-10-10</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061010170001</td>
                        <td>ALVIAN AKHBAR ARDHATAMA</td>
                        <td>2017-10-10</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061010170002</td>
                        <td>DZAKWAN ABU ABDILLAH</td>
                        <td>2017-10-10</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 8</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061010170003</td>
                        <td>M. HASAN BILLY DARMAWAN</td>
                        <td>2017-10-10</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061010170004</td>
                        <td>M HUSEN.D</td>
                        <td>2017-10-10</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061010180001</td>
                        <td>MUHAMMAD GHANI AL HAFIZ</td>
                        <td>2018-10-10</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 4</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061010180002</td>
                        <td>MUHAMMAD ALTON SANJAYA</td>
                        <td>2018-10-10</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061010200001</td>
                        <td>MUHAMMAD NURIL MUSYAFFA</td>
                        <td>2020-10-10</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061010200002</td>
                        <td>DZIKRI ALGHIFARI</td>
                        <td>2020-10-10</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II TRITUNGGAL</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061011080001</td>
                        <td>MUHAMMAD NUR AL R.</td>
                        <td>2008-11-10</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061011080002</td>
                        <td>MASKUR ABDILLAH</td>
                        <td>2008-11-10</td>
                        <td>15</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061011090001</td>
                        <td>HAIKAL ALFIN FAHREZI</td>
                        <td>2009-11-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061011090003</td>
                        <td>YUANDA PUTRA PRATAMA</td>
                        <td>2009-11-10</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061011100004</td>
                        <td>AGUNG NOVRIYANTO</td>
                        <td>2010-11-10</td>
                        <td>13</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061011150001</td>
                        <td>DIPTA ANGGARA</td>
                        <td>2015-11-10</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061011200001</td>
                        <td>RAFISKY DAIFULAH</td>
                        <td>2020-11-10</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN VI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061012130001</td>
                        <td>MUHAMMAD ADI SAPUTRA</td>
                        <td>2013-12-10</td>
                        <td>10</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 6</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061012150001</td>
                        <td>NAWWAF</td>
                        <td>2015-12-10</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061012150002</td>
                        <td>YUSUF NAUFAL AFKAR</td>
                        <td>2015-12-10</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061012150003</td>
                        <td>DAFFA FADIL ARGANTA</td>
                        <td>2014-12-10</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061012200001</td>
                        <td>IBRAHIM BILAL NURMANSYAH</td>
                        <td>2020-12-10</td>
                        <td>3</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG AGUNG</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061071191000</td>
                        <td>AHMAD IBRAHIM</td>
                        <td>2019-07-01</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 5</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061083190001</td>
                        <td>FARIZAL LATIF A</td>
                        <td>2019-03-10</td>
                        <td>4</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MOJOPAHIT</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061101140001</td>
                        <td>FAREL VIKIANO</td>
                        <td>2014-01-11</td>
                        <td>9</td>
                        <td>Laki-laki</td>
                        <td>DUSUN X</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061101210002</td>
                        <td>ATTHALLAH HANNAN AMRULLAH</td>
                        <td>2021-01-11</td>
                        <td>2</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                    <tr>
                        <td>1802061102070001</td>
                        <td>FERI ARDIANSAH</td>
                        <td>2007-02-11</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061102070002</td>
                        <td>MUHAMAD AFFAN MUZAKI</td>
                        <td>2007-02-11</td>
                        <td>16</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061102110002</td>
                        <td>AHMAD ABIMANYU</td>
                        <td>2011-02-11</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN V</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061102120003</td>
                        <td>AZKA YUSPETER NURSHODIQ</td>
                        <td>2012-02-11</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061102150001</td>
                        <td>REYHAN ZIKRI AL GIFFARI</td>
                        <td>2015-02-11</td>
                        <td>8</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IV SIDODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061102160002</td>
                        <td>MUHAMMAD FARID MAZID</td>
                        <td>2016-02-11</td>
                        <td>7</td>
                        <td>Laki-laki</td>
                        <td>DUSUN TANJUNG KEJAWEN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061102170001</td>
                        <td>MUHAMMAD FARID SAPUTRA</td>
                        <td>2017-02-11</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III PARAHIYANGAN</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061103090001</td>
                        <td>AHMAD AGIL SILAHUDIN</td>
                        <td>2009-03-11</td>
                        <td>14</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN 1</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061103110001</td>
                        <td>MAULANA FATHU NI'AM</td>
                        <td>2011-03-11</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN IRIAN I</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061103110002</td>
                        <td>RIVAN DWI SAPUTRA</td>
                        <td>2011-03-11</td>
                        <td>12</td>
                        <td>Laki-laki</td>
                        <td>DUSUN II SUKOMULYO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <td>1802061103120001</td>
                        <td>FAHMI AKMAL ELBIASYAH</td>
                        <td>2012-03-11</td>
                        <td>11</td>
                        <td>Laki-laki</td>
                        <td>DUSUN I MULYOREJO</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061103170001</td>
                        <td>MARCHELINO ALFIANSYAH</td>
                        <td>2017-03-11</td>
                        <td>6</td>
                        <td>Laki-laki</td>
                        <td>DUSUN III TRIMODADI</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>SD</td>
                    </tr>
                    <tr>
                        <td>1802061103180001</td>
                        <td>RENDI WIDI SAPUTRA</td>
                        <td>2018-03-11</td>
                        <td>5</td>
                        <td>Laki-laki</td>
                        <td>DUSUN 3</td>
                        <td><span class="status-badge status-sekolah">Bersekolah</span></td>
                        <td>Belum Sekolah</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['7-12 tahun', '13-15 tahun', '16-18 tahun'],
                datasets: [{
                    label: 'Bersekolah',
                    data: [1150, 720, 480],
                    backgroundColor: '#1a73e8'
                }, {
                    label: 'Putus Sekolah',
                    data: [50, 80, 120],
                    backgroundColor: '#dc3545'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Bersekolah', 'Putus Sekolah'],
                datasets: [{
                    data: [2350, 250],
                    backgroundColor: ['#1a73e8', '#dc3545']
                }]
            },
            options: {
                responsive: true
            }
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const table = document.getElementById('detailTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    </script>
</body>

</html>