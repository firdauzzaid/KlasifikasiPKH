<script type="text/javascript">
    window.print()
</script>

<style type="text/css">
    #print {
        margin: auto;
        text-align: center;
        font-family: "Calibri", Courier, monospace;
        width: 1200px;
        font-size: 14px;
    }

    #print .title {
        margin: 20px;
        text-align: right;
        font-family: "Calibri", Courier, monospace;
        font-size: 12px;
    }

    #print span {
        text-align: center;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 18px;
    }

    #print table {
        border-collapse: collapse;
        width: 100%;
        margin: 10px;
    }

    #print .table1 {
        border-collapse: collapse;
        width: 100%;
        text-align: center;
        margin: 10px;
    }

    #print table hr {
        border: 3px double #000;
    }

    #print .ttd {
        float: right;
        width: 500px;
        background-position: center;
        background-size: contain;
    }

    #print table th {
        color: #000;
        font-family: Verdana, Geneva, sans-serif;
        font-size: 12px;
    }

    #logo {
        width: 111px;
        height: 90px;
        padding-top: 10px;
        margin-left: 10px;
    }

    h2,
    h3 {
        margin: 0px 0px 0px 0px;
    }
</style>

<title>Laporan Cetak</title>
<div id="cetak">
    <table class='table1'>
        <tr>
            <td><img src='../static/assets/img/logo.jpeg' height="100" width="100"></td>
            <td>
                <h2>Hasil Klasifikasi Penerima Bantuan PKH</h2>
                <h2>Karang Makmur</h2>
                <p style="font-size:14px;"><i>Jalan Lapang Bola No. 20, Drajat, Kesambi, Kota Cirebon 45133</i></p>
            </td>
        </tr>
    </table>

    <table class='table'>
        <td>
            <hr />
        </td>
    </table>

    <tr>
        <td>
            <table border='1' cellpadding="7" class='table' width="100%">
                <tr>
                    <th>Nomor</th>
                    <th>ID Penerima</th>
                    <th>Nama Penerima</th>
                    <th>Status PKH</th>
                    <th>Hasil Klasifikasi</th>
                </tr>
                <tbody class="table-border-bottom-0">
                    {% for row in data %}
                    <tr>
                        <td>{{ row[0] }}</td>
                        <td>{{ row[1] }}</td>
                        <td>{{ row[2] }}</td>
                        <td>{{ row[3] }}</td>
                        <td>{{ row[4] }}</td>

                    </tr>
                    {% endfor %}
                </tbody>
            </table>
            </table>
</div>
<div id="print">
    <table align="center" class="ttd" width="500px">
        <tr>
            <td style="padding:20px 20px 20px 20px" align="center" width="500px">
                <strong>Ketua RW</strong>
                <br><br><br><br>
                <strong><u>TTD</u><br></strong><small></small>
            </td>
        </tr>
    </table>
</div>