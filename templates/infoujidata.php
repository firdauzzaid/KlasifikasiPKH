<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>INFORMASI</title>
</head>

<body>
    <!-- Display Labelled Test Result -->
    <h3>Jumlah Data Benar</h3>
    <p>Jumlah data yang benar : {{ session['jumlah_data_benar'] }}</p>
    <p>Jumlah data yang salah : {{ session['jumlah_data_salah'] }}</p>

    <h3>Validasi Data Uji</h3>
    {% for result in session['hasil_prediksi_test'] %}
    <p>No: {{ result['Nomor'] }} | Data Asli: {{ result['Data Asli'] }}</p>
    <p>Label Asli: {{ result['Label Asli'] }} | Label Prediksi: {{ result['Label Prediksi'] }}</p>
    <p>Keterangan: {{ result['Keterangan'] }}</p>
    <hr>
    {% endfor %}
</body>

</html>