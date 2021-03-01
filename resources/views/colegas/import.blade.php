@extends('layout')

@section('content')
<div class="container">
    <div class="white-box">
        <div class="row">
            <div class="col-md-12 m-t-10">
                <form method="POST" action="{{ route('colegasSendFile') }}" enctype="multipart/form-data">
                    @csrf
                    <h2 class="font-bold text-center"><i class="fa-fw icon-user-follow"></i> Importar Colegas</h2>
                    <div class="col-xs-12 form-dialises-border m-t-40-sm">
                        <div class="row btn-xs-r text-right">
                            <div class="col-xs-12 p-0 m-b-10">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <input id="FileImport" type="file" name="fileUpload" accept=".csv"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Importar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
