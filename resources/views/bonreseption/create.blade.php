<div class="container">
    <h1>Ajouter un Bon de Réception</h1>
    <form id="formAjoutdetail" action="{{ route('bonreseption.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" onchange="updateDetailDate()" required>
        </div>
        <div class="form-group">
            <label for="artisan_id">Artisan</label>
            <select class="form-control" id="artisan_id" name="artisan_id" required>
                @foreach ($artisans as $artisan)
                    <option value="{{ $artisan->id }}">{{ $artisan->nom }}</option>
                @endforeach
            </select>
        </div>

        <h1>Ajouter un Détail de Bon de Réception</h1>
        <div class="form-group">
            <label for="article_id">Article</label>
            <select class="form-control" id="article_id" name="article_id" required>
                @foreach ($articles as $article)
                    <option value="{{ $article->id }}">{{ $article->designation }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="br_id">Bon de Réception</label>
            <input type="date" class="form-control" id="br_id" name="br_id" required onchange="updateDetailDate()">
        </div>
        <div class="form-group">
            <label for="qte">Quantité</label>
            <input type="text" class="form-control" id="qte" name="qte" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" class="form-control" id="prix" name="prix" required>
        </div>
        <button type="button" onclick="ajouterdetail()" class="btn btn-primary">Ajouter détail</button>
    </form>

    <table id="tabledetail" border="2">
        <thead>
            <tr>
                <th>Article</th>
                <th>Bon de Réception</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tbodydetail">
            <!-- Les lignes d'articles seront ajoutées ici dynamiquement -->
        </tbody>
    </table>
    <button type="button" onclick="validerBon_reception()" class="btn btn-primary">Enregistrer Bon de Réception</button>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let Bon_reception = [];
    let savedValues = {};

    function saveInputValues() {
        savedValues.date = document.getElementById('date').value;
        savedValues.artisan_id = document.getElementById('artisan_id').value;
        savedValues.br_id = document.getElementById('br_id').value;
    }

    function restoreInputValues() {
        document.getElementById('date').value = savedValues.date;
        document.getElementById('artisan_id').value = savedValues.artisan_id;
        document.getElementById('br_id').value = savedValues.br_id;
    }

    function updateDetailDate() {
        var BonDate = document.getElementById('date').value;
        document.getElementById('br_id').value = BonDate;
    }
   

    function ajouterdetail() {
        saveInputValues();
        var article = document.getElementById('article_id').value;
        var br_id = document.getElementById('br_id').value;
        var quantite = document.getElementById('qte').value;
        var prix = document.getElementById('prix').value;

        var tbody = document.getElementById('tbodydetail');
        var newRow = tbody.insertRow();

        var cellArticle = newRow.insertCell();
        cellArticle.innerText = article;

        var cellBR = newRow.insertCell();
        cellBR.innerText = br_id;

        var cellQuantite = newRow.insertCell();
        cellQuantite.innerText = quantite;

        var cellPrix = newRow.insertCell();
        cellPrix.innerText = prix;

        Bon_reception.push({
            article_id: article,
            br_id: br_id,
            qte: quantite,
            prix: prix
        });
        console.log('Bon_reception',Bon_reception)
        document.getElementById('formAjoutdetail').reset();
        restoreInputValues();
    }

    function validerBon_reception() {
        var date = document.getElementById('date').value;
        var artisan_id = document.getElementById('artisan_id').value;

        $.ajax({
            url: 'bonreseption/store',
            type: 'POST',
            data: JSON.stringify({
                date: date,
                artisan_id: artisan_id,
                Bon_reception: Bon_reception
            }),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Bon de Réception enregistré avec succès !');
                Bon_reception = [];
                document.getElementById('tbodydetail').innerHTML= '';
            },
                error: function() {
                    alert('Erreur lors de la validation des Bon_reception.');
                }
            });
        }</script>

</div>
