<!DOCTYPE html>
<html>

<head>
    <title>Militants</title>
</head>

<body style="font-family:Arial; background:#f0f4ff; padding:20px; text-align:center;">
    <h1>🎓 Gestion des Militants</h1>
    <a href="/dashboard"
        style="background:#7c3aed; color:white; padding:10px 18px; border-radius:10px; text-decoration:none; font-weight:bold;">📊
        Tableau de bord</a>
    <a href="/militants/export"
        style="background:#059669; color:white; padding:10px 18px; border-radius:10px; text-decoration:none; font-weight:bold;">📥
        Exporter en Excel</a>
    <div style="display:flex; justify-content:center; gap:10px; flex-wrap:wrap; margin:15px 0;">
        <div style="background:#2563eb; color:white; padding:15px; border-radius:12px; min-width:120px;"><b
                style="font-size:22px;">{{ $total }}</b><br>Total militants</div>
        <div style="background:#059669; color:white; padding:15px; border-radius:12px; min-width:120px;"><b
                style="font-size:22px;">{{ $hommes }}</b><br>Hommes</div>
        <div style="background:#db2777; color:white; padding:15px; border-radius:12px; min-width:120px;"><b
                style="font-size:22px;">{{ $femmes }}</b><br>Femmes</div>
        <div style="background:#f59e0b; color:white; padding:15px; border-radius:12px; min-width:120px;"><b
                style="font-size:22px;">{{ $actifs }}</b><br>Actifs</div>
    </div>

    <form method="GET" action="/militants"
        style="background:white; padding:15px; border-radius:15px; display:inline-block; max-width:600px; width:100%;">
        <input type="text" name="recherche" value="{{ request('recherche') }}"
            placeholder="🔍 Nom, prénom, matricule, téléphone, localité..."
            style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; margin-bottom:8px;">
        <div style="display:flex; gap:8px; flex-wrap:wrap;">
            <select name="sexe" style="flex:1; padding:8px; border-radius:8px;">
                <option value="">Tous sexes</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
            <select name="niveau_etude" style="flex:1; padding:8px; border-radius:8px;">
                <option value="">Tous niveaux</option>
                <option value="primaire">Primaire</option>
                <option value="secondaire">Secondaire</option>
                <option value="supérieur">Supérieur</option>
            </select>
            <select name="statut" style="flex:1; padding:8px; border-radius:8px;">
                <option value="">Tous statuts</option>
                <option value="actif">Actif</option>
                <option value="inactif">Inactif</option>
                <option value="radié">Radié</option>
            </select>
        </div>
        <div style="display:flex; gap:8px; margin-top:8px;">
            <input type="text" name="section" value="{{ request('section') }}" placeholder="Section ex: Danané"
                style="flex:1; padding:8px; border-radius:8px; border:1px solid #ccc;">
            <input type="number" name="annee_adhesion" value="{{ request('annee_adhesion') }}"
                placeholder="Année ex: 2026" style="flex:1; padding:8px; border-radius:8px; border:1px solid #ccc;">
            <button
                style="background:#059669; color:white; border:none; padding:8px 15px; border-radius:8px; font-weight:bold; cursor:pointer;">Filtrer</button>
            <a href="/militants"
                style="background:#e5e7eb; padding:8px 12px; border-radius:8px; text-decoration:none; color:black; font-weight:bold;">Reset</a>
        </div>
    </form>
    <p>Il y a {{ count($militants) }} militants</p>

    <form method="POST" action="/militants/ajouter" enctype="multipart/form-data"
        style="background:white; padding:20px; border-radius:15px; display:inline-block; text-align:left; max-width:500px; width:100%;">
        @csrf
        <input type="text" name="nom" placeholder="Nom *" required
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="prenom" placeholder="Prénom *" required
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="telephone" placeholder="Téléphone"
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="localite" placeholder="Localité"
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="etablissement" placeholder="Établissement"
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="section" placeholder="Section ex: Danané"
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <div style="display:flex; gap:10px;">
            <select name="sexe" style="flex:1; padding:10px; border-radius:8px;">
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
            <select name="niveau_etude" style="flex:1; padding:10px; border-radius:8px;">
                <option value="primaire">Primaire</option>
                <option value="secondaire" selected>Secondaire</option>
                <option value="supérieur">Supérieur</option>
            </select>
        </div>
        <div style="display:flex; gap:10px; margin-top:5px;">
            <select name="statut" style="flex:1; padding:10px; border-radius:8px;">
                <option value="actif">Actif</option>
                <option value="inactif">Inactif</option>
                <option value="radié">Radié</option>
            </select>
            <input type="number" name="annee_adhesion" value="2026"
                style="flex:1; padding:10px; border-radius:8px; border:1px solid #ccc;">
        </div>
        <label style="font-weight:bold;">Photo du militant 📸</label><br>
        <input type="file" name="photo" accept="image/*"
            style="padding:10px; background:white; border-radius:10px; width:100%; margin-bottom:10px;"><br>
        <button
            style="width:100%; margin-top:15px; background:#2563eb; color:white; border:none; padding:12px; border-radius:10px; font-weight:bold; cursor:pointer;">➕
            Enregistrer Militant</button>
    </form>

    <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:15px; margin-top:25px;">
        @foreach ($militants as $m)
            <div style="background:white; padding:15px; border-radius:15px; width:260px; text-align:left;">
                @if ($m->photo)
                    <img src="{{ asset($m->photo) }}"
                        style="width:100%; height:180px; object-fit:cover; border-radius:10px; margin-bottom:10px;">
                @endif
                <b>{{ $m->prenom }} {{ $m->nom }}</b><br>
                <span
                    style="background:#dbeafe; padding:3px 8px; border-radius:20px; font-size:12px; font-weight:bold;">{{ $m->matricule }}</span><br>
                <small>📞 {{ $m->telephone }}<br>📍 {{ $m->localite }} - {{ $m->section }}<br>🏫
                    {{ $m->etablissement }}<br>{{ $m->sexe }} | {{ $m->niveau_etude }} | {{ $m->statut }} |
                    {{ $m->annee_adhesion }}</small>
                <form method="POST" action="/militants/supprimer/{{ $m->id }}" style="margin-top:10px;">
                    <a href="/militants/{{ $m->id }}/modifier"
                        style="background:#f59e0b; color:white; padding:6px 12px; border-radius:8px; text-decoration:none; font-weight:bold; display:inline-block; margin-right:5px;">✏️
                        Modifier</a>
                    <a href="/militants/{{ $m->id }}/fiche"
                        style="background:#2563eb; color:white; padding:6px 12px; border-radius:8px; text-decoration:none; font-weight:bold; display:inline-block; margin-right:5px;">🖨️
                        Fiche PDF</a>
                    @csrf<button
                        style="background:#ef4444; color:white; border:none; padding:6px 12px; border-radius:8px; cursor:pointer;">🗑️
                        Supprimer</button>
                </form>
            </div>
        @endforeach
    </div>
</body>

</html>
