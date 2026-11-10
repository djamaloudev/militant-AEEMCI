<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\Militant;

Route::get('/militants/export', function () {
    if (!Session::get('connecte')) return redirect('/login');
    $militants = Militant::all();
    $csv = "Matricule;Nom;Prenom;Telephone;Localite;Etablissement;Section;Sexe;Niveau;Statut;Annee\n";
    foreach ($militants as $m) {
        $csv .= "{$m->matricule};{$m->nom};{$m->prenom};{$m->telephone};{$m->localite};{$m->etablissement};{$m->section};{$m->sexe};{$m->niveau_etude};{$m->statut};{$m->annee_adhesion}\n";
    }
    return response($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="militants.csv"',
    ]);
});
Route::get('/ecole', function (Request $request) {
    $recherche = $request->query('recherche');
    if ($recherche) {
        $eleves = Eleve::where('nom', 'LIKE', '%' . $recherche . '%')->get();
    } else {
        $eleves = Eleve::all();
    }
    $ecole = "École de Yamoussoukro";
    return view('ecole', ['eleves' => $eleves, 'ecole' => $ecole]);
});

Route::post('/ecole/ajouter', function (Request $request) {
    Eleve::create(['nom' => $request->input('nom')]);
    return redirect('/ecole');
});

Route::post('/ecole/supprimer/{id}', function ($id) {
    Eleve::find($id)->delete();
    return redirect('/ecole');
});

Route::post('/ecole/effacer', function () {
    Eleve::query()->delete();
    return redirect('/ecole');
});
// Afficher la page pour modifier
Route::get('/ecole/modifier/{id}', function ($id) {
    $eleve = Eleve::find($id);
    return view('modifier', ['eleve' => $eleve]);
});

// Enregistrer la modification
Route::post('/ecole/modifier/{id}', function (Request $request, $id) {
    $eleve = Eleve::find($id);
    $eleve->nom = $request->input('nom');
    $eleve->save();
    return redirect('/ecole');
});


Route::get('/dashboard', function () {
    if (!Session::get('connecte')) return redirect('/login');
    return view('dashboard', [
        'hommes' => Militant::where('sexe', 'Homme')->count(),
        'femmes' => Militant::where('sexe', 'Femme')->count(),
        'actifs' => Militant::where('statut', 'actif')->count(),
        'inactifs' => Militant::where('statut', 'inactif')->count(),
        'radies' => Militant::where('statut', 'radié')->count(),
        'primaire' => Militant::where('niveau_etude', 'primaire')->count(),
        'secondaire' => Militant::where('niveau_etude', 'secondaire')->count(),
        'superieur' => Militant::where('niveau_etude', 'supérieur')->count(),
        'sectionsLabels' => Militant::select('section')->groupBy('section')->pluck('section')->toArray(),
        'sectionsData' => Militant::selectRaw('section, count(*) as total')->groupBy('section')->pluck('total')->toArray(),
    ]);
});
// Liste des militants
Route::get('/militants', function (Request $request) {
    if (!Session::get('connecte')) return redirect('/login');
    $query = Militant::query();
    // Recherche sur nom, prénom, matricule, téléphone, localité, établissement
    if ($request->recherche) {
        $r = $request->recherche;
        $query->where(function ($q) use ($r) {
            $q->where('nom', 'LIKE', "%$r%")
                ->orWhere('prenom', 'LIKE', "%$r%")
                ->orWhere('matricule', 'LIKE', "%$r%")
                ->orWhere('telephone', 'LIKE', "%$r%")
                ->orWhere('localite', 'LIKE', "%$r%")
                ->orWhere('etablissement', 'LIKE', "%$r%");
        });
    }
    if ($request->sexe) $query->where('sexe', $request->sexe);
    if ($request->niveau_etude) $query->where('niveau_etude', $request->niveau_etude);
    if ($request->statut) $query->where('statut', $request->statut);
    if ($request->section) $query->where('section', 'LIKE', "%" . $request->section . "%");
    if ($request->annee_adhesion) $query->where('annee_adhesion', $request->annee_adhesion);

    $militants = $query->orderBy('id', 'desc')->get();

    // Statistiques
    $total = Militant::count();
    $hommes = Militant::where('sexe', 'Homme')->count();
    $femmes = Militant::where('sexe', 'Femme')->count();
    $actifs = Militant::where('statut', 'actif')->count();

    return view('militants', ['militants' => $militants, 'total' => $total, 'hommes' => $hommes, 'femmes' => $femmes, 'actifs' => $actifs]);
});

// Ajouter un militant
Route::post('/militants/ajouter', function (Request $request) {
    // Gestion de la photo
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
    }
    Militant::create([
        'nom' => $request->input('nom'),
        'prenom' => $request->input('prenom'),
        'telephone' => $request->input('telephone'),
        'localite' => $request->input('localite'),
        'etablissement' => $request->input('etablissement'),
        'section' => $request->input('section'),
        'sexe' => $request->input('sexe'),
        'niveau_etude' => $request->input('niveau_etude'),
        'statut' => $request->input('statut'),
        'annee_adhesion' => $request->input('annee_adhesion'),
        'photo' => $photoPath,
    ]);
    return redirect('/militants');
});

// Supprimer
Route::post('/militants/supprimer/{id}', function ($id) {
    Militant::find($id)->delete();
    return redirect('/militants');
});
Route::get('/militants/{id}/fiche', function ($id) {
    if (!Session::get('connecte')) return redirect('/login');
    $m = Militant::findOrFail($id);
    return view('fiche', ['m' => $m]);
});

// Page Modifier
Route::get('/militants/{id}/modifier', function ($id) {
    if (!Session::get('connecte')) return redirect('/login');
    $m = Militant::findOrFail($id);
    return view('modifier_militant', ['m' => $m]);
});

// Enregistrer la modification + Photo
Route::post('/militants/{id}/modifier', function (Request $request, $id) {
    $m = Militant::findOrFail($id);

    $data = [
        'nom' => $request->input('nom'),
        'prenom' => $request->input('prenom'),
        'telephone' => $request->input('telephone'),
        'localite' => $request->input('localite'),
        'etablissement' => $request->input('etablissement'),
        'section' => $request->input('section'),
        'sexe' => $request->input('sexe'),
        'niveau_etude' => $request->input('niveau_etude'),
        'statut' => $request->input('statut'),
        'annee_adhesion' => $request->input('annee_adhesion'),
    ];

    // Si on envoie une photo
    if ($request->hasFile('photo')) {
        $nomPhoto = time() . '.' . $request->file('photo')->extension();
        $request->file('photo')->move(public_path('photos'), $nomPhoto);
        $data['photo'] = 'photos/' . $nomPhoto;
    }

    $m->update($data);
    return redirect('/militants');
});


// Page de connexion
Route::get('/login', function () {
    return '<form method="POST" action="/login" style="font-family:Arial; text-align:center; margin-top:100px;"><h1>🔒 Gestion des Militants</h1><p>Mot de passe :</p><input type="password" name="password" style="padding:12px; border-radius:10px; border:1px solid #ccc;"><br><br><button style="background:#2563eb; color:white; border:none; padding:12px 25px; border-radius:10px; font-weight:bold;">Entrer</button><input type="hidden" name="_token" value="' . csrf_token() . '"></form>';
});

Route::post('/login', function (Request $request) {
    if ($request->input('password') === 'sylla2026') {
        Session::put('connecte', true);
        return redirect('/militants');
    }
    return redirect('/login')->withErrors(['mauvais mot de passe']);
});
Route::get('/logout', function () {
    Session::forget('connecte');
    return redirect('/login');
});
