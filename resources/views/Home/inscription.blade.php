@extends('base')

@section('title', 'Inscription')

@section('content')

<div class="container">
    <div class="row mt-5 titre">
            <div class="col-md-6 mt-5 mx-auto">
                <h1 class="text-center text-muted mt-5">Inscription</h1>
                <p class="text-center mb-5 text-danger">NB: Votre inscription n'est valide que si vous payez vos frais directement. <br> les frais de casting s'élèvent à 5000XAF.</p>

                <form action="{{route('app_inscription')}}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="Nom" class="form-label">Noms</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus placeholder="Entrez votre nom">
                        <small class="text-danger fw-bold" id="erreur-de-nom"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="Prenom" class="form-label">Prénoms</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus placeholder="Entrez votre prénom">
                        <small class="text-danger fw-bold" id="erreur-de-prenom"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="Age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus placeholder="Entrez votre âge">
                        <small class="text-danger fw-bold" id="erreur-d-age"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="telephone" class="form-label">Numéro de téléphone</label>
                        <input type="number" class="form-control" id="contact" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus placeholder="Entrez votre numéro de téléphone">
                        <small class="text-danger fw-bold" id="erreur-de-contact"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="Profession" class="form-label">Profession</label>
                        <input type="text" class="form-control" id="profession" name="profession" value="{{ old('profession') }}" required autocomplete="profession" autofocus placeholder="Entrez votre profession">
                        <small class="text-danger fw-bold" id="erreur-de-profession"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="niveau scolaire" class="form-label">Niveau Scolaire</label>
                        <input type="text" class="form-control" id="scolarisation" name="scolarisation" value="{{ old('scolarisation') }}" required autocomplete="scolarisation" autofocus placeholder="Entrez votre niveau scolaire">
                        <small class="text-danger fw-bold" id="erreur-de-niveau"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="Ville de résidence" class="form-label">Ville de résidence</label>
                        <input type="text" class="form-control" id="ville" name="ville" value="{{ old('ville') }}" required autocomplete="ville" autofocus placeholder="Entrez votre ville de résidence">
                        <small class="text-danger fw-bold" id="erreur-de-ville"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="Région d'origine" class="form-label">Région d'origine</label>
                        <input type="text" class="form-control" id="region" name="region" value="{{ old('region') }}" required autocomplete="region" autofocus placeholder="Entrez votre région d'origine">
                        <small class="text-danger fw-bold" id="erreur-de-région"></small>
                    </div>
                    <div class="col-md-12">
                        <label for="mail" class="form-label">mail</label>
                        <input type="mail" class="form-control" id="mail" name="mail" value="{{ old('mail') }}" required autocomplete="mail" autofocus placeholder="Entrez votre adresse mail">
                        <small class="text-danger fw-bold" id="erreur-de-mail"></small>
                    </div>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Ajoutez une photo entière de vous</label>
                        <input class="form-control form-control-sm" id="formFileSm" type="file">
                  </div>
                  <p class="text-center mb-5 text-success">NB: Une fois que vous aller cliquer sur <strong>"S'incrire"</strong>, vous serez dirigé vers la page de paiement des frais de casting.</p>
                  <p class="text-center mb-5 text-danger">Votre inscription n'est valide que si vous payez vos frais de casting.</p>

                  <div class="d-grid gap-2">
                    <button class="btn btn-success" type="button">S'incrire</button>
                  </div>

                </form>
            </div>
    </div>
</div>

@endsection
