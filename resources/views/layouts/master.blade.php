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
                    <a class="navbar-brand" href="{{url('/')}}"></a>
                </div>


                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-collapse navbar-nav navbar-left" id="navbar-collapse-target" >
                            <li><a href="{{url('/ChoisirGrandClient')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Classement Top 10</a></li>
                            <li><a href="{{url('/ListerTopFive')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Evolution des montants du Top 5</a></li>
                            <li><a href="{{url('/ListerProduitOneOne')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Produit 1_1</a></li>
                            <li><a href="{{url('/ListerProduitOneFour')}}" data-toggle="collapse" data-target=".navbar-collapse.in">Produit 1_4</a></li>
                        </ul>

                    </div>




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
