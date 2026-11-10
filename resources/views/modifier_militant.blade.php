<!DOCTYPE html>
<html>

<head>
    <title>Modifier {{ $m->matricule }}</title>
</head>

<body style="font-family:Arial; background:#f0f4ff; padding:20px; text-align:center;">
    <h1>✏️ Modifier {{ $m->prenom }} {{ $m->nom }}</h1>
    <p
        style="background:#2563eb; color:white; display:inline-block; padding:5px 15px; border-radius:20px; font-weight:bold;">
        {{ $m->matricule }} - NE PEUT PAS CHANGER</p>

    <form method="POST" action="/militants/{{ $m->id }}/modifier" enctype="multipart/form-data"
        style="background:white; padding:20px; border-radius:15px; display:inline-block; text-align:left; max-width:500px; width:100%; margin-top:15px;">
        @csrf
        <label>Photo :</label><br>
        <input type="file" name="photo" accept="image/*" style="width:100%; padding:10px; margin:5px 0;">
        @if ($m->photo)
            <img src="/{{ $m->photo }}" style="width:80px; height:80px; object-fit:cover; border-radius:50%;">
        @endif
        <br><br>

        <input type="text" name="nom" value="{{ $m->nom }}"
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="prenom" value="{{ $m->prenom }}"
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="telephone" value="{{ $m->telephone }}"
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="localite" value="{{ $m->localite }}"
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="etablissement" value="{{ $m->etablissement }}"
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">
        <input type="text" name="section" value="{{ $m->section }}"
            style="width:100%; padding:10px; margin:5px 0; border-radius:8px; border:1px solid #ccc;">

        <div style="display:flex; gap:10px;">
            <select name="sexe" style="flex:1; padding:10px; border-radius:8px;">
                <option value="Homme" {{ $m->sexe == 'Homme' ? 'selected' : '' }}>Homme</option>
                <option value="Femme" {{ $m->sexe == 'Femme' ? 'selected' : '' }}>Femme</option>
            </select>
            <select name="niveau_etude" style="flex:1; padding:10px; border-radius:8px;">
                <option value="primaire" {{ $m->niveau_etude == 'primaire' ? 'selected' : '' }}>Primaire</option>
                <option value="secondaire" {{ $m->niveau_etude == 'secondaire' ? 'selected' : '' }}>Secondaire</option>
                <option value="supérieur" {{ $m->niveau_etude == 'supérieur' ? 'selected' : '' }}>Supérieur</option>
            </select>
        </div>
        <div style="display:flex; gap:10px; margin-top:5px;">
            <select name="statut" style="flex:1; padding:10px; border-radius:8px;">
                <option value="actif" {{ $m->statut == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ $m->statut == 'inactif' ? 'selected' : '' }}>Inactif</option>
                <option value="radié" {{ $m->statut == 'radié' ? 'selected' : '' }}>Radié</option>
            </select>
            <input type="number" name="annee_adhesion" value="{{ $m->annee_adhesion }}"
                style="flex:1; padding:10px; border-radius:8px; border:1px solid #ccc;">
        </div>
        <button
            style="width:100%; margin-top:15px; background:#059669; color:white; border:none; padding:12px; border-radius:10px; font-weight:bold; cursor:pointer;">💾
            Enregistrer les modifications</button>
    </form><br><br><a href="/militants">⬅ Retour</a>
</body>

</html>
