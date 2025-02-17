<!doctype html>
<html lang="fr">
{!! Html::style('assets/css/bootstrap.css') !!}
{!! Html::style('assets/css/gsb.css') !!}


<head>

    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar+ bvn"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}">Gestion des badges</a>
                </div>

                @if (Session::get('id') == 0)
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{url('/formLogin')}}" data-toggle="collapse" data-targer=".navbar-collapse.in"> Se Connecter</a> </li>
                        </ul>
                    </div>
                @endif

                @if (Session::get('id') >0 and Session::get('type') == 'Administrateur')
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-collapse navbar-nav navbar-left" id="navbar-collapse-target" >
                            <li><a href="{{url('/listerAdherents')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Liste des Adhérents</a></li>
                            <li><a href="{{url('/DroitsGolfClou')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Autorisation Clou</a></li>
                            <li><a href="{{url('/DroitsGolfGouverneur')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Autorisation Gouverneur</a></li>
                            <li><a href="{{url('/DroitsGolfBeaujolais')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Autorisation Beaujolais</a></li>
                            <li><a href="{{url('/selGolf')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Liste des badges libres</a></li>
                            <li><a href="{{url('/listerBadgesRecuperer')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Liste des badges récupérés </a></li>
                            <li><a href="{{url('/AjouterAdherent')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Ajouter un Adhérent </a></li>
                            <li><a href="{{url('/ajouterAutorisation')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Autoriser un Adhérent </a></li>
                            <li><a href="{{url('/ChoisirAdherent')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Ajouter un badge à un Adhérent </a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{url('/logout')}}" data-toggle="collapse" data-target=".navbar-collapse.in" > ({{Session::get('login')}}) Se déconnecter</a> </li>

                        </ul>
                    </div>
                @endif

                @if (Session::get('id') >0 and Session::get('type') == 'Membre')
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-collapse navbar-nav navbar-left" id="navbar-collapse-target" >
                            <li><a href="{{url('/getFraisVisiteur')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Mes Badges</a></li>
                            <li><a href="{{url('/getFraisVisiteur')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Mes informations</a></li>
                            <li><a href="{{url('/getFraisVisiteur')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Réserver un badge</a></li>
                            <li><a href="{{url('/ajouterFrais')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Libérer un badge</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{url('/logout')}}" data-toggle="collapse" data-target=".navbar-collapse.in" > ({{Session::get('login')}}) Se déconnecter</a> </li>

                        </ul>
                    </div>
                @endif

            </div><!--/.container-fluid -->
        </nav>
    </div>
    <div class="container">
        @yield('content')
    </div>


</head>
<body class="body">



</body>

</html>
