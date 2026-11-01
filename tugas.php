
<?php

$matkul = [
    [
        "nama" => "Algoritma dan Pemrograman",
        "sks" => 3,
        "nilai" => 90
    ],
    [
        "nama" => "Basis Data",
        "sks" => 3,
        "nilai" => 80
    ],
    [
        "nama" => "Pemrograman Web",
        "sks" => 3,
        "nilai" => 75
    ],
    [
        "nama" => "Sistem Operasi",
        "sks" => 2,
        "nilai" => 65
    ],
    [
        "nama" => "Matematika Diskrit",
        "sks" => 3,
        "nilai" => 55
    ],
    [
        "nama" => "Jaringan Komputer",
        "sks" => 2,
        "nilai" => 40
    ]
];


function hitungBobot($nilai) {

    if ($nilai >= 85) {
        return [
            "huruf" => "A",
            "bobot" => 4.0
        ];
    } elseif ($nilai >= 75) {
        return [
            "huruf" => "B",
            "bobot" => 3.0
        ];
    } elseif ($nilai >= 65) {
        return [
            "huruf" => "C",
            "bobot" => 2.0
        ];
    } elseif ($nilai >= 50) {
        return [
            "huruf" => "D",
            "bobot" => 1.0
        ];
    } else {
        return [
            "huruf" => "E",
            "bobot" => 0.0
        ];
    }
}


$totalSKS = 0;
$totalMutu = 0;

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Latihan Individu PHP</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
        }

        .container {
            background-color: white;
            max-width: 1000px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr.mengulang {
            background-color: #ffcccc;
            color: red;
        }

        .ringkasan {
            margin-top: 25px;
            padding: 20px;
            background-color: #eaf4ff;
            border-radius: 8px;
        }

        .batas {
            margin-top: 15px;
            padding: 20px;
            background-color: #d4edda;
            border-radius: 8px;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>Daftar Nilai Mata Kuliah</h2>

    <!-- 3. Menampilkan data mata kuliah -->

    <table>

        <tr>
            <th>No</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Bobot</th>
            <th>Status</th>
        </tr>

        <?php foreach ($matkul as $index => $mk): ?>

            <?php

            
                $hasil = hitungBobot($mk["nilai"]);

                $huruf = $hasil["huruf"];
                $bobot = $hasil["bobot"];

               
                if ($bobot >= 2.0) {
                    $status = "LULUS";
                } else {
                    $status = "MENGULANG";
                }

               
                $totalSKS += $mk["sks"];

                $totalMutu += $mk["sks"] * $bobot;

            ?>

            <tr class="<?= ($status == 'MENGULANG') ? 'mengulang' : '' ?>">

                <td><?= $index + 1 ?></td>

                <td><?= htmlspecialchars($mk["nama"]) ?></td>

                <td><?= $mk["sks"] ?></td>

                <td><?= $mk["nilai"] ?></td>

                <td><?= $huruf ?></td>

                <td><?= number_format($bobot, 1) ?></td>

                <td><?= $status ?></td>

            </tr>

        <?php endforeach; ?>

    </table>

   

    <?php

        $ips = $totalMutu / $totalSKS;

    ?>

    <div class="ringkasan">

        <h3>Ringkasan IPS</h3>

        <p>
            Total SKS:
            <strong><?= $totalSKS ?> SKS</strong>
        </p>

        <p>
            Total Mutu:
            <strong><?= number_format($totalMutu, 2) ?></strong>
        </p>

        <p>
            IPS:
            <strong><?= number_format($ips, 2) ?></strong>
        </p>

    </div>

     

    <?php

        if ($ips >= 3.00) {
            $batasSKS = 24;
        } else {
            $batasSKS = 20;
        }

    ?>

    <div class="batas">

        <h3>Batas SKS Semester Depan</h3>

        <p>
            Berdasarkan IPS
            <strong><?= number_format($ips, 2) ?></strong>,
            maksimal pengambilan SKS semester depan adalah:

            <strong><?= $batasSKS ?> SKS</strong>
        </p>

    </div>

</div>

</body>
</html>
