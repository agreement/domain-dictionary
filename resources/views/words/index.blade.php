<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .panel-body h3
        {
            margin-top: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="page-title text-center"><a href="/">Domain Dictionary</a></h1>

    <p class="lead text-center">Choose a letter to find your next domain!</p>

    <div class="btn-group btn-group-justified" role="group">
        @foreach(range('a','z') as $_letter)
            <a href="/words/{{ $_letter }}" class="btn btn-default @if(isset($letter) && strtolower($letter) == $_letter) active @endif">{{ strtoupper($_letter) }}</a>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <hr>
            @if( ! empty($words))
                <div class="text-center">
                    {!! $words->links() !!}
                </div>
                @foreach($words as $word)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>{{ $word->word }}</h3>

                            @foreach($word->definitions as $definition)
                                <p><em class="text-muted">{{ $definition->type }}</em> {{ $definition->definition }}</p>
                            @endforeach

                            <table class="table table-striped">
                                <tbody>
                                @foreach($word->domains as $domain)
                                    <tr>
                                        <td><a href="http://{{ $domain->domain }}">{{ $domain->domain }}</a></td>
                                        <td><span class="label label-{!! ($domain->available) ? 'success">AVAILABLE' : 'danger">UNAVAILABLE' !!}</span></td>
                                        <td>{{ config('domainr.statuses.' . $domain->status . '.description') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

                <div class="text-center">
                    {!! $words->links() !!}
                </div>
            @else
                <h2 class="text-center">Random Available Domain</h2>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>{{ $domain->word->word }}</h3>

                        @foreach($domain->word->definitions as $definition)
                            <p><em class="text-muted">{{ $definition->type }}</em> {{ $definition->definition }}</p>
                        @endforeach

                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td><a href="http://{{ $domain->domain }}">{{ $domain->domain }}</a></td>
                                    <td><span class="label label-{!! ($domain->available) ? 'success">AVAILABLE' : 'danger">UNAVAILABLE' !!}</span></td>
                                    <td>{{ config('domainr.statuses.' . $domain->status . '.description') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p class="text-center text-muted">
                    <small>Word definitions extracted from <a href="http://www.mso.anu.edu.au/~ralph/OPTED/" target="_blank">OPTED</a>, a public domain English word list dictionary, based on the public domain portion of "The Project Gutenberg Etext of Webster's Unabridged Dictionary" which is in turn based on the 1913 US Webster's Unabridged Dictionary.</small>
                </p>

                <p class="text-center text-muted">
                    <small>Powered by the <a href="https://domainr.com/">Domainr API</a></small>
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
