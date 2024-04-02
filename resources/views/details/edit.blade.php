@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Éditer Détail de Bon de Réception</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('details.update', $detail_Br->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="article_id">Article</label>
                                <select class="form-control" id="article_id" name="article_id">
                                    @foreach($articles as $article)
                                        <option value="{{ $article->id }}" {{ $detail_Br->article_id == $article->id ? 'selected' : '' }}>
                                            {{ $article->nom }} - {{ $article->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="br_id">Bon de Réception</label>
                                <select class="form-control" id="br_id" name="br_id">
                                    @foreach($bonreceptions as $bonreception)
                                        <option value="{{ $bonreception->id }}" {{ $detail_Br->br_id == $bonreception->id ? 'selected' : '' }}>
                                            {{ $bonreception->numero }} - {{ $bonreception->date }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="qte">Quantité</label>
                                <input type="text" class="form-control" id="qte" name="qte" value="{{ $detail_Br->qte }}">
                            </div>

                            <div class="form-group">
                                <label for="prix">Prix</label>
                                <input type="text" class="form-control" id="prix" name="prix" value="{{ $detail_Br->prix }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Mettre à Jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
