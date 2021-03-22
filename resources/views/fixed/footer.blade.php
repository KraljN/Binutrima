<footer class="text-center text-white">
    <div class="container pt-4">
        <section class="mb-2" id="social">
            @foreach($social as $icon)
                <a
                    class="btn btn-link btn-floating btn-lg text-dark footerText"
                    href="{{$icon->link}}"
                    role="button"
                    target="_blank"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-{{$icon->name}}"></i
                    ></a>
            @endforeach
        </section>

    </div>

    <div class="text-center text-dark p-3 footerText">
        &copy; 2021 Copyright: Nikola Kralj
    </div>

</footer>
