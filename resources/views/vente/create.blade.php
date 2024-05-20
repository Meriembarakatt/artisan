<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de détails de vente</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style pour le conteneur principal */
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* Espace entre le formulaire et la table */
        }

        /* Style pour le formulaire */
        .form-container {
            flex: 1;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
        }

        .btn-primary {
            margin-top: 20px;
        }

        /* Style pour le conteneur de la table */
        .table-container {
            flex: 2;
        }

        #tabledetail {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        #tabledetail th, #tabledetail td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        #tabledetail th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .actions {
            display: flex;
            justify-content: space-around;
        }

        .actions button {
            padding: 5px 10px;
        }

        .btn-primary.valider {
            margin-top: 20px;
            float: right;
        }
    </style>
</head>
<body> 
<div class="container">
    <div class="form-container">
        <h1>Ajouter une Vente</h1>
        <form id="formAjoutdetail" action="{{ route('vente.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">Date vente</label>
                <input type="date" class="form-control" id="date" name="date" required onchange="updateDetailDate()">
            </div>
            <div class="form-group">
                <label for="client_id">Client</label>
                <select class="form-control" id="client_id" name="client_id" required>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="article_id">Article</label>
                <select class="form-control" id="article_id" name="article_id" required>
                    @foreach ($articles as $article)
                        <option value="{{ $article->id }}" data-designation="{{ $article->designation }}">{{ $article->designation }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="vente_id">Date détail Vente</label>
                <input type="date" class="form-control" id="vente_id" name="vente_id" required>
            </div>
            <div class="form-group">
                <label for="qte">Quantité</label>
                <input type="text" class="form-control" id="qte" name="qte" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="text" class="form-control" id="prix" name="prix" required>
            </div>
            <button type="button" onclick="ajouterdetail()" class="btn btn-primary">Ajouter ajouterdetail</button>
        </form>
    </div>
    <div class="table-container">
        <table id="tabledetail" border="2">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Vente</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tbodydetail">
                <!-- Les lignes d'articles seront ajoutées ici dynamiquement -->
            </tbody>
        </table>
        <button type="button" onclick="validerVentes()" class="btn btn-primary">Enregistrer table</button>
        <a href="{{ route('vente.index') }}" class="btn btn-primary">Retour</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let ventes = [];
    let savedValues = {}; // Pour sauvegarder les valeurs des champs

    function saveInputValues() {
        savedValues.date = document.getElementById('date').value;
        savedValues.client_id = document.getElementById('client_id').value;
        savedValues.vente_id = document.getElementById('vente_id').value;
    }

    function restoreInputValues() {
        document.getElementById('date').value = savedValues.date;
        document.getElementById('client_id').value = savedValues.client_id;
        document.getElementById('vente_id').value = savedValues.vente_id;
    }

    function updateDetailDate() {
        var venteDate = document.getElementById('date').value;
        document.getElementById('vente_id').value = venteDate;
    }

    function ajouterdetail() {
        saveInputValues();
        var articleSelect = document.getElementById('article_id');
        var articleId = articleSelect.value;
        var articleDesignation = articleSelect.options[articleSelect.selectedIndex].getAttribute('data-designation');
        var vente = document.getElementById('vente_id').value;
        var quantite = document.getElementById('qte').value;
        var prix = document.getElementById('prix').value;

        // Créer une nouvelle ligne dans le tableau
        var tbody = document.getElementById('tbodydetail');
        var newRow = tbody.insertRow();

        // Insérer les cellules dans la nouvelle ligne
        var cellArticle = newRow.insertCell();
        cellArticle.innerText = articleDesignation;

        var cellVente = newRow.insertCell();
        cellVente.innerText = vente;

        var cellQuantite = newRow.insertCell();
        cellQuantite.innerText = quantite;

        var cellPrix = newRow.insertCell();
        cellPrix.innerText = prix;

        ventes.push({
            article_id: articleId,
            article_designation: articleDesignation,
            date_vente: vente,
            qte: quantite,
            prix: prix
        });

        console.log('ventes', ventes);
            // Réinitialiser le formulaire après l'ajout
    document.getElementById('formAjoutdetail').reset();
    restoreInputValues(); // Restaurer les valeurs après l'ajout
}

function validerVentes() {
    // Créer une requête AJAX
    var client_id = document.getElementById('client_id').value;
    var date = document.getElementById('date').value;

    $.ajax({
        url: '/ventes/store', // Remplacez '/votre-url-de-validation-de-ventes' par votre URL de validation des ventes
        type: 'POST',
        data: JSON.stringify({
            ventes: ventes, // Les ventes à enregistrer
            client_id: client_id, // Client ID à envoyer
            date: date
        }),
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Inclure le jeton CSRF dans les en-têtes de la requête
        },
        success: function(response) {
            // Réponse du serveur (vous pouvez effectuer des actions ici)
            alert('Ventes validées avec succès !');
            // Réinitialiser le tableau des ventes après la validation
            ventes = [];
            // Optionnel : réinitialiser la table
            document.getElementById('tbodydetail').innerHTML = '';
        },
        error: function() {
            alert('Erreur lors de la validation des ventes.');
        }
    });
}
</script>
</body>
</html>
