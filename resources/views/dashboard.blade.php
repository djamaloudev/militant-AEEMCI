<!DOCTYPE html>
<html>

<head>
    <title>Tableau de bord</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="font-family:Arial; background:#f0f4ff; padding:20px; text-align:center;">
    <h1>📊 Tableau de bord PRO</h1>
    <a href="/militants">⬅ Retour aux militants</a>
    <div style="display:flex; gap:20px; justify-content:center; flex-wrap:wrap; margin-top:20px;">
        <div style="background:white; padding:20px; border-radius:15px; width:350px;">
            <h3>Par Sexe</h3><canvas id="sexe"></canvas>
        </div>
        <div style="background:white; padding:20px; border-radius:15px; width:350px;">
            <h3>Par Statut</h3><canvas id="statut"></canvas>
        </div>
        <div style="background:white; padding:20px; border-radius:15px; width:350px;">
            <h3>Par Niveau</h3><canvas id="niveau"></canvas>
        </div>
        <div style="background:white; padding:20px; border-radius:15px; width:350px;">
            <h3>Par Section</h3><canvas id="section"></canvas>
        </div>
    </div>
    <script>
        new Chart(document.getElementById('sexe'), {
            type: 'doughnut',
            data: {
                labels: ['Hommes', 'Femmes'],
                datasets: [{
                    data: [{{ $hommes }}, {{ $femmes }}],
                    backgroundColor: ['#2563eb', '#ec4899']
                }]
            }
        });
        new Chart(document.getElementById('statut'), {
            type: 'bar',
            data: {
                labels: ['Actif', 'Inactif', 'Radié'],
                datasets: [{
                    label: 'Militants',
                    data: [{{ $actifs }}, {{ $inactifs }}, {{ $radies }}],
                    backgroundColor: ['#059669', '#f59e0b', '#ef4444']
                }]
            }
        });
        new Chart(document.getElementById('niveau'), {
            type: 'pie',
            data: {
                labels: ['Primaire', 'Secondaire', 'Supérieur'],
                datasets: [{
                    data: [{{ $primaire }}, {{ $secondaire }}, {{ $superieur }}],
                    backgroundColor: ['#f59e0b', '#2563eb', '#059669']
                }]
            }
        });
        new Chart(document.getElementById('section'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($sectionsLabels) !!},
                datasets: [{
                    label: 'Par Section',
                    data: {!! json_encode($sectionsData) !!},
                    backgroundColor: '#2563eb'
                }]
            }
        });
    </script>
</body>

</html>

