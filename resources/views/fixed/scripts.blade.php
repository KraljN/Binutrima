<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset("assets/vendor/summernote-lite.js")}}"></script>
<script type="text/javascript">
    var loggedIn = false;
    var admin = false;
    var userId = null;
    var routeName = "{{Illuminate\Support\Facades\Route::currentRouteName()}}";
    const assets = "{{asset('')}}"
    const baseUrl = '{{url('/')}}'
    @if(Auth::check() && Auth::user()->role->role_name == 'admin')
        admin = true;
    @endif
        @if(Auth::check())
        loggedIn = true;
    @endif
    if(loggedIn){
        userId = "{{Auth::id()}}";
    }
</script>
<script type="text/javascript" src="{{asset("assets/js/main.js")}}"></script>
