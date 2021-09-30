<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Extract Warna Gambar</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0
        }

        body {
            text-align: center;
        }

        form,
        div#wrap {
            margin: 10px auto;
            text-align: left;
            position: relative;
            width: 500px;
        }

        fieldset {
            padding: 20px;
            border: solid #999 2px;
        }

        img {
            width: 200px;
        }

        table {
            border: solid #000 1px;
            border-collapse: collapse;
        }

        td {
            border: solid #000 1px;
            padding: 2px 5px;
            white-space: nowrap;
        }

        br {
            width: 100%;
            height: 1px;
            clear: both;
        }
    </style>
</head>

<body>

    <?php
    if ($getColor) {
    ?>
        <div id="wrap">
            <table>
                <tr>
                    <td colspan="4">
                        <img style="width: 100%" src="<?= base_url('assets/upload/' . $file) ?>" alt="test image" />
                    </td>
                </tr>
                <tr>
                    <td>No.</td>
                    <td>Color</td>
                    <td>Color Code</td>
                    <!-- <td>Percentage</td> -->
                    <!-- <td rowspan="<?php echo (($num_results > 0) ? ($num_results + 1) : 22500); ?>"><img src="<?= 'images/' . $_FILES['imgFile']['name'] ?>" alt="test image" /></td> -->
                </tr>
                <?php
                $cek1 = 0;
                $cek2 = 2;
                foreach ($getColor as $hex => $count) {
                    if ($count > 0) {
                        if ($hex == '00ffff') {
                            $cek1 = 1;
                        }
                        if ($hex == '0000ff') {
                            $cek2 = 1;
                        }
                    }
                }

                $xx = 0;
                foreach ($getColor as $hex => $count) {
                    if ($count > 0) {
                        if ($hex != 'ffffff') {
                            if ($cek1 == $cek2) {
                                if ($hex != '00ffff') {
                                    $xx++;
                                    echo "<tr><td>" . $xx . "</td><td style=\"background-color:#" . $hex . ";\"></td><td>#" . $hex . "</td></tr>";
                                }
                            } else {
                                $xx++;
                                echo "<tr><td>" . $xx . "</td><td style=\"background-color:#" . $hex . ";\"></td><td>#" . $hex . "</td></tr>";
                            }
                        }
                    }
                }
                ?>
            </table>
        </div>
    <?php } else {
        echo "Gagal upload file!";
    } ?>

    <div>
        <a href="<?= base_url('Extract') ?>" type="button">
            << Kembali</a> </div> </body> </html>