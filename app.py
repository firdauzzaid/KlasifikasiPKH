from flask import Flask, render_template, request, redirect, url_for, flash, session, jsonify
from flask_session import Session
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import MinMaxScaler
from sklearn.metrics import accuracy_score, confusion_matrix
from train_perceptron_manual import PerceptronManual
from flask_sqlalchemy import SQLAlchemy
from dotenv import load_dotenv

import matplotlib.pyplot as plt
import pickle
import numpy as np
import pymysql
import os
import csv
import matplotlib


matplotlib.use('Agg')
load_dotenv()

app = Flask(__name__)

# Konfigurasi untuk menggunakan filesystem sebagai penyimpanan sesi
app.config['SESSION_TYPE'] = 'filesystem'
app.secret_key = 'secret_key'

# Inisialisasi sesi
Session(app)

# Inisialisasi sesi upload file
app.config['FILE_UPLOADS'] = "static\\assets\\uploads"

ALLOWED_EXTENSIONS = {'csv'}

# Konfigurasi koneksi database
db = pymysql.connect(
    host="localhost",
    user="root",
    password="",
    database="klasifikasipkh"
)

app.secret_key = os.getenv('SECRET_KEY')

app.config['SQLALCHEMY_DATABASE_URI'] = os.getenv('DATABASE_URL')
db = SQLAlchemy(app)

# Interaksi dengan database digunakan untuk menjalankan pernyataan SQL dan mengambil hasilnya dari database
cursor = db.cursor()

############################################################################### FUNGSI TRAIN DATA ###############################################################################


def convert_input(data_point, data_maps, column_index):
    # Fungsi untuk mengonversi data input
    input_data = []
    for key, value in data_maps.items():
        if key in column_index:
            input_data.append(
                value.get(data_point[column_index[key]], None))
        else:
            input_data.append(None)
    return input_data

############################################################################### MENU LOGIN dan REGISTER ###############################################################################


@app.route('/')
def login():
    return render_template('login.php')


@app.route('/loginAdmin', methods=['GET', 'POST'])
def loginAdmin():
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')

        sql = f"SELECT * FROM admin WHERE username='{username}' AND password='{password}'"
        cursor.execute(sql)
        user_data = cursor.fetchone()

        if user_data:
            # Menyimpan session admin
            session['id_admin'] = user_data[0]
            session['username'] = user_data[1]

            # Jika login berhasil, tampilkan pesan berhasil
            flash(f'Selamat Datang, {user_data[1]}', 'success')
            return redirect(url_for('dashboard'))
        else:
            # Jika login gagal, tampilkan pesan error
            flash('Email atau password Anda salah!', 'error')
            return redirect(request.url)

    return render_template('login.php')


@app.route('/register')
def register():
    return render_template('register.php')


@app.route('/regsAdmin', methods=['GET', 'POST'])
def regsAdmin():
    if request.method == 'POST':
        # Ambil data yang dikirimkan dari formulir registrasi
        username = request.form.get('username')
        password = request.form.get('password')
        cpassword = request.form.get('cpassword')

        # Periksa apakah password dan konfirmasi password sesuai
        if password == cpassword:
            # Periksa apakah username sudah terdaftar
            query = "SELECT * FROM admin WHERE username=%s"
            cursor.execute(query, (username,))
            user = cursor.fetchone()

            if not user:
                # Jika username belum terdaftar, tambahkan pengguna baru ke database
                query = "INSERT INTO admin (username, password) VALUES (%s, %s)"
                cursor.execute(query, (username, password))
                db.commit()

                # Redirect ke halaman dashboard atau halaman lain yang sesuai
                return render_template('dashboard.php')
            else:
                flash('Username Sudah Terdaftar.', 'error')
                return redirect(request.url)
        else:
            flash('Password Tidak Sesuai', 'error')
            return redirect(request.url)

    return render_template('register.php')

############################################################################### MENU DASHBOARD ###############################################################################


@app.route('/dashboard')
def dashboard():
    if 'id_admin' in session:
        id_admin = session['id_admin']

        # Query untuk mengambil data dari tabel berdasarkan id_admin yang disimpan di session
        query_admin = f"SELECT username FROM admin WHERE id_admin='{id_admin}'"
        cursor.execute(query_admin)
        data_admin = cursor.fetchone()

        # Pastikan data admin ditemukan sebelum mengakses nama admin
        if data_admin:
            nama_admin = data_admin[0]

            # Query untuk menghitung jumlah data dalam tabel "penerima_pkh"
            query_totaldata = "SELECT COUNT(*) FROM penerimapkh WHERE id_admin=%s"
            cursor.execute(query_totaldata, (id_admin,))
            # Mengambil jumlah data dari hasil query
            total_data = cursor.fetchone()[0]

            # Query untuk menghitung jumlah data dalam tabel "hasilklasifikasi"
            query_hasilklasifikasi = f"""
                SELECT COUNT(*) 
                FROM hasilklasifikasi
                INNER JOIN penerimapkh ON hasilklasifikasi.id_penerima = penerimapkh.id_penerima
                WHERE penerimapkh.id_admin = '{id_admin}'
            """
            cursor.execute(query_hasilklasifikasi)
            total_hasilklasifikasi = cursor.fetchone()[0]

            # load nilai akurasi yang digunakan
            loaded_accuracy_test = None
            loaded_accuracy_train = None

            try:
                with open('model_perceptron.pkl', 'rb') as file:
                    data = pickle.load(file)
                    # loaded_model = data['model']
                    loaded_accuracy_test = data['accuracy_test']
                    loaded_accuracy_train = data['accuracy_train']

            except FileNotFoundError:
                # Tangani kesalahan jika file model tidak ditemukan
                print("File model tidak ditemukan. Menggunakan nilai default None.")

            # Load nilai akurasi data latih terbaru
            akurasi_train = session.get('akurasi_train', None)
            akurasi_test = session.get('akurasi_test', None)

            return render_template('dashboard.php',
                                   nama_admin=nama_admin, total_data=total_data, total_hasilklasifikasi=total_hasilklasifikasi,
                                   hasil_akurasi_train=loaded_accuracy_train, hasil_akurasi_test=loaded_accuracy_test,
                                   new_akurasi_train=akurasi_train, new_akurasi_test=akurasi_test)

    # Jika tidak ada session id_admin atau data admin tidak ditemukan, arahkan ke halaman login
    flash('Silakan login terlebih dahulu.', 'error')
    return redirect(url_for('login'))


@app.route('/get_data', methods=['GET'])
def get_data():
    if 'id_admin' in session:
        id_admin = session['id_admin']

        # Query untuk menghitung jumlah data "Layak" dalam tabel "hasilklasifikasi"
        query_layak = f"""
            SELECT COUNT(*) 
            FROM hasilklasifikasi
            INNER JOIN penerimapkh ON hasilklasifikasi.id_penerima = penerimapkh.id_penerima
            WHERE penerimapkh.id_admin = '{id_admin}' AND hasilklasifikasi.statusPKH = 'Layak'
        """
        cursor.execute(query_layak)
        total_layak = cursor.fetchone()[0]

        # Query untuk menghitung jumlah data "Tidak Layak" dalam tabel "hasilklasifikasi"
        query_tidak_layak = f"""
            SELECT COUNT(*) 
            FROM hasilklasifikasi
            INNER JOIN penerimapkh ON hasilklasifikasi.id_penerima = penerimapkh.id_penerima
            WHERE penerimapkh.id_admin = '{id_admin}' AND hasilklasifikasi.statusPKH = 'Tidak Layak'
        """
        cursor.execute(query_tidak_layak)
        total_tidak_layak = cursor.fetchone()[0]

        data = {
            'total_layak': total_layak,
            'total_tidak_layak': total_tidak_layak
        }

        return jsonify(data)

############################################################################### MENU LATIH DATA ###############################################################################


@app.route('/menu_latih_data')
def menu_latih_data():
    if 'id_admin' in session:
        id_admin = session['username']

        # Query untuk mengambil data dari tabel yang sesuai dengan id_admin yang sedang login
        query_pkh = "SELECT * FROM latihdata"
        cursor.execute(query_pkh)
        data = cursor.fetchall()

    return render_template('latih_data.php', data=data, nama_admin=id_admin)


@app.route('/latih_input_penerima_pkh', methods=['GET', 'POST'])
def latih_input_penerima_pkh():

    if 'id_admin' in session:
        id_admin = session['id_admin']

        if request.method == 'POST':
            id_penerima = request.form.get('id_penerima')
            nama = request.form.get('nama')
            alamat = request.form.get('alamat')
            sts_lahan = request.form.get('sts_lahan')
            sts_bangunan = request.form.get('sts_bangunan')
            jns_lantai = request.form.get('jns_lantai')
            jns_dinding = request.form.get('jns_dinding')
            jns_atap = request.form.get('jns_atap')
            smr_air = request.form.get('smr_air')
            smr_penerangan = request.form.get('smr_penerangan')
            bb_memasak = request.form.get('bb_memasak')
            jns_kloset = request.form.get('jns_kloset')
            jns_kendaraan = request.form.get('jns_kendaraan')
            aset_pribadi = request.form.get('aset_pribadi')
            tlpn_rumah = request.form.get('tlpn_rumah')
            wifi = request.form.get('wifi')
            statusAwal = request.form.get('statusAwal')

            if sts_bangunan or sts_bangunan or jns_lantai or jns_dinding or jns_atap or smr_air or smr_penerangan or bb_memasak or jns_kloset or jns_kendaraan or aset_pribadi or tlpn_rumah or wifi:
                query = """
                    INSERT INTO latihdata (id_penerima, id_admin, nama, alamat, sts_lahan, sts_bangunan, jns_lantai, jns_dinding, jns_atap, smr_air, smr_penerangan, bb_memasak, jns_kloset, jns_kendaraan, aset_pribadi, tlpn_rumah, wifi, statusAwal)
                    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                    """
                cursor.execute(query, (id_penerima, id_admin, nama, alamat, sts_lahan, sts_bangunan, jns_lantai, jns_dinding, jns_atap,
                                       smr_air, smr_penerangan, bb_memasak, jns_kloset, jns_kendaraan, aset_pribadi, tlpn_rumah, wifi, statusAwal))

                db.commit()

                flash('Data berhasil ditambahkan!', 'success')
                return redirect(url_for('menu_latih_data'))

            else:
                flash('Kriteria penerima tidak boleh kosong!', 'error')
                return redirect(url_for('menu_latih_data'))

    return render_template('menu_latih_data.php')


@app.route('/input_penerima_pkh_csv', methods=['GET', 'POST'])
def input_penerima_pkh_csv():

    if 'id_admin' in session:
        id_admin = session['id_admin']

        data = []

        if request.method == 'POST':
            if 'csv_file' in request.files:
                uploaded_file = request.files['csv_file']
                filepath = os.path.join(
                    app.config['FILE_UPLOADS'], uploaded_file.filename)
                uploaded_file.save(filepath)

                with open(filepath) as file:
                    csv_file = csv.reader(file)
                    for row in csv_file:
                        data.append(row)

                for i, row in enumerate(data):
                    if i > 0:
                        banned_characters = ["'", '"']
                        id_penerima = row[0]
                        nama = row[1]
                        alamat = row[2]
                        for character in banned_characters:  # Removing banned characters
                            id_penerima = id_penerima.replace(character, '')
                            nama = nama.replace(character, '')
                            alamat = alamat.replace(character, '')
                        # id_penerima = int(id_penerima)
                        sts_lahan = row[4]
                        sts_bangunan = row[5]
                        jns_lantai = row[6]
                        jns_dinding = row[7]
                        jns_atap = row[8]
                        smr_air = row[9]
                        smr_penerangan = row[10]
                        bb_memasak = row[11]
                        jns_kloset = row[12]
                        jns_kendaraan = row[13]
                        aset_pribadi = row[14]
                        tlpn_rumah = row[15]
                        wifi = row[16]
                        statusAwal = row[17]

                        query = """
                            INSERT INTO latihdata (id_penerima, id_admin, nama, alamat, sts_lahan, sts_bangunan, jns_lantai, jns_dinding, jns_atap,
                                smr_air, smr_penerangan, bb_memasak, jns_kloset, jns_kendaraan, aset_pribadi, tlpn_rumah, wifi, statusAwal)
                            VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                            """
                        try:
                            cursor.execute(query, (id_penerima, id_admin, nama, alamat, sts_lahan, sts_bangunan, jns_lantai, jns_dinding, jns_atap,
                                                   smr_air, smr_penerangan, bb_memasak, jns_kloset, jns_kendaraan, aset_pribadi, tlpn_rumah, wifi, statusAwal))

                            db.commit()
                            print('CSV data successfuly saved to database!')

                        except Exception as e:
                            print(e)

                flash('Data berhasil ditambahkan!', 'success')
            else:
                flash('Tidak ada file yang diunggah!', 'error')

            return redirect(url_for('menu_latih_data'))

    return render_template('menu_latih_data.php')


@app.route('/latih_data', methods=['GET'])
def latih_data():
    if 'id_admin' in session:

        if request.method == 'GET':
            # Konversi data input
            data_maps = {
                "sts_lahan": {"Pribadi": 1, "Warisan": 2, "Negara": 3},
                "sts_bangunan": {"Pribadi": 1, "Warisan": 2, "Umum": 3},
                "jns_lantai": {"Teraso": 1, "Keramik": 2, "Vinyl": 3, "Semen": 4},
                "jns_dinding": {"Hebel": 1, "Batako": 2, "Bata Merah": 3, "GRC": 4, "Kayu": 5},
                "jns_atap": {"Tanah Liat": 1, "Asbes": 2, "Seng": 3},
                "smr_air": {"PDAM": 1, "Sanyo": 2, "Sumur": 3},
                "smr_penerangan": {"Listrik": 1, "Lainnya": 2},
                "bb_memasak": {"Gas": 1, "Kompor Minyak": 2, "Tungku": 3},
                "jns_kloset": {"Kloset Duduk": 1, "Kloset Jongkok": 2},
                "jns_kendaraan": {"Mobil": 1, "Motor": 2, "Sepeda": 3, "Angkutan Umum": 4},
                "aset_pribadi": {"Tanah": 1, "Sawah": 2, "Rumah": 3, "Tidak Ada": 4},
                "tlpn_rumah": {"Ya": 1, "Tidak": 2},
                "wifi": {"Ya": 1, "Tidak": 2}
            }

            # Mengambil semua data penerima yang akan diproses
            query = "SELECT * FROM latihdata"

            cursor.execute(query)
            all_data = cursor.fetchall()
            db.commit()

            # Mendefinisikan data latih (x_train_all) dan label kelas (y_train_all)
            x_train_all = []
            y_train_all = []

            # Membuat indeks kolom
            column_index = {desc[0]: i for i,
                            desc in enumerate(cursor.description)}

            for data_point in all_data:
                input_data = convert_input(data_point, data_maps, column_index)

                x_train_all.append(input_data)
                label_kelas = data_point[column_index['statusAwal']]
                y_train_all.append(label_kelas)

            x_train_all = np.array(x_train_all)
            y_train_all = np.array(y_train_all)

            # Split data menjadi data latih dan data uji
            if len(x_train_all) > 0:
                x_train, x_test, y_train, y_test = train_test_split(
                    x_train_all, y_train_all, train_size=0.8)

                if len(x_train) > 0:
                    # Normalisasi data
                    scaler = MinMaxScaler()
                    x_train_scaled = scaler.fit_transform(x_train)
                    x_test_scaled = scaler.fit_transform(x_test)

                    # Inisialisasi model perceptron manual
                    model_perceptron = PerceptronManual(
                        learning_rate=0.1, num_epochs=100, activation_function='relu')

                    # Latih model
                    model_perceptron.fit(x_train_scaled, y_train)

                    # Konversi string target ke nilai biner
                    y_train_binary = y_train.astype(int)
                    y_test_binary = y_test.astype(int)

                    # Prediksi data uji
                    classification_test = model_perceptron.predict(
                        x_test_scaled)
                    akurasi_test = accuracy_score(
                        y_test_binary, classification_test)
                    # Prediksi data latih
                    classification_train = model_perceptron.predict(
                        x_train_scaled)
                    akurasi_train = accuracy_score(
                        y_train_binary, classification_train)

                    # ---------------------------------- Bobot ----------------------------------#
                    # Penamaan fitur
                    feature_names_perceptron = ['sts_lahan', 'sts_bangunan', 'jns_lantai', 'jns_dinding', 'jns_atap', 'smr_air',
                                                'smr_penerangan', 'bb_memasak', 'jns_kloset', 'jns_kendaraan', 'aset_pribadi', 'tlpn_rumah', 'wifi']

                    # Create a dictionary to store results
                    results_dict = {}
                    # Get the weights and feature names or indices
                    weights_perceptron = model_perceptron.weights
                    # Sort the weights and corresponding feature names or indices in descending order
                    sorted_indices_perceptron = np.argsort(
                        weights_perceptron)[::-1]
                    sorted_weights_perceptron = weights_perceptron[sorted_indices_perceptron]
                    sorted_feature_names_perceptron = np.array(feature_names_perceptron)[
                        sorted_indices_perceptron]
                    # Store results in the dictionary
                    results_dict = list(
                        zip(sorted_feature_names_perceptron, sorted_weights_perceptron))

                    # ---------------------------------- Confusion Matrix dan Classification Report ----------------------------------#
                    # Calculate confusion matrix and classification report
                    confusionMatrix = confusion_matrix(
                        y_test_binary, classification_test)
                    # Menampilkan confusion matrix dalam format yang diinginkan
                    confusion_matrix_display = [
                        ["", "Prediksi Negatif", "Prediksi Positif"],
                        ["Aktual Negatif", "TN: " +
                            str(confusionMatrix[0][0]), "FP: " + str(confusionMatrix[0][1])],
                        ["Aktual Positif", "FN: " +
                            str(confusionMatrix[1][0]), "TP: " + str(confusionMatrix[1][1])]
                    ]

                    # Simpan data yang dibutuhkan
                    session['hasil_model'] = model_perceptron
                    session['akurasi_test'] = akurasi_test
                    session['akurasi_train'] = akurasi_train
                    session['bobot_hasil'] = results_dict
                    session['confusion_matrix'] = confusion_matrix_display

                    return redirect(url_for('menu_latih_data'))

            # Jika sampel tidak cukup, tambahkan penanganan kesalahan di sini
            print("Tidak cukup sampel untuk memisahkan data.")
            return redirect(url_for('menu_latih_data'))


@app.route('/infolatihdata', methods=['GET'])
def infolatihdata():
    epoch_data = session.get('epoch_data', [])

    return render_template('infolatihdata.php', epoch_data=epoch_data)


@app.route('/latih_update_penerima_pkh', methods=['POST'])
def latih_update_penerima_pkh():

    if 'id_admin' in session:
        id_admin = session['id_admin']

        if request.method == 'POST':
            id_penerima = request.form.get('id_penerima_edit')
            nama = request.form.get('nama_edit')
            alamat = request.form.get('alamat_edit')
            sts_lahan = request.form.get('sts_lahan_edit')
            sts_bangunan = request.form.get('sts_bangunan_edit')
            jns_lantai = request.form.get('jns_lantai_edit')
            jns_dinding = request.form.get('jns_dinding_edit')
            jns_atap = request.form.get('jns_atap_edit')
            smr_air = request.form.get('smr_air_edit')
            smr_penerangan = request.form.get('smr_penerangan_edit')
            bb_memasak = request.form.get('bb_memasak_edit')
            jns_kloset = request.form.get('jns_kloset_edit')
            jns_kendaraan = request.form.get('jns_kendaraan_edit')
            aset_pribadi = request.form.get('aset_pribadi_edit')
            tlpn_rumah = request.form.get('tlpn_rumah_edit')
            wifi = request.form.get('wifi_edit')
            statusAwal = request.form.get('statusAwal_edit')

            if sts_bangunan or sts_bangunan or jns_lantai or jns_dinding or jns_atap or smr_air or smr_penerangan or bb_memasak or jns_kloset or jns_kendaraan or aset_pribadi or tlpn_rumah or wifi:

                query = """UPDATE latihdata SET \
                    nama=%s, \
                    alamat=%s, \
                    sts_lahan=%s, \
                    sts_bangunan=%s, \
                    jns_lantai=%s, \
                    jns_dinding=%s, \
                    jns_atap=%s, \
                    smr_air=%s, \
                    smr_penerangan=%s, \
                    bb_memasak=%s, \
                    jns_kloset=%s, \
                    jns_kendaraan=%s, \
                    aset_pribadi=%s, \
                    tlpn_rumah=%s, \
                    wifi=%s, \
                    statusAwal=%s \
                    WHERE id_penerima=%s"""

                cursor.execute(query, (nama, alamat, sts_lahan, sts_bangunan, jns_lantai, jns_dinding, jns_atap,
                                       smr_air, smr_penerangan, bb_memasak, jns_kloset, jns_kendaraan, aset_pribadi, tlpn_rumah, wifi, statusAwal, id_penerima))
                db.commit()

                flash('Data berhasil diubah!', 'success')
                return redirect(url_for('menu_latih_data'))

            else:
                flash('Kriteria penerima tidak boleh kosong!', 'error')
                return redirect(url_for('menu_latih_data'))

    return render_template('menu_latih_data.php')


@app.route('/latih_delete_penerima_pkh', methods=['POST'])
def latih_delete_penerima_pkh():

    if request.method == 'POST':
        id_penerima = request.form['id_data_hapus']

        query = "DELETE FROM latihdata WHERE id_penerima=%s"

        try:
            cursor.execute(query, (id_penerima, ))
            db.commit()
            flash('Data berhasil dihapus!', 'success')
        except Exception as e:
            db.rollback()
            flash('Terjadi kesalahan: ' + str(e), 'error')

        return redirect(url_for('menu_latih_data'))

    return render_template('menu_latih_data.php')


@app.route('/simpan_model', methods=['POST'])
def simpan_model():
    try:
        model_perceptron = session.get('hasil_model')
        accuracy_train = session.get('akurasi_train', None)
        accuracy_test = session.get('akurasi_test', None)

        # Menyimpan model
        with open('model_perceptron.pkl', 'wb') as file:
            pickle.dump({'model': model_perceptron, 'accuracy_test': accuracy_test,
                        'accuracy_train': accuracy_train}, file)

        return jsonify({'message': 'Model berhasil disimpan.'}), 200
    except Exception as e:
        print(str(e))
        return jsonify({'message': 'Gagal menyimpan model.'}), 500


############################################################################### MENU VALIDASI DATA ###############################################################################
@app.route('/menu_validasi_data', methods=['GET'])
def menu_validasi_data():
    if 'id_admin' in session:
        id_admin = session['username']

        # Query untuk mengambil data dari tabel yang sesuai dengan id_admin yang sedang login
        query_pkh = "SELECT * FROM latihdata"
        cursor.execute(query_pkh)
        data = cursor.fetchall()

    return render_template('validasi_data.php', data=data, nama_admin=id_admin)


@app.route('/validasi_data', methods=['GET'])
def validasi_data():

    # load trained model
    try:
        with open('model_perceptron.pkl', 'rb') as file:
            data = pickle.load(file)
            loaded_model = data['model']
    except FileNotFoundError:
        flash('Model tidak tersedia, silahkan latih model terlebih dahulu.', 'error')
        return redirect(url_for('menu_latih_data'))

    if 'id_admin' in session:

        if request.method == 'GET':
            # Konversi data input
            data_maps = {
                "sts_lahan": {"Pribadi": 1, "Warisan": 2, "Negara": 3},
                "sts_bangunan": {"Pribadi": 1, "Warisan": 2, "Umum": 3},
                "jns_lantai": {"Teraso": 1, "Keramik": 2, "Vinyl": 3, "Semen": 4},
                "jns_dinding": {"Hebel": 1, "Batako": 2, "Bata Merah": 3, "GRC": 4, "Kayu": 5},
                "jns_atap": {"Tanah Liat": 1, "Asbes": 2, "Seng": 3},
                "smr_air": {"PDAM": 1, "Sanyo": 2, "Sumur": 3},
                "smr_penerangan": {"Listrik": 1, "Lainnya": 2},
                "bb_memasak": {"Gas": 1, "Kompor Minyak": 2, "Tungku": 3},
                "jns_kloset": {"Kloset Duduk": 1, "Kloset Jongkok": 2},
                "jns_kendaraan": {"Mobil": 1, "Motor": 2, "Sepeda": 3, "Angkutan Umum": 4},
                "aset_pribadi": {"Tanah": 1, "Sawah": 2, "Rumah": 3, "Tidak Ada": 4},
                "tlpn_rumah": {"Ya": 1, "Tidak": 2},
                "wifi": {"Ya": 1, "Tidak": 2}
            }

            # Mengambil semua data penerima yang akan diproses
            query = "SELECT * FROM latihdata"

            cursor.execute(query)
            all_data = cursor.fetchall()
            db.commit()

            # Simpan nilai
            hasil_klasifikasi = []
            input_data_all = []

            # Membuat indeks kolom
            column_index = {desc[0]: i for i,
                            desc in enumerate(cursor.description)}

            for data_point in all_data:
                id_penerima, statusAwal = data_point[0], data_point[17]
                input_data = convert_input(data_point, data_maps, column_index)

                input_data_all.append(input_data)

                # nilai minimum kriteria
                n_min = np.array([[1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]])
                # nilai maksimum kriteria
                n_max = np.array([[3, 3, 4, 5, 3, 3, 2, 3, 2, 4, 4, 2, 2]])
                # menggabungkan nilai array
                bobot = np.append(n_min, n_max, axis=0)
                # nilai input
                n_input = np.array([input_data])
                # perhitungan nilai bobot
                n_dim = np.append(bobot, n_input, axis=0)

                # Skala data
                hasil_input = MinMaxScaler().fit_transform(n_dim)

                classification = loaded_model.predict(hasil_input[[2]])

                if classification[0] == 0:
                    statusPKH = 0
                elif classification[0] == 1:
                    statusPKH = 1

                hasil_klasifikasi.append(
                    (id_penerima, statusAwal, statusPKH))

            results_test = []
            count_benar = 0
            count_salah = 0

            for result, input_data in zip(hasil_klasifikasi, input_data_all):
                id_penerima, statusAwal, statusPKH = result
                keterangan = "Salah" if str(
                    statusAwal) != str(statusPKH) else "Benar"

                if keterangan == "Benar":
                    count_benar += 1
                else:
                    count_salah += 1

                result_row = {
                    'Nomor': id_penerima,
                    'Data Asli': input_data,
                    'Label Asli': statusAwal,
                    'Label Prediksi': statusPKH,
                    'Keterangan': keterangan
                }
                results_test.append(result_row)

            session['hasil_prediksi_test'] = results_test
            session['jumlah_data_benar'] = count_benar
            session['jumlah_data_salah'] = count_salah

            return render_template('infoujidata.php')

    return redirect(url_for('menu_validasi_data'))


@app.route('/validasi_input_penerima_pkh', methods=['GET', 'POST'])
def validasi_input_penerima_pkh():

    if 'id_admin' in session:
        id_admin = session['id_admin']

        if request.method == 'POST':
            id_penerima = request.form.get('id_penerima')
            nama = request.form.get('nama')
            alamat = request.form.get('alamat')
            sts_lahan = request.form.get('sts_lahan')
            sts_bangunan = request.form.get('sts_bangunan')
            jns_lantai = request.form.get('jns_lantai')
            jns_dinding = request.form.get('jns_dinding')
            jns_atap = request.form.get('jns_atap')
            smr_air = request.form.get('smr_air')
            smr_penerangan = request.form.get('smr_penerangan')
            bb_memasak = request.form.get('bb_memasak')
            jns_kloset = request.form.get('jns_kloset')
            jns_kendaraan = request.form.get('jns_kendaraan')
            aset_pribadi = request.form.get('aset_pribadi')
            tlpn_rumah = request.form.get('tlpn_rumah')
            wifi = request.form.get('wifi')
            statusAwal = request.form.get('statusAwal')

            if sts_bangunan or sts_bangunan or jns_lantai or jns_dinding or jns_atap or smr_air or smr_penerangan or bb_memasak or jns_kloset or jns_kendaraan or aset_pribadi or tlpn_rumah or wifi:
                query = """
                    INSERT INTO validasidata (id_penerima, id_admin, nama, alamat, sts_lahan, sts_bangunan, jns_lantai, jns_dinding, jns_atap, smr_air, smr_penerangan, bb_memasak, jns_kloset, jns_kendaraan, aset_pribadi, tlpn_rumah, wifi, statusAwal)
                    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                    """
                cursor.execute(query, (id_penerima, id_admin, nama, alamat, sts_lahan, sts_bangunan, jns_lantai, jns_dinding, jns_atap,
                                       smr_air, smr_penerangan, bb_memasak, jns_kloset, jns_kendaraan, aset_pribadi, tlpn_rumah, wifi, statusAwal))

                db.commit()

                flash('Data berhasil ditambahkan!', 'success')
                return redirect(url_for('menu_validasi_data'))

            else:
                flash('Kriteria penerima tidak boleh kosong!', 'error')
                return redirect(url_for('menu_validasi_data'))

    return render_template('menu_validasi_data.php')


@app.route('/validasi_delete_penerima_pkh', methods=['POST'])
def validasi_delete_penerima_pkh():

    if request.method == 'POST':
        id_penerima = request.form['id_data_hapus']

        query = "DELETE FROM validasidata WHERE id_penerima=%s"

        try:
            cursor.execute(query, (id_penerima, ))
            db.commit()
            flash('Data berhasil dihapus!', 'success')
        except Exception as e:
            db.rollback()
            flash('Terjadi kesalahan: ' + str(e), 'error')

        return redirect(url_for('menu_validasi_data'))

    return render_template('menu_validasi_data.php')

############################################################################### MENU MASTER DATA UJI ###############################################################################


@app.route('/penerimapkh')
def penerimapkh():
    if 'id_admin' in session:
        id_admin = session['id_admin']

        # Query untuk mengambil data dari tabel yang sesuai dengan id_admin yang sedang login
        query_pkh = "SELECT * FROM penerimapkh WHERE id_admin=%s"
        cursor.execute(query_pkh, (id_admin,))
        data = cursor.fetchall()

        return render_template('penerimapkh.php', data=data, nama_admin=session['username'])


@app.route('/input_penerima_pkh', methods=['GET', 'POST'])
def input_penerima_pkh():

    if 'id_admin' in session:
        id_admin = session['id_admin']

        if request.method == 'POST':
            id_penerima = request.form.get('id_penerima')
            nama = request.form.get('nama')
            alamat = request.form.get('alamat')
            sts_lahan = request.form.get('sts_lahan')
            sts_bangunan = request.form.get('sts_bangunan')
            jns_lantai = request.form.get('jns_lantai')
            jns_dinding = request.form.get('jns_dinding')
            jns_atap = request.form.get('jns_atap')
            smr_air = request.form.get('smr_air')
            smr_penerangan = request.form.get('smr_penerangan')
            bb_memasak = request.form.get('bb_memasak')
            jns_kloset = request.form.get('jns_kloset')
            jns_kendaraan = request.form.get('jns_kendaraan')
            aset_pribadi = request.form.get('aset_pribadi')
            tlpn_rumah = request.form.get('tlpn_rumah')
            wifi = request.form.get('wifi')
            statusAwal = request.form.get('statusAwal')

            if sts_bangunan or sts_bangunan or jns_lantai or jns_dinding or jns_atap or smr_air or smr_penerangan or bb_memasak or jns_kloset or jns_kendaraan or aset_pribadi or tlpn_rumah or wifi:
                query = """
                    INSERT INTO penerimapkh (id_penerima, id_admin, nama, alamat, sts_lahan, sts_bangunan, jns_lantai, jns_dinding, jns_atap, smr_air, smr_penerangan, bb_memasak, jns_kloset, jns_kendaraan, aset_pribadi, tlpn_rumah, wifi, statusAwal)
                    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                    """
                cursor.execute(query, (id_penerima, id_admin, nama, alamat, sts_lahan, sts_bangunan, jns_lantai, jns_dinding, jns_atap,
                                       smr_air, smr_penerangan, bb_memasak, jns_kloset, jns_kendaraan, aset_pribadi, tlpn_rumah, wifi, statusAwal))

                db.commit()

                flash('Data berhasil ditambahkan!', 'success')
                return redirect(url_for('penerimapkh'))

            else:
                flash('Kriteria penerima tidak boleh kosong!', 'error')
                return redirect(url_for('penerimapkh'))

    return render_template('penerimapkh.php')


@app.route('/update_penerima_pkh', methods=['POST'])
def update_penerima_pkh():

    if 'id_admin' in session:
        id_admin = session['id_admin']

        if request.method == 'POST':
            id_penerima = request.form.get('id_penerima_edit')
            nama = request.form.get('nama_edit')
            alamat = request.form.get('alamat_edit')
            sts_lahan = request.form.get('sts_lahan_edit')
            sts_bangunan = request.form.get('sts_bangunan_edit')
            jns_lantai = request.form.get('jns_lantai_edit')
            jns_dinding = request.form.get('jns_dinding_edit')
            jns_atap = request.form.get('jns_atap_edit')
            smr_air = request.form.get('smr_air_edit')
            smr_penerangan = request.form.get('smr_penerangan_edit')
            bb_memasak = request.form.get('bb_memasak_edit')
            jns_kloset = request.form.get('jns_kloset_edit')
            jns_kendaraan = request.form.get('jns_kendaraan_edit')
            aset_pribadi = request.form.get('aset_pribadi_edit')
            tlpn_rumah = request.form.get('tlpn_rumah_edit')
            wifi = request.form.get('wifi_edit')
            statusAwal = request.form.get('statusAwal_edit')

            if sts_bangunan or sts_bangunan or jns_lantai or jns_dinding or jns_atap or smr_air or smr_penerangan or bb_memasak or jns_kloset or jns_kendaraan or aset_pribadi or tlpn_rumah or wifi:

                query = """UPDATE penerimapkh SET \
                    nama=%s, \
                    alamat=%s, \
                    sts_lahan=%s, \
                    sts_bangunan=%s, \
                    jns_lantai=%s, \
                    jns_dinding=%s, \
                    jns_atap=%s, \
                    smr_air=%s, \
                    smr_penerangan=%s, \
                    bb_memasak=%s, \
                    jns_kloset=%s, \
                    jns_kendaraan=%s, \
                    aset_pribadi=%s, \
                    tlpn_rumah=%s, \
                    wifi=%s, \
                    statusAwal=%s \
                    WHERE id_penerima=%s"""

                cursor.execute(query, (nama, alamat, sts_lahan, sts_bangunan, jns_lantai, jns_dinding, jns_atap,
                                       smr_air, smr_penerangan, bb_memasak, jns_kloset, jns_kendaraan, aset_pribadi, tlpn_rumah, wifi, statusAwal, id_penerima))
                db.commit()

                flash('Data berhasil diubah!', 'success')
                return redirect(url_for('penerimapkh'))

            else:
                flash('Kriteria penerima tidak boleh kosong!', 'error')
                return redirect(url_for('penerimapkh'))

    return render_template('penerimapkh.php')


@app.route('/delete_penerima_pkh', methods=['POST'])
def delete_penerima_pkh():

    if request.method == 'POST':
        id_penerima = request.form['id_data_hapus']

        query = "DELETE FROM penerimapkh WHERE id_penerima=%s"

        try:
            cursor.execute(query, (id_penerima, ))
            db.commit()
            flash('Data berhasil dihapus!', 'success')
        except Exception as e:
            db.rollback()
            flash('Terjadi kesalahan: ' + str(e), 'error')

        return redirect(url_for('penerimapkh'))

    return render_template('penerimapkh.php')

############################################################################### MENU KLASIFIKASI ###############################################################################


@app.route('/klasifikasi')
def klasifikasi():
    if 'id_admin' in session:
        id_admin = session['id_admin']
        cursor = db.cursor()

        # Query untuk mengambil data dari tabel yang sesuai dengan id_admin yang sedang login
        query_pkh = "SELECT * FROM penerimapkh WHERE id_admin=%s"
        cursor.execute(query_pkh, (id_admin,))
        data = cursor.fetchall()

        return render_template('klasifikasi.php', data=data, nama_admin=session['username'])


@app.route('/all_klasifikasi', methods=['GET'])
def all_klasifikasi():

    # load trained model
    try:
        with open('model_perceptron.pkl', 'rb') as file:
            data = pickle.load(file)
            loaded_model = data['model']
    except FileNotFoundError:
        flash('Model tidak tersedia. Mohon latih model terlebih dahulu.', 'error')
        return redirect(url_for('menu_latih_data'))

    if 'id_admin' in session:
        id_admin = session['id_admin']

        if request.method == 'GET':
            # Konversi data input
            data_maps = {
                "sts_lahan": {"Pribadi": 1, "Warisan": 2, "Negara": 3},
                "sts_bangunan": {"Pribadi": 1, "Warisan": 2, "Umum": 3},
                "jns_lantai": {"Teraso": 1, "Keramik": 2, "Vinyl": 3, "Semen": 4},
                "jns_dinding": {"Hebel": 1, "Batako": 2, "Bata Merah": 3, "GRC": 4, "Kayu": 5},
                "jns_atap": {"Tanah Liat": 1, "Asbes": 2, "Seng": 3},
                "smr_air": {"PDAM": 1, "Sanyo": 2, "Sumur": 3},
                "smr_penerangan": {"Listrik": 1, "Lainnya": 2},
                "bb_memasak": {"Gas": 1, "Kompor Minyak": 2, "Tungku": 3},
                "jns_kloset": {"Kloset Duduk": 1, "Kloset Jongkok": 2},
                "jns_kendaraan": {"Mobil": 1, "Motor": 2, "Sepeda": 3, "Angkutan Umum": 4},
                "aset_pribadi": {"Tanah": 1, "Sawah": 2, "Rumah": 3, "Tidak Ada": 4},
                "tlpn_rumah": {"Ya": 1, "Tidak": 2},
                "wifi": {"Ya": 1, "Tidak": 2}
            }

            # Mengambil semua data penerima yang akan diproses
            query = f"""SELECT * FROM penerimapkh WHERE id_admin = '{id_admin}'"""

            cursor.execute(query)
            all_data = cursor.fetchall()
            db.commit()

            # Hasil Klasifikasi
            hasil_klasifikasi = []

            # Membuat indeks kolom
            column_index = {desc[0]: i for i,
                            desc in enumerate(cursor.description)}

            for data_point in all_data:
                id_penerima, nama, statusAwal = data_point[0], data_point[2], data_point[17]
                input_data = []

                for key, value in data_maps.items():
                    if key in column_index:
                        input_data.append(
                            value.get(data_point[column_index[key]], None))
                    else:
                        input_data.append(None)

                # nilai minimum kriteria
                n_min = np.array([[1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]])
                # nilai maksimum kriteria
                n_max = np.array([[3, 3, 4, 5, 3, 3, 2, 3, 2, 4, 4, 2, 2]])
                # menggabungkan nilai array
                bobot = np.append(n_min, n_max, axis=0)
                # nilai input
                n_input = np.array([input_data])
                # perhitungan nilai bobot
                n_dim = np.append(bobot, n_input, axis=0)

                # Skala data
                hasil_input = MinMaxScaler().fit_transform(n_dim)

                classification = loaded_model.predict(hasil_input[[2]])

                if len(classification) > 0:
                    # Mengambil kelas mayoritas atau kelas dengan probabilitas tertinggi
                    predicted_class = int(classification[0])

                    if predicted_class == 0:
                        statusPKH = 'Tidak Layak'
                    elif predicted_class == 1:
                        statusPKH = 'Layak'
                else:
                    statusPKH = 'Label tidak dikenali'

                hasil_klasifikasi.append(
                    (id_penerima, nama, statusAwal, statusPKH))

            # Memasukkan data ke dalam tabel database
            for result in hasil_klasifikasi:
                id_penerima, nama, statusAwal, statusPKH = result

                query = f"""
                    INSERT INTO hasilklasifikasi (id_penerima, nama, statusAwal, statusPKH)
                    VALUES ('{id_penerima}', '{nama}', '{statusAwal}', '{statusPKH}')
                """

                try:
                    cursor.execute(query)
                    db.commit()
                    flash('Seluruh data berhasil diklasifikasikan', 'success')
                except Exception as e:
                    flash('Terjadi kesalahan: ' + str(e), 'error')

            return redirect(url_for('hasilklasifikasi'))

    return redirect(url_for('klasifikasi'))


@app.route('/klasifikasipkh', methods=['POST'])
def klasifikasipkh():

    # load trained model
    try:
        with open('model_perceptron.pkl', 'rb') as file:
            data = pickle.load(file)
            loaded_model = data['model']
    except FileNotFoundError:
        flash('Model tidak tersedia. Mohon latih model terlebih dahulu.', 'error')
        return redirect(url_for('menu_latih_data'))

    if request.method == 'POST':
        # Konversi data input
        data_maps = {
            "StatusLahan": {"Pribadi": 1, "Warisan": 2, "Negara": 3},
            "StatusBangunan": {"Pribadi": 1, "Warisan": 2, "Umum": 3},
            "JenisLantai": {"Teraso": 1, "Keramik": 2, "Vinyl": 3, "Semen": 4},
            "JenisDinding": {"Hebel": 1, "Batako": 2, "Bata Merah": 3, "GRC": 4, "Kayu": 5},
            "JenisAtap": {"Tanah Liat": 1, "Asbes": 2, "Seng": 3},
            "SumberAir": {"PDAM": 1, "Sanyo": 2, "Sumur": 3},
            "SumberPenerangan": {"Listrik": 1, "Lainnya": 2},
            "BahanBakuMemasak": {"Gas": 1, "Kompor Minyak": 2, "Tungku": 3},
            "JenisKloset": {"Kloset Duduk": 1, "Kloset Jongkok": 2},
            "JenisKendaraan": {"Mobil": 1, "Motor": 2, "Sepeda": 3, "Angkutan Umum": 4},
            "AsetPribadi": {"Tanah": 1, "Sawah": 2, "Rumah": 3, "Tidak Ada": 4},
            "TelponRumah": {"Ya": 1, "Tidak": 2},
            "Wifi": {"Ya": 1, "Tidak": 2}
        }

        id_data_klasifikasi = request.form.get('id_data_klasifikasi')
        klasifikasi_penerima = request.form.get('klasifikasi_penerima')
        statusAwal = request.form.get('statusPKH')

        # Membuat array kosong untuk menampung nilai hasil konversi
        input_data = []

        # mengkonversi nilai input sesuai data mapping
        for key, value in request.form.items():
            if key in data_maps:
                input_data.append(data_maps[key][value])

        # nilai minimum kriteria
        n_min = np.array([[1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]])
        # nilai maksimum kriteria
        n_max = np.array([[3, 3, 4, 5, 3, 3, 2, 3, 2, 4, 4, 2, 2]])
        # menggabungkan nilai array
        bobot = np.append(n_min, n_max, axis=0)
        # nilai input
        n_input = np.array([input_data])

        n_dim = np.append(bobot, n_input, axis=0)

        # Skala data
        hasil_input = MinMaxScaler().fit_transform(n_dim)

        # Melakukan prediksi menggunakan model klasifikasi
        classification = loaded_model.predict(hasil_input[[2]])

        if classification[0] == 0:
            hasil_klasifikasi = 'Tidak Layak'
        elif classification[0] == 1:
            hasil_klasifikasi = 'Layak'
        else:
            hasil_klasifikasi = 'Label tidak dikenali'

        # Memasukkan data ke dalam tabel di database
        query = "INSERT INTO hasilklasifikasi (id_penerima, nama, statusAwal, statusPKH) VALUES (%s, %s, %s, %s)"
        values = (id_data_klasifikasi, klasifikasi_penerima,
                  statusAwal, hasil_klasifikasi)

        try:
            cursor.execute(query, values)
            db.commit()
            flash('Data berhasil diklasifikasikan', 'success')

        except Exception as e:
            db.rollback()
            flash('Terjadi kesalahan: ' + str(e), 'error')

        return redirect(url_for('hasilklasifikasi'))

    return redirect(url_for('klasifikasi'))

############################################################################### MENU HASIL KLASIFIKASI ###############################################################################


@app.route('/hasilklasifikasi')
def hasilklasifikasi():

    if 'id_admin' in session:
        id_admin = session['id_admin']

        # Query untuk mengambil data dari tabel hasilklasifikasi dan menggabungkannya dengan tabel admin
        query_hasil = f"""
            SELECT hasilklasifikasi.*, admin.username AS nama_admin
            FROM hasilklasifikasi
            INNER JOIN penerimapkh ON hasilklasifikasi.id_penerima = penerimapkh.id_penerima
            INNER JOIN admin ON penerimapkh.id_admin = admin.id_admin
            WHERE admin.id_admin = '{id_admin}'
        """
        cursor.execute(query_hasil)
        data = cursor.fetchall()

        return render_template('hasilklasifikasi.php', data=data, nama_admin=session['username'])

    else:
        # Redirect to login page or another appropriate action
        return redirect(url_for('dashboard'))


@app.route('/delete_hasil_klasifikasi', methods=['POST'])
def delete_hasil_klasifikasi():

    if request.method == 'POST':
        id_klasifikasi = request.form.get('id_klasifikasi')

        query = f"DELETE FROM hasilklasifikasi WHERE id_klasifikasi='{id_klasifikasi}'"

        cursor = db.cursor()

        try:
            cursor.execute(query)
            db.commit()
            flash('Data berhasil dihapus!', 'success')

        except Exception as e:
            db.rollback()
            flash('Terjadi kesalahan: ' + str(e), 'error')

        return redirect(url_for('hasilklasifikasi'))

    return render_template('hasilklasifikasi.php')


@app.route('/cetak_data')
def cetak_data():

    if 'id_admin' in session:
        id_admin = session['id_admin']

        cursor = db.cursor()

        # Query untuk mengambil data dari tabel hasilklasifikasi dan menggabungkannya dengan tabel admin
        query_pkh = f"""
            SELECT hasilklasifikasi.*, admin.username AS nama_admin
            FROM hasilklasifikasi
            INNER JOIN penerimapkh ON hasilklasifikasi.id_penerima = penerimapkh.id_penerima
            INNER JOIN admin ON penerimapkh.id_admin = admin.id_admin
            WHERE admin.id_admin = '{id_admin}'
        """

        cursor.execute(query_pkh)
        data = cursor.fetchall()

    return render_template('cetak.php', data=data)


@app.route('/all_hapus', methods=['GET'])
def all_hapus():
    if 'id_admin' in session:
        id_admin = session['id_admin']

        if request.method == 'GET':

            query_deleteAll = f"DELETE FROM hasilklasifikasi WHERE id_penerima IN (SELECT id_penerima FROM penerimapkh WHERE id_admin = '{id_admin}')"

            try:
                cursor.execute(query_deleteAll)
                db.commit()
                flash('Seluruh data berhasil dihapus!', 'success')

            except Exception as e:
                db.rollback()
                flash('Terjadi kesalahan: ' + str(e), 'error')

            return redirect(url_for('hasilklasifikasi'))

    return render_template('hasilklasifikasi.php')

############################################################################### MENU LOGOUT ###############################################################################


@app.route('/logout')
def logout():
    # Hapus session admin
    if 'id_admin' in session:
        session.pop('id_admin', None)
        session.pop('username', None)
        session.pop('password', None)

        session.clear()

    return render_template('login.php')


if __name__ == "__main__":
    
    app.run(debug=True)
