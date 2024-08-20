# Instal Library
from sklearn.preprocessing import StandardScaler, MinMaxScaler
from sklearn.base import BaseEstimator, ClassifierMixin
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
from flask import session

import numpy as np
import pandas as pd
import pickle

# # Baca Data
# df = pd.read_csv("origin_data.csv")

# # Menentukan Kolom Fitur dan Label
# df_n = df.iloc[:, 4:]

# # Prepocessing Mapping Fitur -> ordinal ke numerik
# features = df_n.columns
# data_maps = {
#     "StatusLahan": {"Pribadi": 1, "Warisan": 2, "Negara": 3},
#     "StatusBangunan": {"Pribadi": 1, "Warisan": 2, "Umum": 3},
#     "JenisLantai": {"Teraso": 1, "Keramik": 2, "Vinyl": 3, "Semen": 4},
#     "JenisDinding": {"Hebel": 1, "Batako": 2, "Bata Merah": 3, "GRC": 4, "Kayu": 5},
#     "JenisAtap": {"Tanah Liat": 1, "Asbes": 2, "Seng": 3},
#     "SumberAir": {"PDAM": 1, "Sanyo": 2, "Sumur": 3},
#     "SumberPenerangan": {"Listrik": 1, "Lainnya": 2},
#     "BahanBakuMemasak": {"Gas": 1, "Kompor Minyak": 2, "Tungku": 3},
#     "JenisKloset": {"Kloset Duduk": 1, "Kloset Jongkok": 2},
#     "JenisKendaraan": {"Mobil": 1, "Motor": 2, "Sepeda": 3, "Angkutan Umum": 4},
#     "AsetPribadi": {"Tanah": 1, "Sawah": 2, "Rumah": 3, "Tidak Ada": 4},
#     "TelponRumah": {"Ya": 1, "Tidak": 2},
#     "Wifi": {"Ya": 1, "Tidak": 2}
# }

# for col in features[:-1]:
#     df_n[col] = df_n[col].replace(data_maps[col])

# # Split Data Train dan Test
# x, y = df_n.iloc[:, :-1], df_n.iloc[:, -1:]
# x_train, x_test, y_train, y_test = train_test_split(
#     x, y, train_size=0.3, random_state=42)

# # Mengubah dataset ke format numpy array
# x_train = x_train.values
# x_test = x_test.values
# y_train = y_train.values.flatten()
# y_test = y_test.values.flatten()

# # Normalisasi data
# scaler = MinMaxScaler()
# x_train = scaler.fit_transform(x_train)
# x_test = scaler.transform(x_test)

## ========================================== Perceptron Manual Code ====================================== ##


class PerceptronManual(BaseEstimator, ClassifierMixin):
    def __init__(self, learning_rate, num_epochs, activation_function='relu', regularization=None, alpha=0.01):
        self.learning_rate = learning_rate
        self.num_epochs = num_epochs
        self.activation_function = activation_function
        self.regularization = regularization
        self.alpha = alpha
        self.weights = None
        self.bias = None

    def fit(self, x_train, y_train):
        num_samples, num_features = x_train.shape
        self.weights = np.zeros(num_features)
        self.bias = np.random.randn()

        session['epoch_data'] = []

        for epoch in range(self.num_epochs):
            for i in range(num_samples):
                z = np.dot(x_train[i], self.weights) + self.bias
                y_pred = self.activate(z)
                error = int(y_train[i]) - y_pred

                # Update weights and bias
                self.weights += self.learning_rate * error * x_train[i]

                if self.regularization == 'l1':
                    self.weights -= self.alpha * np.sign(self.weights)
                elif self.regularization == 'l2':
                    self.weights -= self.alpha * self.weights

                self.bias += self.learning_rate * error

            # Simpan nilai epoch, bobot, dan bias ke dalam sesi
                if i == 0 and epoch % 1 == 0:
                    epoch_data = {
                        'epoch': epoch + 1,
                        'weights': self.weights.tolist(),
                        'bias': self.bias.tolist()
                    }
                    session['epoch_data'].append(epoch_data)

            # print(f"Epoch : {epoch + 1}")
            # print(f"Weights : {self.weights}")
            # print(f"Bias : {self.bias}")

    def predict(self, x_test):
        num_samples = x_test.shape[0]
        y_pred = np.zeros(num_samples, dtype=int)
        for i in range(num_samples):
            z = np.dot(x_test[i], self.weights) + self.bias
            y_pred[i] = self.activate(z)
        return y_pred

    def activate(self, z):
        if self.activation_function == 'relu':
            return np.maximum(0, z)
        elif self.activation_function == 'sigmoid':
            return 1 / (1 + np.exp(-z))
        else:
            return 1 if z >= 0 else 0
