@php
    $site_name = DB::table('customizations')->where('name', 'site_name')->first();
@endphp

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © {{$site_name->value}}.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by <a href="https://www.webexag.com/" class="text-primary">WEBEX AG</a>
                </div>
            </div>
        </div>
    </div>
</footer>
