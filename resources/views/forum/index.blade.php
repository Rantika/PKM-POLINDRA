    @extends('layouts.main')

    @section('title') Proposal PKM @endsection

    @section('css')
    
    @endsection
    @section('content')

    <section class="section dashboard">
    <div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Forum</h3>
                            
                            <div class="right">
                                <button type="button" class="btn btn-sm btn-primary my-4" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                            <i class="bi bi-plus me-1"></i> Tambah
                        </button>
                            </div>
                        </div>
                        <hr>
                        <div class="panel-body">
                        <div class="panel panel-scrolling">
								<div class="panel-body">
									<ul class="list-unstyled activity-list">
                                        @foreach($forum as $frm)
										<li>
											<img src="{{ asset('image/profil.png')}}" width="50px" height="50px" alt="Avatar" class="img-circle pull-left avatar">
											<b>
                                                <a href="/forum/{{$frm->id}}/view">{{$frm->user->student->name}}</a> 
                                               
                                                <span class="timestamp" style="color:#808080">{{$frm->created_at->diffForHumans()}}</span>
                                            </b>
										</li>
                                        <hr>
                                        @endforeach
                                        </ul>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

 <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <form action="{{route('forum.create')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Forum</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group{{$errors->has('judul')? 'has-error':''}}">
                                <input name="judul" type="text" class="form-control" id="floatingDesc" placeholder="judul" required>
                                @if($errors->has('nama_depan'))
                                    <span class="help-block">{{$errors->first('judul')}}</span>
                                @endif
                                </div>
                            </div>
                            <div class="form-floating">
                            <textarea class="form-control" name="konten" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Konten</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection