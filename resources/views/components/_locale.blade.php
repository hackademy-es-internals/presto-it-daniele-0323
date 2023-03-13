<form class="d-inline" action="{{route('setLanguage', $lang)}}" method="POST">
    @csrf
    <button type="submit" class="btn">
        <img src="{{asset('vendor/blade-flags/language-'.$lang.'.svg')}}" alt="..." width="32">
    </button>
</form>