<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>INFORMASI</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <!-- Display Confusion Matrix -->
    <h3>Confusion Matrix</h3>
    <table border="1">
        {% for row in session['confusion_matrix'] %}
        <tr>
            {% for cell in row %}
            <td>{{ cell }}</td>
            {% endfor %}
        </tr>
        {% endfor %}
    </table>

    <!-- Display Final Weights -->
    <h3>Bobot Akhir</h3>
    <table border="1">
        <tr>
            <th>Fitur</th>
            <th>Bobot</th>
        </tr>
        {% for feature, weight in session['bobot_hasil'] %}
        <tr>
            <td>{{ feature }}</td>
            <td>{{ weight }}</td>
        </tr>
        {% endfor %}
    </table>

    <!-- Display Weights and Bias for Each Epoch -->
    <h2>Epoch, Bobot, dan Bias</h2>
    <ul>
        {% for data in epoch_data %}
        <li>
            <p>Epoch: {{ data['epoch'] }}</p>
            <p>Weights: {{ data['weights'] }}</p>
            <p>Bias: {{ data['bias'] }}</p>
        </li>
        {% endfor %}
    </ul>
</body>

</html>