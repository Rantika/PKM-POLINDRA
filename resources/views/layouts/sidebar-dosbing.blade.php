@php
    use Illuminate\Support\Facades\DB;
@endphp
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- ======= Sidebar Dosbing ======= -->
        @if(Auth::user()->lecturer)
        <label for="" style="margin-bottom: 5px">Pilih Akses</label>
        <select class="form-control" id="rubah">
            <option value="">- Pilih Role -</option>
            <?php
                $role = DB::table("users_role")
                    ->where("user_id", Auth::user()->id)
                    ->get();
            ?>
            @foreach($role as $data)
                <option value="{{ $data->id }}"
                                {{ Auth::user()->id_hak_akses == $data->id ? 'selected' : '' }}>
                                {{ $data->role }}
                            </option>
            @endforeach
        </select>

        @if(Auth::user()->hak_akses->role == "Dosen Pembimbing")
        <li class="nav-heading">Dosen Pembimbing</li>

<!-- ======= Dashboard ======= -->
<li class="nav-item">
    <a class="nav-link {{sideBarRoute('lecturer.index')}}" href="{{route('lecturer.index')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
</li>
<!-- ======= End Dashboard ======= -->

<!-- ======= Proposal PKM ======= -->
<li class="nav-item">
    <a class="nav-link {{ sideBarRoute('lectuter.acc') }} "  href="{{ route('lecturer.acc') }}">
        <i class="bi bi-book"></i>
        <span>Bimbingan</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{sideBarRoute('lecturer.proposal')}}" href="{{route('lecturer.proposal')}}">
        <i class="bi bi-book"></i>
        <span>Proposal PKM</span>
    </a>
</li>
<!-- ======= End Proposal PKM ======= -->
<!-- ======= Forum ======= -->

        @elseif(Auth::user()->hak_akses->role == "Reviewer")
        <li class="nav-heading">Reviewer</li>

<!-- ======= Dasboard ======= -->
<li class="nav-item">
    <a class="nav-link {{sideBarRoute('reviewer.index')}}" href="{{route('reviewer.index')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
</li>
<!-- ======= End Dashboard ======= -->

<!-- ======= Review Proposal PKM ======= -->
<li class="nav-item">
    <a class="nav-link {{sideBarRoute('reviewer.proposal')}}" href="{{route('reviewer.proposal')}}">
        <i class="bi bi-book"></i>
        <span>Review Proposal PKM</span>
    </a>
</li>
 <!-- ======= Proposal PKM ======= -->
        @endif
        
        @endif
        <!-- ======= Logout ======= -->
        <li class="nav-heading">General</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
            </a>
        </li>
        <!-- ======= End Logout ======= -->
    </ul>

</aside>
<!-- ======= End Sidebar ======= -->