<!DOCTYPE html>
<html>

<head>
    <title>Modifier élève</title>
</head>

<body style="font-family:Arial; text-align:center; padding:50px; background:#f0f4ff;">
    <h2>✏️ Modifier {{ $eleve->nom }}</h2>
    <form method="POST" action="/ecole/modifier/{{ $eleve->id }}"
        style="background:white; padding:20px; border-radius:15px; display:inline-block;">
        @csrf
        <input type="text" name="nom" value="{{ $eleve->nom }}"
            style="padding:10px; border-radius:8px; border:1px solid #ccc;">
        <button type="submit"
            style="background:#2563eb; color:white; border:none; padding:10px 20px; border-radius:8px; font-weight:bold; cursor:pointer;">Enregistrer</button>
    </form>
    <br><br>
    <a href="/ecole">⬅ Retour</a>
</body>

</html>
