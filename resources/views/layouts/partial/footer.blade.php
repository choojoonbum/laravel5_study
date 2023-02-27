<!-- resources/views/layouts/partial/footer.blade.php -->
<footer class="footer">
    <ul class="list-inline pull-right locale">
        <li><i class="fa fa-language"></i></li>
        @foreach (['en' => 'English', 'ko' => '한국어'] as $locale => $language)
            <li class="{{ ($locale == $currentLocale) ? 'active' : '' }}">
                <a href="{{ route('locale', ['locale' => $locale, 'return' => urlencode($currentUrl)]) }}">
                    {{ $language }}
                </a>
            </li>
        @endforeach
    </ul>

    <div>
        &copy; {{ date('Y') }} &nbsp; <a href="https://github.com/appkr/l5essential">Laravel 5 Essential</a>
    </div>
</footer>
