<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<body>
    <div id="google_translate_element"></div>
    <form action="{{ route('state') }}">
        <button type="submit">state</button>
    </form>

    <form action="{{ route('dist') }}">
        <button type="submit">dist</button>
    </form>

    <form action="{{ route('subDist') }}">
        <button type="submit">subDist</button>
    </form>

    <form action="{{ route('acaYear') }}">
        <button type="submit">acaYear</button>
    </form>

    <form action="{{ route('class') }}">
        <button type="submit">class</button>
    </form>

    <form action="{{ route('addCats') }}">
        <button type="submit">Add Categories</button>
    </form>

    <form action="{{ route('addCaste') }}">
        <button type="submit">Add Castes</button>
    </form>

    <form action="{{ route('feeHead') }}">
        <button type="submit">Fee Head</button>
    </form>

    <button-primary> <a href="{{ route('autoAddclass') }}">Auto Add Class</a></button-primary>

    </div>
    </div>
    </div>
</body>

</html>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'kn'
        }, 'google_translate_element');
    }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>
