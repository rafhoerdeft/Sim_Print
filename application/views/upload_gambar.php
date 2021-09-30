<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <title>Image Color Extraction</title>
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
    <div id="wrap">
        <form action="<?= base_url('Extract/proses') ?>" method="POST" enctype="multipart/form-data">
            <?= token_csrf() ?>
            <fieldset>
                <legend>Upload file gambar</legend>
                <div>
                    <label>File: <input required type="file" name="imgFile" accept="image/x-png, image/jpg, image/jpeg" /></label>
                    <input style="float: right;" type="submit" name="action" value="Process" />
                </div>
                <!-- <div>
                    <label>Number of colors: <input required type="text" name="num_results" value="24" /></label>
                </div>
                <div>
                    <label>Delta: <input required type="text" name="delta" value="24" /></label>
                    (1-255)
                </div>
                <div>
                    <label>Kurangi Pencahayaan: <input required type="radio" name="reduce_brightness" value="1" /> Yes <input type="radio" name="reduce_brightness" value="0" checked /> No</label>
                </div>
                <div>
                    <label>Kurangi Gradasi: <input required type="radio" name="reduce_gradients" value="1" /> Yes <input type="radio" name="reduce_gradients" value="0" checked /> No </label>
                </div> -->
            </fieldset>
        </form>
    </div>
</body>

</html>