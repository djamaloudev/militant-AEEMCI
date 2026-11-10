<!DOCTYPE html>
<html>

<head>
    <title>Fiche {{ $m->matricule }}</title>
    <style>
        body {
            font-family: Arial;
            background: #e5e7eb;
            padding: 20px;
            text-align: center;
        }

        .carte {
            background: white;
            max-width: 550px;
            margin: auto;
            padding: 25px;
            border-radius: 15px;
            text-align: left;
            border: 3px solid #2563eb;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                background: white;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="carte">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h2 style="margin:0; color:#2563eb;">FICHE MEMBRE</h2><small>Gestion des Militants</small>
            </div>
            <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ $m->matricule }}-{{ $m->nom }}-{{ $m->prenom }}">
        </div>
        <hr>
        @if ($m->photo)
            <img src="/{{ $m->photo }}"
                style="width:100px; height:100px; object-fit:cover; border-radius:50%; border:2px solid #2563eb;">
        @else
            <div
                style="width:100px; height:100px; background:#dbeafe; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:40px;">
                👤</div>
        @endif
        <h3>{{ $m->prenom }} {{ $m->nom }}</h3>
        <span
            style="background:#2563eb; color:white; padding:5px 12px; border-radius:20px; font-weight:bold;">{{ $m->matricule }}</span><br><br>
        <p>📞 <b>Téléphone :</b> {{ $m->telephone }}<br>
            📍 <b>Localité :</b> {{ $m->localite }}<br>
            🏫 <b>Établissement :</b> {{ $m->etablissement }}<br>
            📌 <b>Section :</b> {{ $m->section }}<br>
            👤 <b>Sexe :</b> {{ $m->sexe }} | 🎓 <b>Niveau :</b> {{ $m->niveau_etude }}<br>
            📅 <b>Année :</b> {{ $m->annee_adhesion }} | Statut : <b>{{ $m->statut }}</b></p>
    </div>
    <div class="no-print" style="margin-top:15px;">
        <button onclick="window.print()"
            style="background:#2563eb; color:white; border:none; padding:12px 25px; border-radius:10px; font-weight:bold; cursor:pointer;">🖨️
            Imprimer / Enregistrer en PDF</button><br><br>
        <a href="/militants">⬅ Retour</a>
    </div>
</body>

</html>
