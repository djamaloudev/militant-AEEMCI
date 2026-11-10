<!DOCTYPE html>
<html>

<head>
    <title>Mon École - Djamal de Danane</title>
    <style>
        body {
            font-family: Arial;
            background: #eef2ff;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #1e3a8a;
            font-size: 32px;
        }

        .sous-titre {
            color: #555;
            margin-bottom: 30px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        .carte {
            background: white;
            width: 200px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .avatar {
            font-size: 50px;
        }

        .nom {
            font-weight: bold;
            font-size: 18px;
            margin: 10px 0 5px 0;
        }

        .classe {
            background: #dbeafe;
            color: #1e40af;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
            display: inline-block;
        }

        .footer {
            margin-top: 40px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <h1>🎓 {{ $ecole }}</h1>
    <p class="sous-titre">Bienvenue sur le site officiel de notre école - Djamal de Danane, Côte d'Ivoire</p>

    <h2>Nos élèves brillants ✨</h2>
    <p style="font-size:18px; font-weight:bold; color:#1e40af;">Il y a {{ count($eleves) }} élèves dans l'école 🎓</p>

    <form method="POST" action="/ecole/effacer" style="margin-bottom:20px;">
        @csrf
        <button type="submit" onclick="return confirm('Tu veux vraiment tout effacer ?')"
            style="background:#ef4444; color:white; border:none; padding:8px 15px; border-radius:8px; cursor:pointer; font-weight:bold;">🧹
            Tout effacer et recommencer</button>
    </form>
    <form method="GET" action="/ecole" style="margin-bottom:15px;">
        <input type="text" name="recherche" value="{{ request('recherche') }}"
            placeholder="🔍 Rechercher un élève..."
            style="padding:10px; border-radius:8px; border:1px solid #ccc; width:220px;">
        <button type="submit"
            style="background:#059669; color:white; border:none; padding:10px 15px; border-radius:8px; font-weight:bold; cursor:pointer;">Rechercher</button>
        <a href="/ecole" style="margin-left:5px; text-decoration:none; color:#2563eb; font-weight:bold;">Tout voir</a>
    </form>
    <form method="POST" action="/ecole/ajouter"
        style="margin-bottom:30px; background:white; padding:20px; border-radius:15px; display:inline-block; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        @csrf
        <input type="text" name="nom" placeholder="Nom du nouvel élève..." required
            style="padding:10px; border:1px solid #ccc; border-radius:8px; width:220px;">
        <button type="submit"
            style="padding:10px 15px; background:#1e40af; color:white; border:none; border-radius:8px; cursor:pointer; font-weight:bold;">➕
            Ajouter</button>
    </form>
    <div class="container">
        @foreach ($eleves as $eleve)
            <div class="carte">
                <div class="avatar">🧑‍🎓</div>
                <div class="nom">{{ $eleve->nom }}</div>
                <span class="classe">Classe de IDA 2</span>
                <p>⭐ Élève sérieux</p>
                <form method="POST" action="/ecole/supprimer/{{ $eleve->id }}" style="margin-top:10px;">
                    @csrf
                    <button type="submit"
                        style="background:#fee2e2; color:#b91c1c; border:none; padding:6px 12px; border-radius:8px; cursor:pointer; font-weight:bold;">🗑️
                        Supprimer</button>
                    <a href="/ecole/modifier/{{ $eleve->id }}"
                        style="background:#f59e0b; color:white; padding:6px 12px; border-radius:8px; text-decoration:none; font-weight:bold; display:inline-block; margin-bottom:5px;">✏️
                        Modifier</a>
                </form>
            </div>
        @endforeach
    </div>

    <p class="footer">Développé avec ❤️ par <b>Sylla Moctar</b> avec Laravel</p>
</body>

</html>
