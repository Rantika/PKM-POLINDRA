@extends('layouts.main')

    @section('title') Proposal PKM @endsection

    @section('css')
    
    @endsection
    @section('content')

    <section>
        <div class="main">
            <div class="main-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                            <div class="panel panel-headline">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$forum->judul}}</h3>
                                    <p class="panel-subtitle">{{$forum->created_at->diffForHumans()}}</p>
                                </div>
                                <div class="panel-body">
                                    <p>{{$forum->konten}}</p>
                                    <hr>
                                    <div class="btn-group">
                                        <button class="btn btn-primary"><i class="bi bi-heart-fill me-2"></i>Like</button>
                                        <button class="btn btn-danger" id="btn-komentar-utama"><i class="bi bi-chat"></i>Komentar</button>
                                    </div>
                                    
                                    <form action="" id="komentar-utama" name="komentar" style="height: 100px" method="POST">
                                        @csrf
                                        <input type="hidden" name="forum_id" value="{{$forum->id}}">
                                        <input type="hidden" name="parent" value="0">
                                        <textarea id="komentar-utama"  name="konten" class="form-control" rowa="4" ></textarea>
                                        <input type="submit" class="btn btn-primary" value="kirim">
                                    </form>
                                    <h3>Komentar</h3>
                                    <hr>
                                    <ul class="list-unstyled activity-list">
										<li>
                                        <div>
                                         @foreach($forum->komentar()-> where('parent',0)->orderBy('created_at','desc')->get() as $komentar)
											<img src="{{ asset('image/profil.png')}}" width="50px" height="50px" alt="Avatar" class="img-circle pull-left avatar">
											<b>
                                                <a href="#">{{$komentar->user->student->name}}</a>
                                                <p> {{$komentar->konten}}</p>
                                                <span class="timestamp" style="color:#808080">{{$komentar->created_at->diffForHumans()}}</span> </b>
                                                <form action=""  method="post">
                                                    @csrf
                                                    <input type="text" name="konten" class="form-control" style="padding-left:3.5em;">
                                                    <input type="hidden" name="forum_id" value="{{$forum->id}}">
                                                    <input type="hidden" name="parent" value="{{$komentar->id}}">
                                                    <input type="submit" class="btn btn-primary btn-xs" value="kirim">
                                                </form>
                                                <br>
                                                <div>
                                                    @foreach($komentar->childs()->orderBy('created_at','desc')->get() as $child)
                                                <b>
                                                <a href="#">{{$child->user->student->name}}</a>
                                                <p> {{$child->konten}}</p>
                                                <span class="timestamp" style="color:#808080">{{$child->created_at->diffForHumans()}}</span> </b>
                                                @endforeach
                                            </div>
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
@endsection

@section('js')
 <script>
      $(document).ready(function () {
        $('#btn-komentar-utama').click(function () {
           $('#komentar-utama').toggle('slide');
        });
    });
</script>
@endsection