@extends('layouts.app')

@section('content')
<div class="container" style="padding-top:10px;">
    
    <div class="row">

        @foreach ($seasons as $season)
		<div class="col-lg-4 mb-2">
			<div class="card card-viking">
                <div class="card-body">
					<div class="card-title d-flex justify-content-between align-items-center">
						<div class="d-flex align-items-center"><strong>{{ $season->name }}</strong></div>
					</div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <p>{{ \Carbon\Carbon::parse($season->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($season->end_date)->format('d F Y') }}</p>
                                    </td>
                                    </tr>
                                    <tr><td>
                                        
                                            @foreach ($season->competitions as $competition)
                                            <p style="padding-top:10px; padding-bottom:10px; margin-bottom:0px; font-size:1.1rem;">
                                                <a href="{{ route('competitions.show', $competition) }}">
                                                    {{ $competition->name }}
                                                </a>
                                            </p>
                                            @endforeach
                                        
                                    </td>
                                </tr>
                                <td>{{ ucfirst($season->status) }}</td>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection
