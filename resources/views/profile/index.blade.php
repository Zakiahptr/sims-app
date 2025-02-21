@extends('layouts.app')

@section('content')
<div class="title-page">Profil</div>
<img src="{{ asset('assets/profile.jpeg') }}" width="150px" class="rounded-circle py-3" alt="Profile Image">


<form>
    @csrf
    <div class="row mb-3">
        <div class="col-md-8">
            <label for="name" class="form-label">Nama Kandidat</label>
            <div class="input-group">
                <span class="input-group-text"  style="background-color: #ffff; border-right: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="none" stroke="#ccc" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11.996V7.998m0 3.998c0-5.157-8-5.157-8 0c0 5.167 8 5.11 8 0m0 0c0 5 5 5 5 0C21 7.027 16.97 3 12 3s-9 4.027-9 8.996c0 4.968 4.03 8.995 9 8.995c1.675.084 3.938-.421 5.776-1.831"/></svg>
                </span>
                <input id="name" type="text" class="form-control" style="border-left: none;" name="name" value="Zakiah Putri Madani" readonly>
            </div>

        </div>
        <div class="col-md-4">
            <label for="position" class="form-label">Posisi Kandidat</label>
            <div class="input-group">
                <span class="input-group-text"  style="background-color: #ffff; border-right: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="#ccc" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.5 6L10 18.5m-3.5-10L3 12l3.5 3.5m11-7L21 12l-3.5 3.5"/></svg>                </span>
                <input id="position" type="text" class="form-control" style="border-left: none;" name="position" value="Web Programmer" readonly>
            </div>

        </div>
    </div>

</form>
@endsection


